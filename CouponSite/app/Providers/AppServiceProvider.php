<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Facades\App\Repository\AppHeaderRepo;
use Facades\App\Repository\AppFooterRepo;
use Facades\App\Repository\BlogRepo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.app_header', function ($view) {
            $events = AppHeaderRepo::getEvents();
            $view->with('events',$events);
        });
        View::composer('layouts.app_footer', function ($view) {
            $events = AppFooterRepo::getEvents();
            $view->with('events',$events);
        });
        View::composer('layouts.blog_header', function($view){
            $blogcategories = BlogRepo::getAllCategories();
            $view->with('blogcategories',$blogcategories);
        });
        View::composer('layouts.blog_layout', function($view){
            $topstores = BlogRepo::getTopStores();
            $view->with('topstores',$topstores);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Facades\App\Repository\AppHeaderRepo;
use Facades\App\Repository\AppFooterRepo;
use App\BlogCategory;
use App\Store;
use App\Category;

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
            $blogcategories = BlogCategory::select('id','title','url')->where('is_active','y')->get();
            $view->with('blogcategories',$blogcategories);
        });
        View::composer('layouts.blog_layout', function($view){
            $topstores = Store::select('id','title','secondary_url','logo_url')->where('is_active','y')->where('is_topstore',1)->limit(9)->get();
            $topcategories = Category::select('id','title','url','logo_url')->where('is_active','y')->where('is_topcategory',1)->limit(9)->get();
            $view->with('topstores',$topstores)->with('topcategories',$topcategories);
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

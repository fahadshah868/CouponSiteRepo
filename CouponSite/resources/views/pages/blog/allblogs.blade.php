@extends('layouts.blog_layout')

@section('title','All Blogs')

@section('content')

<section id="js-blogs">
    @include('partialviews.blogs')
</section>

@endsection
@section('js-section')
<script>
    $(document).ready(function(){
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');  
            getArticles(url);
        });
        function getArticles(url) {
            $.ajax({
                url : url
            }).done(function (data) {
                $('#js-blogs').html(data);
                $('html, body').animate({
                    scrollTop: $("div.blog-frame-container").offset().top
                }, 500)
            }).fail(function () {
                alert('something went wrong.');
            });
        }
    });
</script>
@endsection
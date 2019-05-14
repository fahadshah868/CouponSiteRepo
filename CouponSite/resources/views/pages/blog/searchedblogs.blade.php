@extends('layouts.blog_layout')

@section('title','All Blogs')

@section('content')

<div style="font-style: italic; font-size: 22px; font-weight: 500;">Searched Results For "{{ $searched_blog_title }}"</div>
<hr>
<section id="js-blogs">
    @include('partialviews.allblogs')
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
                url : url,
                data: {title: '{{$searched_blog_title}}'},
            }).done(function (data) {
                $('#js-blogs').html(data);
                $('html, body').animate({
                    scrollTop: $("div.blog-container").offset().top
                }, 500)
            }).fail(function () {
                alert('something went wrong.');
            });
        }
    });
</script>
@endsection
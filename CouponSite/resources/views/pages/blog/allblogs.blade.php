@extends('layouts.blog_layout')

@section('title','All Blogs')

@section('content')

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
                url : url
            }).done(function (data) {
                $('#js-blogs').html(data);
            }).fail(function () {
                alert('something went wrong.');
            });
        }
    });
</script>
@endsection
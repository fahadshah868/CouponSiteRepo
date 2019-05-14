@extends('layouts.blog_layout')

@section('title','All Blogs')

@section('content')

<div class="rb-main-container">
    <div class="rb-container">
        <div class="rb-img-container">
            <img src="{{$panel_assets_url.$blog->image_url}}">
            <div class="overlay">
                <div class="rb-title">{{$blog->title}}</div>
            </div>
        </div>
        <div class="rb-body">
            {!! $blog->body !!}
        </div>
    </div>
    <hr id="post-comment">
    @if(count($blog->comments) > 0)
    <div class="comments-list-container">
        <div class="comments-main-heading">Comments For "{{$blog->title}}"</div>
        <ol class="comments-list">
            @foreach($blog->comments as $comment)
            <li>
                <div class="comment-assets">
                    <div class="comment-header-container">
                        <div class="comment-header">
                            <div class="comment-author-image">
                                <img src="{{asset('images/user-placeholder.png')}}">
                            </div>
                            <span class="comment-author">{{$comment->author}} says:</span>
                        </div>
                        <span class="comment-time">{{ Carbon\Carbon::parse($comment->created_at)->format('D, M d, Y')}} at {{Carbon\Carbon::parse($comment->created_at)->format('h:i:s A') }}</span>
                    </div>
                    <div class="comment-body">
                        <p>{{$comment->body}}</p>
                    </div>
                </div>
            </li>
            @endforeach
        </ol>
    </div>
    @endif
    <div class="comment-form-container">
        <div id="js-cmt-alert-message" class="alert alert-dismissible fade show js-cmt-alert-message">
            <span class="close" aria-label="close">&times;</span>
            <span id="alert-message-area">
            </span>
        </div>
        @if(Session::has('comment_message'))
            <div class="cmt-alert-message">{{Session::get('comment_message')}}</div>
        @endif
        <form id="comment_form" class="comment_form" action="/blog/postcomment" method="POST">
            <input type="hidden" value="{{$blog->id}}" id="blog_id" name="blog_id">
            <label class="comment-form-field-heading">Comment</label>
            <textarea class="comment-form-textarea" id="body" name="body" required></textarea>
            <label class="comment-form-field-heading">Name*</label>
            <input class="comment-form-textfield" type="text" id="author" name="author" required>
            <label class="comment-form-field-heading">Email*</label>
            <input class="comment-form-textfield" type="text" id="email" name="email" required>
            @if(Session::has('validation_message'))
                <label class="error">{{Session::get('validation_message')}}</label>
            @endif
            <input type="submit" value="Post Comment" id="comment-form-btn" class="comment-form-btn">
        </form>
    </div>
    <hr>
    <div class="rb-ab-wrapper">
        <section id="js-blogs">
            @include('partialviews.allblogs')
        </section>
    </div>
</div>

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
                data: {id: '{{$blog->id}}'},
            }).done(function (data) {
                $('#js-blogs').html(data);
                $('html, body').animate({
                    scrollTop: $("div.rb-ab-wrapper").offset().top
                }, 500)
            }).fail(function () {
                alert('something went wrong.');
            });
        }
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        //custom rule for email
        jQuery.validator.addMethod("emailre", function(value, element, param) {
            return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
        },'please enter a valid email');
        //validation rules for form
        $("#comment_form").submit(function(event){
            event.preventDefault();
        }).validate({
            ignore: ".hide",
            rules: {
                body: "required",
                author: "required",
                email: { required: true, email: true, emailre: true},
            },
            messages: {
                body: "Please Fill Comment Field",
                author: "Please Fill Name Field",
                email: { required: "Please Fill Email Field", email: "Please Enter A Valid Email", emailre:"Please Enter A Valid Email"},
            },
            submitHandler: function(form) {
                var _body = $("#body").val();
                var _author = $("#author").val();
                var _email = $("#email").val();
                var jsondata = JSON.stringify({blog_id: '{{$blog->id}}', body: _body, author: _author, email: _email});
                $.ajax({
                    method: "POST",
                    url: "/blog/postcomment",
                    dataType: "json",
                    data: jsondata,
                    beforeSend: function() {
                        $("#comment_form").trigger("reset");
                    },
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        $("#alert-message-area").html(data.message);
                        $("#js-cmt-alert-message").css('display','block');
                    },
                    error: function(){
                        alert('something went wrong');
                    }
                });
            }
        });
    });
</script>
@endsection
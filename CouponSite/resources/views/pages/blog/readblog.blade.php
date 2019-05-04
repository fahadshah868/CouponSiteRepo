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
    <div class="rb-comment-container">
        <div id="js-cmt-alert-message" class="alert alert-dismissible fade show js-cmt-alert-message">
            <span class="close" aria-label="close">&times;</span>
            <span id="alert-message-area">
            </span>
        </div>
        @if(Session::has('comment_message'))
            <div class="cmt-alert-message">{{Session::get('comment_message')}}</div>
        @endif
        <form id="blog_comment_form" class="blog_comment_form" action="/blog/postcomment" method="POST">
            <input type="hidden" value="{{$blog->id}}" id="blog_id" name="blog_id">
            <label class="rb-comment-field-heading">Comment</label>
            <textarea class="rb-comment-textarea" id="comment" name="comment" required></textarea>
            <label class="rb-comment-field-heading">Name*</label>
            <input class="rb-textfield" type="text" id="author" name="author" required>
            <label class="rb-comment-field-heading">Email*</label>
            <input class="rb-textfield" type="text" id="email" name="email" required>
            @if(Session::has('validation_message'))
                <label class="error">{{Session::get('validation_message')}}</label>
            @endif
            <input type="submit" id="rb-comment-btn" class="rb-comment-btn">
        </form>
    </div>
    <hr>
    <div class="rb-ab-main-container">
        @foreach($allblogs as $blog)
            <div class="ab-container">
                <a class="ab-img-container" href="/blog/{{$blog->url}}">
                    <img src="{{$panel_assets_url.$blog->image_url}}">
                </a>
                <div class="ab-details-container">
                    <a class="ab-title" href="/blog/{{$blog->url}}">{{$blog->title}}</a>
                    <span class="ab-author">By {{$blog->author}}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

@section('js-section')
<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        //custom rule for email
        jQuery.validator.addMethod("emailre", function(value, element, param) {
            return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
        },'please enter a valid email');
        //validation rules for form
        $("#blog_comment_form").submit(function(event){
            event.preventDefault();
        }).validate({
            ignore: ".hide",
            rules: {
                comment: "required",
                author: "required",
                email: { required: true, email: true, emailre: true},
            },
            messages: {
                comment: "Please Fill Comment Field",
                author: "Please Fill Name Field",
                email: { required: "Please Fill Email Field", email: "Please Enter A Valid Email", emailre:"Please Enter A Valid Email"},
            },
            submitHandler: function(form) {
                var _comment = $("#comment").val();
                var _author = $("#author").val();
                var _email = $("#email").val();
                var jsondata = JSON.stringify({blog_id: '{{$blog->id}}', comment: _comment, author: _author, email: _email});
                $.ajax({
                    method: "POST",
                    url: "/blog/postcomment",
                    dataType: "json",
                    data: jsondata,
                    beforeSend: function() {
                        $("#blog_comment_form").trigger("reset");
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
<div class="ab-main-container" id="ab-main-container">
    @foreach($allblogs as $blog)
        <div class="ab-container">
            <a href="/blog/{{$blog->url}}">
                <div class="ab-img-container">
                    <img src="{{$panel_assets_url.$blog->image_url}}">
                </div>
            </a>
            <div class="ab-details-container">
                <a class="ab-title" href="/blog/{{$blog->url}}">{{$blog->title}}</a>
                <span class="ab-author">By {{$blog->author}} | {{ Carbon\Carbon::parse($blog->created_at)->format('M d, Y')}}</span>
                <div class="readnow-link">[<a href="/blog/{{$blog->url}}">Read Now</a>]</div>
            </div>
        </div>
    @endforeach
    <div class="simple-pagination">
        {{$allblogs->links()}}
    </div>
</div>
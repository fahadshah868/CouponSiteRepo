<div class="blogs-main-container" id="blogs-main-container">
    @if(count($allblogs) > 0)
        @foreach($allblogs as $blog)
            <div class="blog-content-container">
                <a href="/blog/{{$blog->url}}">
                    <div class="blog-img-container">
                        <img src="{{$panel_assets_url.$blog->image_url}}">
                    </div>
                </a>
                <div class="blog-details-container">
                    <a class="blog-title" href="/blog/{{$blog->url}}">{{$blog->title}}</a>
                    <span class="blog-author">By {{$blog->author}} | {{ Carbon\Carbon::parse($blog->created_at)->format('M d, Y')}}</span>
                    <div class="readnow-link">[<a href="/blog/{{$blog->url}}">Read Now</a>]</div>
                </div>
            </div>
        @endforeach
        <div class="simple-pagination">
            {{$allblogs->links()}}
        </div>
    @else
        <div class="searched-results-message-container">
            <span class="searched-results-message">Sorry! No Result Found</span>
        </div>
    @endif
</div>
<div class="social-buttons">
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}" target="_blank">
        <div class="social-icon-container">
            <img src="{{asset('images/social-icons/facebook.png')}}">
        </div>
    </a>
    <a href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}" target="_blank">
        <div class="social-icon-container">
            <img src="{{asset('images/social-icons/twitter.png')}}">
        </div>
    </a>
    <a href="https://plus.google.com/share?url={{ urlencode($url) }}" target="_blank">
        <div class="social-icon-container">
            <img src="{{asset('images/social-icons/googleplus.png')}}">
        </div>
    </a>
    <a href="https://pinterest.com/pin/create/button/?{{
        http_build_query([
            'url' => $url,
            'media' => $image,
            'description' => $description
        ]) 
        }}" target="_blank">
        <div class="social-icon-container">
                <img src="{{asset('images/social-icons/pinterest.png')}}">
        </div>
    </a>
    <a href="https://wa.me/?text={{ urlencode($url) }}" target="_blank">
        <div class="social-icon-container">
            <img src="{{asset('images/social-icons/whatsapp.png')}}">
        </div>
    </a>
</div>
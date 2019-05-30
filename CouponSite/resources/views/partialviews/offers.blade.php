<div class="fo-db-offers-list-container" id="fo-db-offers-list-container">
    @foreach($offers as $offer)
    <div class="fo-db-offerbody-container">
        <div class="fo-db-logo">
            <img src="{{$panel_assets_url.$offer->store->logo_url}}">
        </div>
        <div class="fo-db-action-container">
            <div class="fo-db-offer-container">
                <div class="fo-db-type-and-verified-container">
                    <span class="fo-db-offertype-code">{{$offer->location.' '.$offer->type}}</span>
                    @if(strcasecmp($offer->is_verified,'yes') == 0)
                    <span class="offer-verification-container"><i class="fa fa-check-circle"></i>Verfied</span>
                    @endif
                </div>
                <div class="fo-db-offertitle">{{$offer->title}}</div>
                <div class="fo-db-offerdetails">{{$offer->details}}</div>
                <div class="fo-db-offer-expires"><i class="fa fa-clock-o"></i>Expires: {{ Carbon\Carbon::parse($offer->expiry_date)->format('d/m/Y') }}</div>
            </div>
            <div class="fo-db-offer-button-container">
                @if(strcasecmp($offer->location,'Online & In-Store') == 0 && strcasecmp($offer->type, 'Code') == 0)
                <span class="offer-button" id="offer-button">
                    USE ONLINE
                </span>
                <span class="offer-button" id="offer-button">
                    USE IN-STORE
                </span>
                @else
                <span class="offer-button" id="offer-button">
                    @if(strcasecmp($offer->type,"code") == 0)
                        VIEW CODE
                    @else
                        GET DEAL
                    @endif
                </span>
                @endif
            </div>
        </div>
    </div>
    @endforeach
    {{ $offers->links() }}
</div>
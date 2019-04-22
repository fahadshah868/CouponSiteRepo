<div class="fo-detailbar-offers-list-container" id="fo-detailbar-offers-list-container">
    @foreach($filteredoffers as $filteredoffer)
    <div class="fo-detailbar-offerbody-container">
        <div class="fo-detailbar-logo">
            <img src="{{$panel_assets_url.$filteredoffer->store->logo_url}}">
        </div>
        <div class="fo-detailbar-action-container">
            <div class="fo-detailbar-offer-container">
                <div class="fo-detailbar-type-and-verified-container">
                    <span class="fo-detailbar-offertype-code">{{$filteredoffer->location.' '.$filteredoffer->type}}</span>
                    @if(strcasecmp($filteredoffer->is_verified,'yes') == 0)
                    <span class="store-offer-verification-container"><i class="fa fa-check-circle"></i>Verfied</span>
                    @endif
                </div>
                <div class="fo-detailbar-offertitle">{{$filteredoffer->title}}</div>
                <div class="fo-detailbar-offerdetails">{{$filteredoffer->details}}</div>
                <div class="fo-detailbar-offer-expires"><i class="fa fa-clock-o"></i>Expires: {{ Carbon\Carbon::parse($filteredoffer->expiry_date)->format('d/m/Y') }}</div>
            </div>
            <div class="fo-detailbar-offer-button-container">
                @if(strcasecmp($filteredoffer->location,'Online & In-Store') == 0)
                <span class="offer-button" id="offer-button">
                    USE ONLINE
                </span>
                <span class="offer-button" id="offer-button">
                    USE IN-STORE
                </span>
                @else
                <span class="offer-button" id="offer-button">
                    @if(strcasecmp($filteredoffer->type,"code") == 0)
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
    {{ $filteredoffers->links() }}
</div>
<div class="fo-db-offers-list-container" id="fo-db-offers-list-container">
    <input type="hidden" id="fo-offers-availability" value="{{$filteredoffers->total()}}">
    @foreach($filteredoffers as $filteredoffer)
    <div class="fo-db-offerbody-container">
        <div class="fo-db-logo">
            <img src="{{$panel_assets_url.$filteredoffer->store->logo_url}}">
        </div>
        <div class="fo-db-action-container">
            <div class="fo-db-offer-container">
                <div class="fo-db-type-and-verified-container">
                    <span class="fo-db-offertype-code">{{$filteredoffer->location.' '.$filteredoffer->type}}</span>
                    @if(strcasecmp($filteredoffer->is_verified,'yes') == 0)
                    <span class="offer-verification-container"><i class="fa fa-check-circle"></i>Verfied</span>
                    @endif
                </div>
                <div class="fo-db-offertitle">{{$filteredoffer->title}}</div>
                <div class="fo-db-offerdetails">{{$filteredoffer->details}}</div>
                <div class="fo-db-offer-expires"><i class="fa fa-clock-o"></i>Expires: {{ Carbon\Carbon::parse($filteredoffer->expiry_date)->format('d/m/Y') }}</div>
            </div>
            <div class="fo-db-offer-button-container">
                @if(strcasecmp($filteredoffer->location,'Online & In-Store') == 0 && strcasecmp($filteredoffer->type, 'Code') == 0)
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
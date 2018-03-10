
<div class="col-lg-4 col-md-4 col-sm-12 user-shopping ">
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 pull-left">
        <div class=" about-shop">
            <a href="{{ route('deatil.edit.form') }}" title="Edit Address Info">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </a>
            <h3>CONTACT ADDRESS</h3>

            @if(empty($consumerDetail)|| is_null($consumerDetail) )
                <label class="text text-primary">For Your Valuable Order Please Add Your Address.</label>
            @else

                @if(!is_null($consumerDetail->nationalId) || !empty($consumerDetail->nationalId))
                    <label> - Voter Id.: {{ $consumerDetail->nationalId }}</label>
                @endif
                @if(!is_null($consumerDetail->houseNo) || !empty($consumerDetail->houseNo))
                    <label> - House No.: {{ $consumerDetail->houseNo }}</label>
                @endif
                @if(!is_null($consumerDetail->roadNo) || !empty($consumerDetail->roadNo))
                    <label> - Road No.: {{ $consumerDetail->roadNo }}</label>
                @endif
                @if(!is_null($consumerDetail->village) || !empty($consumerDetail->village))
                    <label> - Village: {{ $consumerDetail->village }}</label>
                @endif
                <label> - Police Station: {{ $consumerDetail->policeStation }}</label>
                <label> - Post Office: {{ $consumerDetail->postOffice }}</label>
                <label> - Zip Code: {{ $consumerDetail->zipCode }}</label>
                <label> - District: {{ $consumerDetail->district }}</label>
                <label> - Country: {{ $consumerDetail->country }}</label>

            @endif
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 pull-left">
        <div class="about-shop">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-8 pull-left">
                    <h4>PAYMENT INFORMATION</h4>
                </div>

            </div>

            @if(empty($paymentDetail)|| is_null($paymentDetail) )
                <label class="text text-primary">Please Add Your Payment Information.</label>
            @else

                <label>  - Name on Card: {{ $paymentDetail-> cardHolderName}}</label>
                <label>  - Card Name : {{ $paymentDetail->cardName }}</label>
                <label>  - Card No. : {{ $paymentDetail->cardNumber }}</label>
                <label>  - Expiry Date : {{ $paymentDetail->exptDate }}</label>
                </P>
            @endif
        </div>
    </div>



</div>
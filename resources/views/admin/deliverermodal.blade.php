
{{--Edit Modal form--}}

<div class="form-group row">
    <label for="orgName" class="col-md-4 col-form-label text-md-right">{{ __('Deliverer Name*') }}</label>

    <div class="col-md-6">
        <input id="orgName" type="text" class="form-control{{ $errors->has('orgName') ? ' is-invalid' : '' }}" name="orgName" value="" required autofocus>

        @if ($errors->has('orgName'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('orgName') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group row">

    <div class="col-md-3">
        <input id="city" type="text"  placeholder="City*" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="" required autofocus>

        @if ($errors->has('city'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
        @endif
    </div>

    <div class="col-md-3">
        <input id="subcity" type="text" placeholder="Subcity*" class="form-control{{ $errors->has('subcity') ? ' is-invalid' : '' }}" name="subcity" value="" required autofocus>

        @if ($errors->has('city'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subcity') }}</strong>
                                    </span>
        @endif
    </div>

    <div class="col-md-3">
        <input id="woreda" type="number" min="0" placeholder="Woreda*" class="form-control{{ $errors->has('woreda') ? ' is-invalid' : '' }}" name="woreda" value="" required autofocus>

        @if ($errors->has('woreda'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('woreda') }}</strong>
                                    </span>
        @endif
    </div>

    <div class="col-md-3">
        <input id="houseno" type="number" min="0" placeholder="HouseNo*" class="form-control{{ $errors->has('houseno') ? ' is-invalid' : '' }}" name="houseno" value="" required autofocus>

        @if ($errors->has('houseno'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('houseno') }}</strong>
                                    </span>
        @endif
    </div>

</div>

<div class="form-group row">
    <label for="orgPhoneNo" class="col-md-4 col-form-label text-md-right">{{ __('Deliverer PhoneNumber*') }}</label>

    <div class="col-md-6">
        <input id="orgPhoneNo" type="number" class="form-control{{ $errors->has('orgPhoneNo') ? ' is-invalid' : '' }}" name="orgPhoneNo" value="" required autofocus>

        <input id="orgAltPhoneNo" type="number" placeholder="Alternative Phone" class="form-control" name="orgAltPhoneNo" value=""  autofocus>

        @if ($errors->has('orgPhoneNo'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('orgPhoneNo') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="orgEmail" class="col-md-4 col-form-label text-md-right">{{ __('Deliverer Email*') }}</label>

    <div class="col-md-6">
        <input id="orgEmail" type="email" class="form-control{{ $errors->has('orgEmail') ? ' is-invalid' : '' }}" name="orgEmail" value="" required autofocus>

        @if ($errors->has('orgEmail'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('orgEmail') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="aboutDelivery" class="col-md-4 col-form-label text-md-right">{{ __('About Deliverer') }}</label>

    <div class="col-md-7">
        <textarea id="aboutDelivery" type="text" rows="4" class="form-control" name="aboutDelivery" value=""  autofocus></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="deliveryPrice" class="col-md-4 col-form-label text-md-right">{{ __('Delivery Price*') }}</label>

    <div class="col-md-6">
        <input id="deliveryPrice" type="number" min="1" class="form-control{{ $errors->has('deliveryPrice') ? ' is-invalid' : '' }}" name="deliveryPrice" value="" required autofocus>

        @if ($errors->has('deliveryPrice'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('deliveryPrice') }}</strong>
                                    </span>
        @endif
    </div>
</div>
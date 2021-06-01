<div id="v-pills-paypalPay"
     class="tab-pane fade active show">
    <div class="form-group">
        <label
            for="exampleInputPassword1">{{trans('layout.client_id_key')}}</label>
        <input
            value="{{isset($payment_gateway->paypal_client_id)?$payment_gateway->paypal_client_id:''}}"
            type="text" name="paypal_client_id"
            class="form-control"
            placeholder="{{trans('layout.client_id_key')}}">
    </div>
    <div class="form-group">
        <label>{{trans('layout.client_secret_key')}}</label>
        <input
            value="{{isset($payment_gateway->paypal_secret_key)?$payment_gateway->paypal_secret_key:''}}"
            type="text" name="paypal_secret_key"
            class="form-control"
            placeholder="{{trans('layout.client_secret_key')}}">
    </div>
    <div class="form-group">
        <label for="paypal_status">{{trans('layout.status')}}</label>
        <select id="paypal_status" name="paypal_status" class="form-control">
            <option
                {{isset($payment_gateway->paypal_status) && $payment_gateway->paypal_status=='active'?'selected':''}} value="active">{{trans('layout.active')}}</option>
            <option
                {{isset($payment_gateway->paypal_status) && $payment_gateway->paypal_status=='inactive'?'selected':''}} value="inactive">{{trans('layout.inactive')}}</option>
        </select>
    </div>

</div>

<div id="v-pills-stripePay" class="tab-pane fade">
    <div class="form-group">
        <label>{{trans('layout.publish_key')}}</label>
        <input
            value="{{isset($payment_gateway->stripe_publish_key)?$payment_gateway->stripe_publish_key:''}}"
            type="text" name="stripe_publish_key"
            class="form-control"
            placeholder="{{trans('layout.publish_key')}}">
    </div>
    <div class="form-group">
        <label>{{trans('layout.secret_key')}}</label>
        <input
            value="{{isset($payment_gateway->stripe_secret_key)?$payment_gateway->stripe_secret_key:''}}"
            type="text" name="stripe_secret_key"
            class="form-control"
            placeholder="{{trans('layout.secret_key')}}">
    </div>
    <div class="form-group">
        <label
            for="stripe_status">{{trans('layout.status')}}</label>
        <select id="stripe_status" name="stripe_status"
                class="form-control">
            <option
                {{isset($payment_gateway->stripe_status) && $payment_gateway->stripe_status=='active'?'selected':''}} value="active">{{trans('layout.active')}}</option>
            <option
                {{isset($payment_gateway->stripe_status) && $payment_gateway->stripe_status=='inactive'?'selected':''}}  value="inactive">{{trans('layout.inactive')}}</option>
        </select>
    </div>
</div>

<div id="v-pills-paytm" class="tab-pane fade">
    <div class="form-group">
        <label for="paytm_environment">{{trans('layout.paytm_environment')}}</label>
        <select id="paytm_environment" name="paytm_environment"
                class="form-control">
            <option
                {{isset($payment_gateway->paytm_environment) && $payment_gateway->paytm_environment=='staging'?'selected':''}} value="staging">{{trans('Staging')}}</option>
            <option
                {{isset($payment_gateway->paytm_environment) && $payment_gateway->paytm_environment=='production'?'selected':''}}  value="production">{{trans('Production')}}</option>
        </select>
    </div>

    <div class="form-group">
        <label>{{trans('layout.paytm_mid')}}</label>
        <input
            value="{{isset($payment_gateway->paytm_mid)?$payment_gateway->paytm_mid:''}}"
            type="text" name="paytm_mid"
            class="form-control"
            placeholder="{{trans('layout.paytm_mid')}}">
    </div>
    <div class="form-group">
        <label>{{trans('layout.paytm_secret_key')}}</label>
        <input
            value="{{isset($payment_gateway->paytm_secret_key)?$payment_gateway->paytm_secret_key:''}}"
            type="text" name="paytm_secret_key"
            class="form-control"
            placeholder="{{trans('layout.paytm_secret_key')}}">
    </div>
    <div class="form-group">
        <label>{{trans('layout.paytm_website')}}</label>
        <input
            value="{{isset($payment_gateway->paytm_website)?$payment_gateway->paytm_website:''}}"
            type="text" name="paytm_website"
            class="form-control"
            placeholder="{{trans('layout.paytm_website')}}">
    </div>
    <div class="form-group">
        <label>{{trans('layout.paytm_txn_url')}}</label>
        <input
            value="{{isset($payment_gateway->paytm_txn_url)?$payment_gateway->paytm_txn_url:''}}"
            type="text" name="paytm_txn_url"
            class="form-control"
            placeholder="{{trans('layout.paytm_txn_url')}}">
    </div>
    <div class="form-group">
        <label
            for="paytm_status">{{trans('layout.status')}}</label>
        <select id="paytm_status" name="paytm_status"
                class="form-control">
            <option
                {{isset($payment_gateway->paytm_status) && $payment_gateway->paytm_status=='active'?'selected':''}} value="active">{{trans('layout.active')}}</option>
            <option
                {{isset($payment_gateway->paytm_status) && $payment_gateway->paytm_status=='inactive'?'selected':''}}  value="inactive">{{trans('layout.inactive')}}</option>
        </select>
    </div>
</div>

<div id="v-pills-mollie" class="tab-pane fade">
    <div class="form-group">
        <label>{{trans('layout.api_key')}}</label>
        <input
            value="{{isset($payment_gateway->mollie_api_key)?$payment_gateway->mollie_api_key:''}}"
            type="text" name="mollie_api_key"
            class="form-control"
            placeholder="{{trans('layout.api_key')}}">
    </div>

    <div class="form-group">
        <label
            for="mollie_status">{{trans('layout.status')}}</label>
        <select id="mollie_status" name="mollie_status"
                class="form-control">
            <option
                {{isset($payment_gateway->mollie_status) && $payment_gateway->mollie_status=='active'?'selected':''}} value="active">{{trans('layout.active')}}</option>
            <option
                {{isset($payment_gateway->mollie_status) && $payment_gateway->mollie_status=='inactive'?'selected':''}}  value="inactive">{{trans('layout.inactive')}}</option>
        </select>
    </div>
</div>

<div id="v-pills-paystack" class="tab-pane fade">
    <div class="form-group">
        <label>{{trans('layout.public_key')}}</label>
        <input
            value="{{isset($payment_gateway->paystack_public_key)?$payment_gateway->paystack_public_key:''}}"
            type="text" name="paystack_public_key"
            class="form-control"
            placeholder="{{trans('layout.public_key')}}">
    </div>
    <div class="form-group">
        <label>{{trans('layout.secret_key')}}</label>
        <input
            value="{{isset($payment_gateway->paystack_secret_key)?$payment_gateway->paystack_secret_key:''}}"
            type="text" name="paystack_secret_key"
            class="form-control"
            placeholder="{{trans('layout.secret_key')}}">
    </div>

    <div class="form-group">
        <label>{{trans('layout.payment_url')}}</label>
        <input
            value="{{isset($payment_gateway->paystack_payment_url)?$payment_gateway->paystack_payment_url:''}}"
            type="text" name="paystack_payment_url"
            class="form-control"
            placeholder="{{trans('layout.payment_url')}}">
    </div>

    <div class="form-group">
        <label>{{trans('layout.merchant_email').'('.trans('layout.optional').')'}}</label>
        <input
            value="{{isset($payment_gateway->paystack_merchant_email)?$payment_gateway->paystack_merchant_email:''}}"
            type="text" name="paystack_merchant_email"
            class="form-control"
            placeholder="{{trans('layout.merchant_email')}}">
    </div>

    <div class="form-group">
        <label
            for="paystack_status">{{trans('layout.status')}}</label>
        <select id="paystack_status" name="paystack_status"
                class="form-control">
            <option
                {{isset($payment_gateway->paystack_status) && $payment_gateway->paystack_status=='active'?'selected':''}} value="active">{{trans('layout.active')}}</option>
            <option
                {{isset($payment_gateway->paystack_status) && $payment_gateway->paystack_status=='inactive'?'selected':''}}  value="inactive">{{trans('layout.inactive')}}</option>
        </select>
    </div>
</div>

<div id="v-pills-offline" class="tab-pane fade">
    <div class="form-group">
        <label
            for="instruction">{{trans('layout.instruction')}}
            *</label>
        <textarea name="instructions" id="instruction" cols="30" class="form-control"
                  rows="3">{!! isset($payment_gateway->instructions)?clean($payment_gateway->instructions):'' !!}</textarea>

    </div>

    <div class="form-group mt-3">
        <label
            for="offline_status">{{trans('layout.status')}}</label>
        <select id="offline_status"
                name="offline_status"
                class="form-control">
            <option
                {{isset($payment_gateway->offline_status) && $payment_gateway->offline_status=='active'?'selected':''}} value="active">{{trans('layout.active')}}</option>
            <option
                {{isset($payment_gateway->offline_status) && $payment_gateway->offline_status=='inactive'?'selected':''}} value="inactive">{{trans('layout.inactive')}}</option>
        </select>
    </div>

</div>


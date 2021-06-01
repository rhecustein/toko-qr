@extends('layouts.dashboard')

@section('title',trans('layout.restaurant').' | '.$restaurant->name)

@section('css')
    <link href="{{asset('vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">

    <style>
        .dropdown.bootstrap-select.swal2-select {
            display: none !important;
        }

        body {
            background-color: white !important;
        }

        .hamburger {
            display: none !important;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css">
@endsection

@section('main-content')
    <div class="modern-design">
        <div id="restaurant-section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="profile card card-body px-3 pt-3 pb-0">
                        <div class="profile-head">
                            {{--  @if($restaurant->cover_image)
                                  <div class="photo-content">
                                      <div class="cover-wrapper">
                                          <img class="cover-img" src="{{asset('uploads/'.$restaurant->cover_image)}}" alt="">
                                      </div>
                                  </div>
                              @endif--}}
                            <div class="profile-info">
                                <div class="profile-photo m-0">
                                    <img src="{{asset('uploads/'.$restaurant->profile_image)}}"
                                         class="img-fluid" alt="">
                                </div>
                                <h2 class="text-left">{{$restaurant->name}}</h2>
                                <div class="res-description">
                                    {!! clean($restaurant->description) !!}
                                </div>
                                <div class="profile-details text-left">
                                    <div class="row">
                                        @if($restaurant->timing)
                                            <div class="col-6">
                                                <div class="profile-email">
                                                    <h4 class="text-muted mb-0"><i
                                                            class="fa fa-clock-o"></i> {{$restaurant->timing}}</h4>
                                                </div>
                                            </div>
                                        @endif
                                        @if($restaurant->location)
                                            <div class="col-6">
                                                <div class="profile-name">
                                                    <h4 class="text-muted mb-0"><i
                                                            class="fa fa-map-marker"></i> {{$restaurant->location}}</h4>
                                                </div>
                                            </div>
                                        @endif
                                        @if($restaurant->email)
                                            <div class="col-12">
                                                <div class="profile-email">
                                                    <h4 class="text-muted mb-0"><i
                                                            class="fa fa-envelope"></i> {{$restaurant->email}}</h4>
                                                </div>
                                            </div>
                                        @endif
                                        @if($restaurant->phone_number)
                                            <div class="col-12">
                                                <div class="profile-email">
                                                    <h4 class="text-muted mb-0"><i
                                                            class="fa fa-phone-square"></i> {{$restaurant->phone_number}}
                                                    </h4>
                                                </div>
                                            </div>
                                        @endif
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="item-lists">
            <div>
                <div class="category-list-wrapper row">
                    <div class="col-12">
                        <div id="category-list-ul-scroll" style="width: 400px;overflow:hidden;">
                            <ul class="category-list-ul navbar">
                                <li class="category-list active">{{trans('layout.all')}}</li>
                                @foreach($categories as $categoryName=>$categoryItems)
                                    <li data-id="{{$categoryItems[0]->category_id}}"
                                        class="category-list">{{$categoryName}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @foreach($categories as $categoryName=>$categoryItems)
                <div class="category-item-wrapper" id="category-item-wrapper-{{$categoryItems[0]->category_id}}">
                    <div class="container">
                        <div class="row category-name-section">
                            <div class="col-8">
                                <h2><span>{{$categoryName}}</span></h2>
                            </div>
                            <div class="col-4">
                                <div class="d-flex flex-row float-right">
                                    <div class="pl-2">
                            <span data-id="{{$categoryItems[0]->category_id}}" class="full-view">
                            <i class="fa fa-th"></i>
                                </span>
                                    </div>
                                    <div class="pl-2">
                            <span data-id="{{$categoryItems[0]->category_id}}" class="list-view">
                            <i class="fa fa-list active"></i>
                                </span>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div id="full-view-section-{{$categoryItems[0]->category_id}}" class="row full-view-section">
                            <div class="row">
                                @foreach($categoryItems as $item)
                                    <div class="col-4 col-lg-3">
                                        <div class="individual-grid-item">
                                            <div class="">
                                                <div class="new-arrival-product">
                                                    <div class="">
                                                        <div class="modern-price">
                                                            @if($item->discount>0)
                                                                @if($item->discount_type=='percent')
                                                                    <del>{{formatNumberWithCurrSymbol($item->price)}}</del> {{formatNumberWithCurrSymbol(($item->price-(($item->discount*$item->price)/100)))}}
                                                                @elseif($item->discount_type=='flat')
                                                                    <del>{{formatNumberWithCurrSymbol($item->price)}}</del> {{formatNumberWithCurrSymbol($item->price-$item->discount)}}
                                                                @endif
                                                            @else
                                                                {{formatNumberWithCurrSymbol($item->price)}}
                                                            @endif
                                                            @if($item->tax->title)
                                                                <div class="item-tax"
                                                                     id="item-tax-{{$item->category_id}}-{{$item->id}}"
                                                                     data-tax-type="{{$item->tax->type}}"
                                                                     data-tax="{{$item->tax->amount}}">
                                                                    <span> + </span>({{$item->tax->type=='percentage'?formatNumber($item->tax->amount).'%':formatNumberWithCurrSymbol($item->tax->amount)}} {{trans('layout.tax')}}
                                                                    )
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="new-arrival-content text-center mt-3">
                                                        <h4>{{$item->name}}</h4>
                                                        <span
                                                            class="d-block text-muted">{{mb_strimwidth($item->details, 0, 30, '...')}}</span>


                                                        <div class="text-center">
                                                            <button
                                                                data-extras="{{json_encode($item->active_extras)}}"
                                                                data-value="{{json_encode($item->only(['name','id','price','details','discount','discount_type','discount_to']))}}"
                                                                class="btn btn-rounded add-to-cart"><i
                                                                    class="fa fa-plus-circle"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div id="list-view-section-{{$categoryItems[0]->category_id}}" class="row list-view-section">
                            @foreach($categoryItems as $item)
                                <div class="col-xs-12 col-md-6 mb-3 single-item-wrapper">
                                    <div class="">
                                        <div class="">
                                            <div class="new-arrival-product">
                                                <div class="new-arrival-content mt-0">
                                                    <div class="row">
                                                        @if($item->image)
                                                            <div class="col-3">
                                                                <img class="item-image"
                                                                     src="{{asset('uploads/'.$item->image)}}" alt="">
                                                            </div>
                                                        @endif
                                                        <div class="col-{{!$item->image?'10 pl-3':'7 pl-1'}} ">
                                                            <h5 class="mb-0">{{$item->name}}</h5>
                                                            <span
                                                                class="d-block text-muted">{{mb_strimwidth($item->details, 0, 30, '...')}}</span>
                                                            <div class="modern-price">
                                                                @if($item->discount>0)
                                                                    @if($item->discount_type=='percent')
                                                                        <del>{{formatNumberWithCurrSymbol($item->price)}}</del> {{formatNumberWithCurrSymbol(($item->price-(($item->discount*$item->price)/100)))}}
                                                                    @elseif($item->discount_type=='flat')
                                                                        <del>{{formatNumberWithCurrSymbol($item->price)}}</del> {{formatNumberWithCurrSymbol($item->price-$item->discount)}}
                                                                    @endif
                                                                @else
                                                                    {{formatNumberWithCurrSymbol($item->price)}}
                                                                @endif
                                                                @if($item->tax->title)
                                                                    <div class="item-tax"
                                                                         id="item-tax-{{$item->category_id}}-{{$item->id}}"
                                                                         data-tax-type="{{$item->tax->type}}"
                                                                         data-tax="{{$item->tax->amount}}">
                                                                        <span> + </span>({{$item->tax->type=='percentage'?formatNumber($item->tax->amount).'%':formatNumberWithCurrSymbol($item->tax->amount)}} {{trans('layout.tax')}}
                                                                        )
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-2">

                                                            <div class="mt-2">
                                                                <button
                                                                    data-extras="{{json_encode($item->active_extras)}}"
                                                                    data-value="{{json_encode($item->only(['name','id','price','details','discount','discount_type','discount_to']))}}"
                                                                    class="btn btn-rounded add-to-cart"><i
                                                                        class="fa fa-plus-circle"></i>
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                </div>
            @endforeach
        </div>
        <div class="basket" id="basket">
            <span class="view-text">{{trans('layout.view_basket')}}</span>
        </div>
        <div class="add-overview w-100" id="add-overview">
            <form action="{{route('order.place')}}" method="post" id="orderForm">
                @csrf
                <input type="hidden" name="restaurant" value="{{$restaurant->id}}">
                <div class="row" id="orderOverviewSection">
                    <div class="col-xl-8 col-11">
                        <div class="card border-2-blue">
                            <div class="card-header border-0 pb-0">
                                <h5 class="card-title">{{trans('layout.overview')}}</h5>
                                <div id="close-overview" class="pull-right "><i class="fa fa-close"></i></div>
                            </div>
                            <div class="card-body">
                                <div class="order-items">

                                </div>
                            </div>
                            <div class="card-footer border-0 pt-0">
                                <p class="card-text d-inline">{{trans('layout.total')}}: <span></span> <span
                                        id="totalAmount">0</span>
                                <div class="item-tax-total" id="item-tax-total">
                                </div>
                                </p>
                                <a id="processCheckout" href="javascript:void(0)"
                                   class="btn btn-xs btn-primary float-right">{{trans('layout.process')}}</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row" id="paymentOverviewSection">
                    <div class="col-xl-8 col-11">
                        <div class="card border-2-blue">
                            <div class="card-header border-0 pb-0">
                                <h5 class="card-title">{{trans('layout.payment')}}</h5>
                                <div id="close-payment-overview" class="pull-right "><i class="fa fa-close"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="order-items-payment">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name">{{trans('layout.name')}}*</label>
                                            <input value="{{auth()->check()?auth()->user()->name:''}}" name="name"
                                                   type="text" class="form-control" id="name"
                                                   placeholder="Ex: Jone Doe"
                                                   required="">
                                            <span id="name-error" class="small text-danger p-2"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone">{{trans('layout.phone')}}</label>
                                            <input value="{{auth()->check()?auth()->user()->phone_number:''}}"
                                                   name="phone"
                                                   type="text" class="form-control" id="phone"
                                                   placeholder="Ex: +140139485764">
                                            <span id="phone-error" class="small text-danger p-2"></span>

                                        </div>
                                        @if(request()->get('table'))
                                            <div class="col-md-6 mb-3">
                                                <label for="table_id">{{trans('layout.table')}}</label>
                                                <select
                                                    {{request()->get('table')?'disabled="true"':''}} class="form-control">
                                                    @foreach($tables as $table)
                                                        <option
                                                            {{request()->get('table')==$table->id?'selected':''}} value="{{$table->id}}">{{$table->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        <div class="col-md-6 mb-3 {{request()->get('table')?'d-none':''}}">
                                            <label for="table_id">{{trans('layout.table')}}</label>
                                            <select name="table_id" id="table_id" class="form-control">
                                                @foreach($tables as $table)
                                                    <option
                                                        {{request()->get('table')==$table->id?'selected':''}} value="{{$table->id}}">{{$table->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="comment">{{trans('layout.comment')}}</label>
                                            <input name="comment" type="text" class="form-control" id="comment"
                                                   placeholder="Ex: Need extra spoon">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="d-block my-3">
                                                @php
                                                    $rest_gateway_credentials=get_restaurant_gateway_settings($restaurant->user_id);
                                                    $isPaymentEnable=false;
                                                @endphp
                                                @php $credentials=isset($rest_gateway_credentials)?json_decode($rest_gateway_credentials->value):''; @endphp

                                                @if(isset($credentials->offline_status) && $credentials->offline_status=='active')
                                                    @php $isPaymentEnable=true; // to enable submit button @endphp
                                                    <div class="custom-control custom-radio mb-2">
                                                        <input value="pay_on_table" id="pay_on_table" name="pay_type"
                                                               type="radio"
                                                               class="custom-control-input" checked="" required="">
                                                        <label class="custom-control-label"
                                                               for="pay_on_table">{{trans('layout.pay_on_table')}}</label>
                                                    </div>
                                                @endif

                                                <div class="custom-control custom-radio mb-2">
                                                    <input value="takeaway" id="takeaway" name="pay_type"
                                                           type="radio"
                                                           class="custom-control-input" required="">
                                                    <label class="custom-control-label"
                                                           for="takeaway">{{trans('layout.takeaway')}}</label>
                                                </div>

                                                @if((isset($credentials->paypal_status) && $credentials->paypal_client_id && $credentials->paypal_secret_key && $credentials->paypal_status=='active') ||
    (isset($credentials->stripe_status) && $credentials->stripe_publish_key && $credentials->stripe_secret_key && $credentials->stripe_status=='active') ||
    (isset($credentials->paytm_environment) && $credentials->paytm_mid && $credentials->paytm_secret_key && $credentials->paytm_website && $credentials->paytm_txn_url && $credentials->paytm_status=='active') ||
    (isset($credentials->mollie_status) && $credentials->mollie_api_key && $credentials->mollie_status=='active') ||
    (isset($credentials->paystack_public_key) && $credentials->paystack_secret_key && $credentials->paystack_status=='active'))
                                                    @php $isPaymentEnable=true; // to enable submit button @endphp

                                                    <div class="custom-control custom-radio mb-2">
                                                        <input value="pay_now" id="pay_now"
                                                               name="pay_type"
                                                               type="radio"
                                                               class="custom-control-input" required="">
                                                        <label class="custom-control-label"
                                                               for="pay_now">{{trans('layout.pay_now')}}</label>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 takeaway-section" style="display: none">
                                        <label for="time">{{trans('layout.time')}}*</label>
                                        <select name="time" id="time" class="form-control">
                                            {!! generateOrderSlot() !!}
                                        </select>
                                    </div>

                                    <div class="pay-now-section">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="d-block my-3">

                                                    @if($rest_gateway_credentials && $credentials)

                                                        @if(isset($credentials->paypal_status) && $credentials->paypal_client_id && $credentials->paypal_secret_key && $credentials->paypal_status=='active')
                                                            <div class="custom-control custom-radio mb-2">
                                                                <input id="paypal" name="paymentMethod" type="radio"
                                                                       class="custom-control-input"
                                                                       required="" checked="" value="paypal">
                                                                <label class="custom-control-label"
                                                                       for="paypal">{{trans('layout.paypal')}}</label>
                                                            </div>
                                                        @endif


                                                        @if(isset($credentials->paytm_environment) && $credentials->paytm_mid && $credentials->paytm_secret_key && $credentials->paytm_website && $credentials->paytm_txn_url && $credentials->paytm_status=='active')
                                                            <div class="custom-control custom-radio mb-2">
                                                                <input id="paytm" name="paymentMethod" type="radio"
                                                                       class="custom-control-input"
                                                                       required="" value="paytm">
                                                                <label class="custom-control-label"
                                                                       for="paytm">{{trans('layout.paytm')}}</label>
                                                            </div>
                                                        @endif

                                                        @if(isset($credentials->mollie_status) && $credentials->mollie_api_key && $credentials->mollie_status=='active')
                                                            <div class="custom-control custom-radio mb-2">
                                                                <input id="mollie" name="paymentMethod" type="radio"
                                                                       class="custom-control-input"
                                                                       required="" value="mollie">
                                                                <label class="custom-control-label"
                                                                       for="mollie">{{trans('layout.mollie')}}</label>
                                                            </div>
                                                        @endif
                                                        @if(isset($credentials->paystack_public_key) && $credentials->paystack_secret_key && $credentials->paystack_status=='active')
                                                            <div class="custom-control custom-radio mb-2">
                                                                <input id="paystack" name="paymentMethod" type="radio"
                                                                       class="custom-control-input"
                                                                       required="" value="paystack">
                                                                <label class="custom-control-label"
                                                                       for="paystack">{{trans('layout.paystack')}}</label>
                                                            </div>
                                                        @endif
                                                        @if(isset($credentials->stripe_status) && $credentials->stripe_publish_key && $credentials->stripe_secret_key && $credentials->stripe_status=='active')
                                                            <div class="custom-control custom-radio mb-2">
                                                                <input id="credit" name="paymentMethod" type="radio"
                                                                       class="custom-control-input"
                                                                       required="" value="stripe">
                                                                <label class="custom-control-label"
                                                                       for="credit">{{trans('Credit or Debit card')}}</label>
                                                            </div>
                                                        @endif

                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-payment-section">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div id="card-element"
                                                     class="border-1-gray p-3 border-radius-1"></div>
                                                <div id="card-errors" role="alert"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-0 pt-0">
                                <p class="card-text d-inline">{{trans('layout.total')}}: <span
                                        id="totalAmountToPayment">0</span>
                                <div class="item-tax-total"></div>
                                </p>
                                @if($isPaymentEnable)
                                    <a id="place-order" href="javascript:void(0)"
                                       class="btn btn-xs btn-primary float-right place-order disabled">{{trans('layout.place_order')}}</a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>

        <div class="modal fade" id="extraModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th style="width:50px;">
                                        <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">
                                            <input type="checkbox" class="custom-control-input" id="checkAll"
                                                   required="">
                                            <label class="custom-control-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th><strong>{{trans('layout.title')}}</strong></th>
                                    <th><strong>{{trans('layout.price')}}</strong></th>
                                    <th><strong>{{trans('layout.quantity')}}</strong></th>
                                    <th><strong>{{trans('layout.amount')}}</strong></th>
                                </tr>
                                </thead>
                                <tbody id="extraTable">
                                <tr>

                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{asset('vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>

    <script src="{{asset('js/jquery-vertical-scroll.js')}}"></script>
    <script !src="">

        $(document).ready(function () {
            var slider = tns({
                container: '.category-list-ul',
                items: 4.2,
                autoplay: false,
                mouseDrag: true,
                controls: false,
                loop: false,
                freezable: false,
                nav: false
            });
            slider.events.on('dragMove', function (info, eventName) {
                $('.category-list').attr('data-dragging', true);
            });
            slider.events.on('dragEnd', function (info, eventName) {
                setTimeout(function () {
                    console.log("drag end");
                    $('.category-list').attr('data-dragging', false);
                }, 500);

            });
        });
    </script>
    @if(isset($credentials->stripe_status) && $credentials->stripe_status=='active')
        <script src="https://js.stripe.com/v3/"></script>
        <script !src="">
            "use strict";
            // Create a Stripe client.
            var stripe = Stripe('{{$credentials->stripe_publish_key}}');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.on('change', function (event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
        </script>
    @endif

    <script>

        // Handle form submission.
        var btn = document.getElementById('place-order');
        btn.addEventListener('click', function (event) {
            event.preventDefault();
            $('#name-error').text('');
            var name = document.getElementById('name');
            if (!name.value) {
                $('#name-error').text('Enter your name');
                return true;
            }
            $(this).attr('disabled', 'disabled').addClass('disabled')
            $(this).html(' <i class="fa fa-spinner fa-spin"></i> Loading');
            let credit = document.getElementById('credit');
            if (credit && credit.checked) {
                $.ajax({
                    method: 'get',
                    url: '{{route('get.stripe.token')}}',
                    data: {amount: calculateTotal(),user_id:'{{$restaurant->user_id}}'},
                    success: function (res) {
                        console.log(res);
                        stripe.confirmCardPayment(res.client_secret, {
                            payment_method: {
                                card: card
                            }
                        }).then(function (result) {
                                var displayError = document.getElementById('card-errors');
                                if (result.error) {
                                    // Show error to your customer
                                    displayError.textContent = result.error.message;
                                } else {
                                    // The payment succeeded!
                                    stripeTokenHandler(result.paymentIntent.id);
                                }
                            });
                    }
                })

            } else {

                $('input[type=radio][name=pay_type]').each(function (index, value) {

                    if ($(value).is(':checked')) {
                        $('input[type=radio][name=paymentMethod]').each(function (i, v) {
                            if ($(v).is(':checked')) $('#orderForm').attr('data-can', 'true');
                        });
                    }
                    if ($(value).val() == 'pay_on_table') $('#orderForm').attr('data-can', 'true');

                });


                var form = $('#orderForm');
                if (form.attr('data-can') == 'true') {
                    form.submit();
                } else {
                    $('#place-order').addClass('disabled')
                }
            }
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('orderForm');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>

    <script !src="">
        const currencySymbol = '{{isset(json_decode(get_settings('local_setting'))->currency_symbol)?json_decode(get_settings('local_setting'))->currency_symbol:'$'}}';

        Number.prototype.number_format = function (decimals, dec_point, thousands_sep) {
            let number = this.valueOf();
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        };
        Number.prototype.formatNumber = function () {
            const decimal_format = '{{isset(json_decode(get_settings('local_setting'))->decimal_format)?json_decode(get_settings('local_setting'))->decimal_format:'.'}}';
            const decimals = '{{isset(json_decode(get_settings('local_setting'))->decimals)?json_decode(get_settings('local_setting'))->decimals:'2'}}';
            const thousand_separator = '{{isset(json_decode(get_settings('local_setting'))->thousand_separator)?json_decode(get_settings('local_setting'))->thousand_separator:','}}';
            return this.valueOf().number_format(decimals, decimal_format, thousand_separator);
        };
        Number.prototype.formatNumberWithCurrSymbol = function () {
            const symbol_position = '{{isset(json_decode(get_settings('local_setting'))->currency_symbol_position)?json_decode(get_settings('local_setting'))->currency_symbol_position:'after'}}';

            if (symbol_position == 'after') {
                return this.valueOf().formatNumber() + currencySymbol;
            } else if (symbol_position == 'before') {
                return currencySymbol + this.valueOf().formatNumber();
            }

        };

        function calculateTotal() {
            let total = 0;
            $('.row-total').each((index, value) => {
                total += parseFloat($(value).text());
            });
            total += calculateExtraTotal();
            $('#totalAmount').text(total.formatNumberWithCurrSymbol());
            $('#totalAmountToPayment').text(total.formatNumberWithCurrSymbol());
            return total;
        }

        function calculateTotalTax() {
            let total = 0;
            $('.row-tax').each((index, value) => {
                const quantity = $("#input-item-quantity-" + $(value).attr('data-item-id')).val();
                if (quantity)
                    total += parseFloat($(value).val()) * quantity;
            });
            if (total > 0) {
                $('.item-tax-total').html("+<span>" + total.formatNumberWithCurrSymbol() + " {{trans('layout.tax')}}</span>");
            }
        }

        $(document).on('click', '.item-category', function (e) {
            e.preventDefault();
            $('.hamburger').click();
            $('#restaurant-section').hide();
            $('#item-lists').show();
            $('.category-item-wrapper').hide();
            $('#category-item-wrapper-' + $(this).attr('data-id')).show();
        });
        $(document).on('click', '.add-to-cart', function (e) {
            e.preventDefault();
            $('#add-overview').animate({bottom: '0px'});
            $('#orderOverviewSection').show();
            $('#paymentOverviewSection').hide();


            const item = JSON.parse($(this).attr('data-value'));
            const itemExtras = $(this).attr('data-extras');

            const taxSection = $('#item-tax-' + item.category_id + '-' + item.id);
            let taxAmount = 0;
            let taxType = '';
            if (taxSection.length > 0) {
                taxAmount = parseFloat(taxSection.attr('data-tax'));
                taxType = taxSection.attr('data-tax-type');
            }
            if (taxType && taxType == 'percentage') {
                taxAmount = (taxAmount * item.price) / 100;
            }


            let singleItem = $('#single-item-' + item.id).length;
            let singleItemHtml = '';
            let discount = item.discount;
            let discountedPrice = 0;
            if (item.discount_type == 'flat') {
                discountedPrice = item.price - discount;
            } else if (item.discount_type == 'percent') {
                discountedPrice = (item.price * discount) / 100;
                discountedPrice = item.price - discountedPrice;
            }
            if (singleItem <= 0) {
                singleItemHtml = `<div class="single-item" id="single-item-${item.id}">
                                    <div class="item-details">
                                        <div class="item-title">${item.name}</div>
                                            <input type="hidden" name="item_id[]" value="${item.id}">
                                            <input type="hidden" class="row-tax" data-item-id="${item.id}" id="item-individual-tax-${item.id}" value="${taxAmount}">
                                            <input type="hidden" name="item_quantity[]" value="1" id="input-item-quantity-${item.id}">
                                        <div class="item-price"><span class="item-individual-currency-symbol"></span> <span class="item-individual-price d-none">${discountedPrice}</span> <span>${discountedPrice.formatNumberWithCurrSymbol()}</span></div>
                                    </div>
                                   <div style="position:relative;display:${itemExtras != '[]' ? 'initial' : 'none'}">
                                   <span data-id="${item.id}" data-item-name="${item.name}" data-extras='${itemExtras}' class="item-extra">{{trans('layout.extra')}}</span>
                                   <div class="extra-list">
                                   </div>
                                   </div>

                                    <div class="modify-item">
                                        <span class="d-none row-total">${discountedPrice}</span>
                                        <div data-id="${item.id}" class="minus-quantity">
                                            <i class="fa fa-minus"></i>
                                        </div>
                                        <div id="item-quantity-${item.id}" class="item-quantity">1</div>
                                        <div data-id="${item.id}" class="plus-quantity" id="plus-quantity-${item.id}">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>`;
            } else {
                $('#plus-quantity-' + item.id).click();
            }
            $('.order-items').append(singleItemHtml);
            calculateTotal();
            calculateTotalTax();

            if ($('#totalAmount').text() != '0') {
                $('#basket').show();
            } else {
                $('#basket').hide();
            }

        });

        $('#close-overview,#close-payment-overview').on('click', function (e) {
            $('#add-overview').animate({bottom: '-1000px'});
        });

        $(document).on('click', '.minus-quantity', function (e) {
            e.preventDefault();
            let price = parseFloat($(this).parent().parent().find('.item-individual-price').first().text());
            let quantity = parseInt($(this).parent().find('.item-quantity').first().text());
            quantity--;
            if (quantity <= 0) $(this).parent().parent().remove();
            $(this).parent().find('.item-quantity').text(quantity);
            const total = quantity * price;
            $(this).parent().find('.row-total').text(total);
            $('#input-item-quantity-' + $(this).attr('data-id')).val(quantity);
            calculateTotal();
            calculateTotalTax();
        });

        $(document).on('click', '.plus-quantity', function (e) {
            e.preventDefault();
            let price = parseFloat($(this).parent().parent().find('.item-individual-price').first().text());
            let quantity = parseInt($(this).parent().find('.item-quantity').first().text());
            quantity++;
            $(this).parent().find('.item-quantity').text(quantity);
            const total = quantity * price;
            $(this).parent().find('.row-total').text(total);
            $('#input-item-quantity-' + $(this).attr('data-id')).val(quantity);
            calculateTotal();
            calculateTotalTax();
        });

        $('#processCheckout').on('click', function (e) {
            e.preventDefault();
            $('#orderOverviewSection').hide();
            $('#paymentOverviewSection').show();
        });

        $('input[type=radio][name=pay_type]').change(function () {
            if (this.value == 'pay_on_table') {
                $('.pay-now-section').hide();
                $('.card-payment-section').hide();
            } else if (this.value == 'pay_now') {
                $('.pay-now-section').show();
                $('.takeaway-section').hide();
            } else if (this.value == 'takeaway') {
                $('.pay-now-section').hide();
                $('.card-payment-section').hide();
                $('.takeaway-section').show();
            }
            checkPayType();
        });

        $('input[type=radio][name=paymentMethod]').change(function () {
            if (this.value == 'paypal') {
                $('.card-payment-section').hide();
            } else if (this.value == 'paytm') {
                $('.card-payment-section').hide();
            } else if (this.value == 'stripe') {
                $('.card-payment-section').show();
            } else if (this.value == 'mollie') {
                $('.card-payment-section').hide();
            } else if (this.value == 'paystack') {
                $('.card-payment-section').hide();
            }
            checkPayType();
        });

        function changePreSelectedQuan(section_id, change_id, changedQuantity) {
            let preSelected = $('#single-item-' + section_id + ' .item-extra').attr('data-pre-selected-extra');
            if (preSelected) {
                preSelected = JSON.parse(preSelected);
                const remainExtra = preSelected.filter(extra => extra.id != change_id);
                const preQuantity = preSelected.find(extra => extra.id == change_id);
                const newExtra = {
                    id: change_id,
                    quantity: changedQuantity
                };
                remainExtra.push(newExtra);

                $('#single-item-' + section_id + ' .item-extra').attr('data-pre-selected-extra', JSON.stringify(remainExtra));

            }


        }

        $(document).on('click', '.item-extra', function (e) {
            e.preventDefault();
            const name = $(this).attr('data-item-name');
            let extras = $(this).attr('data-extras');
            const sectionid = $(this).attr('data-id');
            $('#extraModal .modal-title').text(name + " - {{trans('layout.extra')}}");
            let preSelected = $('#single-item-' + sectionid + ' .item-extra').attr('data-pre-selected-extra');
            if (preSelected) {
                preSelected = JSON.parse(preSelected);
            } else {
                preSelected = [];
            }
            let preExtras = [];

            $.each(preSelected, (index, extra) => {
                preExtras.push(extra.id);
            });

            let trHtml = '';
            extras = JSON.parse(extras);
            $.each(extras, (index, extra) => {
                const currentExtra = preSelected.find(pextra => pextra.id == extra.id);
                trHtml += ` <tr>
                             <td>
                                    <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">
                                        <input ${preExtras.includes(extra.id.toString()) ? 'checked=true' : ''} data-section-id="${sectionid}" data-id="${extra.id}" type="checkbox" class="custom-control-input select-extra-checkbox" id="extraCheckbox${extra.id}">
                                        <label class="custom-control-label" for="extraCheckbox${extra.id}"></label>
                                    </div>
                              </td>
                            <td><span id="extra-indi-title-${extra.id}">${extra.title}</span></td>
                            <td><span>${parseFloat(extra.price).formatNumber()}</span><span class="d-none" id="extra-indi-price-${extra.id}">${extra.price}</span></td>
                            <td><div class="extra-item-action">
                                        <div data-section-id="${sectionid}" data-id="${extra.id}" class="extra-minus-quantity">
                                            <i class="fa fa-minus"></i>
                                        </div>
                                        <div id="extra-item-quantity-${extra.id}" class="extra-item-quantity">${currentExtra ? currentExtra.quantity : 1}</div>
                                        <div data-section-id="${sectionid}" data-id="${extra.id}" class="extra-plus-quantity" id="extra-plus-quantity-${extra.id}">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div></td>
                            <td><span id="extra-amount-indi-total-${extra.id}" class="extra-amount">${parseFloat(currentExtra ? currentExtra.quantity * extra.price : extra.price).formatNumberWithCurrSymbol()}</span></td>
                            </tr>
                           `;
            });

            $('#extraTable').html(trHtml);
            $('.select-extra-checkbox').trigger('change');
            $('#extraModal').modal('show');
        });

        $(document).on('click', '.extra-minus-quantity', function (e) {
            e.preventDefault();
            const section_id = $('#checkAll').attr('data-section-id');
            const id = $(this).attr('data-id');
            const quantityEl = $('#extra-item-quantity-' + id);
            const price = parseFloat($('#extra-indi-price-' + id).text());
            let preQuantity = parseInt(quantityEl.text());
            --preQuantity;
            if (preQuantity > 0) {
                quantityEl.text(preQuantity);
                const total = preQuantity * price;
                $('#extra-amount-indi-total-' + id).text(total.formatNumberWithCurrSymbol());
            }
            changePreSelectedQuan(section_id, id, preQuantity);
            $('.select-extra-checkbox').trigger('change');
            calculateTotal();
            calculateTotalTax();
        });

        $(document).on('click', '.extra-plus-quantity', function (e) {
            e.preventDefault();
            const section_id = $('#checkAll').attr('data-section-id');
            const id = $(this).attr('data-id');
            const quantityEl = $('#extra-item-quantity-' + id);
            const price = parseFloat($('#extra-indi-price-' + id).text());
            let preQuantity = parseInt(quantityEl.text());
            ++preQuantity;
            if (preQuantity > 0) {
                quantityEl.text(preQuantity);
                const total = preQuantity * price;
                $('#extra-amount-indi-total-' + id).text(total.formatNumberWithCurrSymbol());
            }
            changePreSelectedQuan(section_id, id, preQuantity);
            $('.select-extra-checkbox').trigger('change');
            calculateTotal();
            calculateTotalTax();
        });

        $(document).on('change', '.select-extra-checkbox', function (e) {
            const section_id = $(this).attr('data-section-id');
            const id = $(this).attr('data-id');
            const quantityEl = $('#extra-item-quantity-' + id);
            const price = parseFloat($('#extra-indi-price-' + id).text());
            const title = $('#extra-indi-title-' + id).text();
            const quantity = parseInt(quantityEl.text());
            $('.appended-extra-item-' + section_id + '-' + id).remove();
            $('#checkAll').attr('data-section-id', section_id);

            if ($(this).is(':checked')) {
                $('#single-item-' + section_id + ' .extra-list').append(`<span class="font-xs appended-extra-item-${section_id}-${id}">${quantity} ${title}=${(quantity * price).formatNumberWithCurrSymbol()}<br><input data-price="${price}" class="input-extra-quantity" type="hidden" name="extra_quantity[${id}]" value="${quantity}"></span>`);
                let preSelected = $('#single-item-' + section_id + ' .item-extra').attr('data-pre-selected-extra');
                if (preSelected)
                    preSelected = JSON.parse(preSelected);
                else
                    preSelected = [];

                let newSelected = {
                    id: id,
                    quantity: quantity
                };
                preSelected.push(newSelected);
                $('#single-item-' + section_id + ' .item-extra').attr('data-pre-selected-extra', JSON.stringify(preSelected));
            } else {
                let preSelected = $('#single-item-' + section_id + ' .item-extra').attr('data-pre-selected-extra');
                if (preSelected) {
                    preSelected = JSON.parse(preSelected);
                    const remainExtra = preSelected.filter(extra => extra.id != id);
                    $('#single-item-' + section_id + ' .item-extra').attr('data-pre-selected-extra', JSON.stringify(remainExtra));
                }

            }
            calculateTotal();
            calculateTotalTax();
        });

        $('#checkAll').on('change', function (e) {
            const section_id = $(this).attr('data-section-id');

            if ($(this).is(':checked')) {
                $('.select-extra-checkbox').trigger('change');
            } else {
                $('#single-item-' + section_id + ' .extra-list').html('');
                $('#single-item-' + section_id + ' .item-extra').attr('data-pre-selected-extra', JSON.stringify([]));
            }
        });

        function checkPayType() {
            $('input[type=radio][name=pay_type]').each(function (index, value) {
                if ($(value).is(':checked')) {
                    $('input[type=radio][name=paymentMethod]').each(function (i, v) {
                        if ($(v).is(':checked')) $('#place-order').removeClass('disabled');
                    });
                }
                if ($(value).val() == 'pay_on_table') $('#place-order').removeClass('disabled');
            });
        }

        checkPayType();

        function calculateExtraTotal() {
            let total = 0;
            $('.input-extra-quantity').each(function (index, value) {
                const quantity = $(value).val();
                const price = parseFloat($(value).attr('data-price'));
                total += quantity * price;
            });
            return total;
        }

        $('#basket').on('click', function (e) {
            e.preventDefault();
            if ($('#totalAmount').text() != '0') {
                $('#add-overview').animate({bottom: '0px'});
                $('#orderOverviewSection').show();
                $('#paymentOverviewSection').hide();
            }
        });

        $(document).on('click', '.full-view', function (e) {
            const id = $(this).attr('data-id');
            $('#category-item-wrapper-' + id + ' .list-view i').removeClass('active');
            $('#full-view-section-' + id).show();
            $('#list-view-section-' + id).hide();

            $(this).find('i').addClass('active');
        });

        $(document).on('click', '.list-view', function (e) {
            const id = $(this).attr('data-id');
            $('#category-item-wrapper-' + id + ' .full-view i').removeClass('active');
            $('#list-view-section-' + id).show();
            $('#full-view-section-' + id).hide();

            $(this).find('i').addClass('active');
        });
        $(document).on('click', '.category-list', function (e) {
            if ($(this).attr('data-dragging') == 'true') {
                e.preventDefault();
                console.log($(this).attr('data-dragging'));
                return;
            }
            const id = $(this).attr('data-id');

            $('.category-list-ul .category-list').removeClass('active');
            $('.category-item-wrapper').hide();
            if (id) {
                $('#category-item-wrapper-' + id).show();
            } else {
                $('.category-item-wrapper').show();
            }
            $(this).addClass('active');
        });
        $('#time').select2();
    </script>
    @if(session()->has('order-success'))
        <script !src="">
            swal("Great!!", '{{session()->get('order-success')}}', "success");
        </script>
    @endif
@endsection

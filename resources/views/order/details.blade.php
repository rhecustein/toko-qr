@extends('layouts.dashboard')

@section('title',trans('layout.order_details'))

@section('main-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="pull-right">
                <button class="btn btn-sm btn-info" id="print" type="button">{{trans('layout.print')}}</button>
                <button class="btn btn-sm btn-info" id="pdf" type="button">{{trans('layout.pdf')}}</button>
            </div>
        </div>
    </div>
    <div class="row" id="printableSection">
        <div class="col-lg-12">

            <div class="card mt-3">
                <div class="card-header"> {{trans('layout.details')}} <strong>{{trans('layout.order')}}
                        #{{$order->id}}</strong> <span
                        class="float-right">
                                    <strong>{{trans('layout.status')}}:</strong> {{$order->status}}</span></div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                            <h6>{{trans('layout.customer')}}:</h6>
                            <div><strong>{{$order->name}}</strong></div>
                            @if($order->user)
                                <div>{{trans('layout.email')}}: {{$order->user->email}}</div>
                            @endif
                            <div>{{trans('layout.phone')}}: {{$order->phone_number}}</div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>{{trans('layout.item')}}</th>
                                <th>{{trans('layout.quantity')}}</th>
                                <th>{{trans('layout.price')}}</th>
                                <th>{{trans('layout.discount')}}</th>
                                <th>{{trans('layout.tax')}}</th>
                                <th>{{trans('layout.total_price')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $discount=0;$totalTax=0; @endphp
                            @foreach($order->details as $key=>$details)
                                @php $discount+=$details->discount; @endphp
                                @php $totalTax+=$details->tax_amount; @endphp
                                <tr>
                                    <td class="center">{{$key+1}}</td>
                                    <td>{{$details->item->name}}
                                        @if($order->extras()->where('item_id',$details->item_id)->count()>0)
                                            <br>
                                            <span class="details-item-extra">{{trans('layout.extra')}}: </span>
                                            @foreach($order->extras()->where('item_id',$details->item_id)->get() as $key=>$extra)
                                                <span
                                                    class="details-item-extra-indi">{{$extra->quantity}} {{$extra->title}}</span>@if($key<$order->extras()->where('item_id',$details->item_id)->count()-1)
                                                    ,@endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{$details->quantity}}</td>
                                    <td>{{formatNumber($details->item->price)}}</td>
                                    <td>{{formatNumber($details->discount)}}</td>
                                    <td>{{formatNumber($details->tax_amount)}}</td>
                                    <td>{{formatNumber($details->total+$details->tax_amount)}}
                                        @if($order->extras()->where('item_id',$details->item_id)->count()>0)
                                            <br>
                                            @php $totalExtra=0 @endphp
                                            <span class="details-item-extra">{{trans('layout.extra')}}: </span>
                                            @foreach($order->extras()->where('item_id',$details->item_id)->get() as $key=>$extra)
                                                @php $totalExtra+=($extra->price*$extra->quantity) @endphp
                                            @endforeach
                                            <span class="details-item-extra-indi">{{formatNumber($totalExtra)}}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5">
                            @if($order->comment)
                                <strong>{{trans('layout.comment')}}:</strong> <br>
                                {{$order->comment}}
                            @endif
                        </div>
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                <tr>
                                    <td class="left"><strong>{{trans('layout.total_discount')}}</strong></td>
                                    <td class="right">{{formatNumberWithCurrSymbol($discount)}}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>{{trans('layout.total_tax')}}</strong></td>
                                    <td class="right">{{formatNumberWithCurrSymbol($totalTax)}}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>{{trans('layout.total')}}</strong></td>
                                    <td class="right">{{formatNumberWithCurrSymbol($order->total_price)}}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script !src="">
        "use strict";
        $('#print').on('click', function (e) {
            e.preventDefault();
            window.open('{{route('order.print',['id'=>$order->id])}}');
        });

        $('#pdf').on('click', function (e) {
            e.preventDefault();
            window.open('{{route('order.print',['id'=>$order->id])}}&type=pdf');
        })
    </script>
@endsection

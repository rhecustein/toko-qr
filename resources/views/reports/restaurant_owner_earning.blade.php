@extends('layouts.dashboard')

@section('title',trans('layout.report'))

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endsection

@section('main-content')
    <div class="row page-titles mx-0">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <input type="hidden" name="earning" value="{{request()->get('earning')}}">
                        <div class="row">
                            <div class="col-3">
                                <select name="restaurant_id" id="restaurant_id" class="form-control"
                                        title="{{trans('layout.restaurant_select')}}">
                                    <option {{request()->get('restaurant_id')=='all'?'selected':''}} value="all">{{trans('layout.all')}}</option>
                                    @foreach($restaurants as $restaurant)
                                        <option
                                            {{request()->get('restaurant_id')==$restaurant->id?'selected':''}} value="{{$restaurant->id}}">{{$restaurant->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="order_type" id="order_type" class="form-control" title="{{trans('layout.select_type')}}">
                                    <option {{request()->get('order_type')=='all'?'selected':''}} value="all">{{trans('layout.all')}}</option>
                                    <option  {{request()->get('order_type')=='pay_on_table'?'selected':''}} value="pay_on_table">{{trans('layout.pay_on_table')}}</option>
                                    <option  {{request()->get('order_type')=='pay_now'?'selected':''}} value="pay_now">{{trans('layout.pay_now')}}</option>
                                    <option  {{request()->get('order_type')=='takeaway'?'selected':''}} value="takeaway">{{trans('layout.takeaway')}}</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <input value="{{request()->get('from_to_dates')}}" type="text" class="form-control" name="from_to_dates">
                            </div>
                            <div class="col-3 pt-2">
                                <button type="submit" class="btn btn-sm btn-primary">{{trans('layout.submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{trans('layout.report')}}</h4>
                    <a class="btn btn-info btn-xs" href="{{route('report.index')}}">{{trans('layout.show_plan_report')}}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                            <tr>
                                <th><strong>{{trans('layout.restaurant')}}</strong></th>
                                <th><strong>{{trans('layout.customer')}}</strong></th>
                                <th><strong>{{trans('layout.created_at')}}</strong></th>
                                <th><strong>{{trans('layout.cost')}}</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $totalCost=0; @endphp
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->restaurant->name}} </td>
                                    <td>{{$order->name}}</td>
                                    <td>{{formatDate($order->created_at)}}</td>
                                    @php $totalCost+=$order->total_price @endphp
                                    <td>{{formatNumberWithCurrSymbol($order->total_price)}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"></td>
                                <td class="text-right">{{trans('layout.total')}}:</td>
                                <td class="font-weight-bold">{{formatNumberWithCurrSymbol($totalCost)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $('input[name="from_to_dates"]').daterangepicker();
    </script>
@endsection

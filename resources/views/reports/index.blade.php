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
                        <div class="row">
                            <div class="col-3">
                                <select name="customer_id" id="customer_id" class="form-control"
                                        title="{{trans('layout.select_customer')}}">
                                    <option  {{request()->get('customer_id')=='all'?'selected':''}} value="all">{{trans('layout.all')}}</option>
                                @foreach($customers as $customer)
                                        <option
                                            {{request()->get('customer_id')==$customer->id?'selected':''}} value="{{$customer->id}}">{{$customer->name}}
                                            ({{$customer->email}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="plan_id" id="plan_id" class="form-control"
                                        title="{{trans('layout.select_plan')}}">
                                    <option {{request()->get('plan_id')=='all'?'selected':''}} value="all">{{trans('layout.all')}}</option>
                                    @foreach($plans as $plan)
                                        <option
                                            {{request()->get('plan_id')==$plan->id?'selected':''}} value="{{$plan->id}}">{{$plan->title}}
                                            ({{formatNumberWithCurrSymbol($plan->cost)}})
                                        </option>
                                    @endforeach
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
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                            <tr>
                                <th><strong>{{trans('layout.name')}}</strong></th>
                                <th><strong>{{trans('layout.plan_name')}}</strong></th>
                                <th><strong>{{trans('layout.cost')}}</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $totalCost=0; @endphp
                            @foreach($userPlans as $userPlan)
                                <tr>
                                    <td> @if($userPlan->user->name)<a title="{{$userPlan->user->email}}"
                                                                      class="text-blue"
                                                                      href="{{route('customers.edit',['user'=>$userPlan->user])}}">{{$userPlan->user->name}}</a> @endif
                                    </td>
                                    <td> @if($userPlan->plan->title)<a class="text-blue"
                                                                       href="{{route('plan.edit',['plan'=>$userPlan->plan])}}">{{$userPlan->plan->title}}</a> @endif
                                    </td>
                                    @php $totalCost+=$userPlan->cost @endphp
                                    <td>{{formatNumberWithCurrSymbol($userPlan->cost)}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
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

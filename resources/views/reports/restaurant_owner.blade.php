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
                            <div class="col-5">
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
                            <div class="col-4">
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
                    <a class="btn btn-info btn-xs" href="{{route('report.index',['earning'=>'true'])}}">{{trans('layout.show_earning')}}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                            <tr>
                                <th><strong>{{trans('layout.plan_name')}}</strong></th>
                                <th><strong>{{trans('layout.start_date')}}</strong></th>
                                <th><strong>{{trans('layout.expiry_date')}}</strong></th>
                                <th><strong>{{trans('layout.cost')}}</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $totalCost=0; @endphp
                            @foreach($userPlans as $userPlan)
                                <tr>
                                    <td>{{$userPlan->plan->title}} </td>
                                    <td>{{formatDate($userPlan->start_date)}}</td>
                                    <td>{{formatDate($userPlan->expired_date)}}</td>
                                    @php $totalCost+=$userPlan->cost @endphp
                                    <td>{{formatNumberWithCurrSymbol($userPlan->cost)}}</td>
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

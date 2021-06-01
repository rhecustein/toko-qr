@extends('layouts.dashboard')

@section('title',trans('layout.customer'))

@section('css')

@endsection

@section('main-content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>{{trans('layout.customer')}}</h4>
                <p class="mb-0"></p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{trans('layout.home')}}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{trans('layout.customer')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{trans('layout.list')}}</h4>
                    <div class="pull-right">
                        <a href="{{route('customers.create')}}" class="btn btn-sm btn-primary">{{trans('layout.create')}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                            <tr>
                                <th><strong>#</strong></th>
                                <th><strong>{{trans('layout.name')}}</strong></th>
                                <th><strong>{{trans('layout.plan_name')}}</strong></th>
                                <th><strong>{{trans('layout.expiry_date')}}</strong></th>
                                <th><strong>{{trans('layout.status')}}</strong></th>
                                <th><strong>{{trans('layout.action')}}</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $key=> $customer)
                                @php $currentPlan=isset($customer->current_plans[0])?$customer->current_plans[0]:''; @endphp
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$currentPlan?ucwords($currentPlan->plan->title):''}}</td>
                                    <td>{{$currentPlan?$customer->current_plans[0]->expired_date:''}}</td>
                                    <td>{{$currentPlan?ucwords($customer->current_plans[0]->status):''}}</td>
                                    <td>
                                        <a href="{{route('customers.edit',[$customer])}}" class="btn btn-info btn-sm"
                                           type="button">{{trans('layout.edit')}}</a>
                                        <button class="btn btn-danger btn-sm" type="button"
                                                data-message="{{trans('layout.message.customer_delete_warning')}}"
                                                data-action='{{route('customers.destroy',[$customer])}}'
                                                data-input={"_method":"delete"}
                                                data-toggle="modal"
                                                data-target="#modal-confirm">{{trans('layout.delete')}}</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection

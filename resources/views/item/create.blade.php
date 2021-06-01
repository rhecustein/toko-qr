@extends('layouts.dashboard')

@section('title',trans('layout.item_create'))

@section('css')

@endsection

@section('main-content')
    <div class="row page-titles mx-0">
        <div class="col-sm-12 text-center">
            <h5 class="text-red font-weight-bolder">{{$extend_message}}</h5>
        </div>
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>{{trans('layout.item')}}</h4>
                <p class="mb-0">{{trans('layout.item_create')}}</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{trans('layout.home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('item.index')}}">{{trans('layout.item')}}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{trans('layout.create')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{trans('layout.create')}}</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('item.store')}}" method="post" id="step-form-horizontal"
                          class="step-form-horizontal" enctype="multipart/form-data">
                        @include('item.form')
                        <div class="pull-right">
                            <button {{$extend_message?'disabled':''}} class="btn btn-primary btn-sm" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        let extraCount=1;
        $(document).on('click','.add_extra',function(e){
            e.preventDefault();
            const html=`<div class="row" id="extraSection${extraCount}">
                    <div class="col-lg-4 mb-2">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input name="extra_title[]" type="text" class="form-control" placeholder="{{trans('layout.add_extra_name')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input name="extra_price[]" step="0.0001"  type="number" min="0" class="form-control" placeholder="{{trans('layout.enter_price')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 mb-2">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <select name="extra_status[]" class="form-control">
                                    <option value="active">{{trans('layout.active')}}</option>
                                    <option value="inactive">{{trans('layout.inactive')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 mb-2">
                        <div class="form-group row mt-2">
                                <button data-section=${extraCount} type="button" class="btn btn-xs btn-danger delete-extra"><i class="la la-trash"></i></button>
                        </div>
                    </div>
                </div>`;

            $('#extraItemAddSection').append(html);
            extraCount++;
        });
        $(document).on('click','.delete-extra',function(e){
            e.preventDefault();
            const sectionId=$(this).attr('data-section');
            $('#extraSection'+sectionId).remove();
        })
    </script>

@endsection

@extends('layouts.dashboard')

@section('title',trans('layout.restaurant').' | '.$restaurant->name)

@section('css')

@endsection

@section('main-content')
    <div id="restaurant-section">

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        @if($restaurant->cover_image)
                            <div class="photo-content">
                                <div class="cover-wrapper-custom">
                                    <img class="cover-img" src="{{asset('uploads/'.$restaurant->cover_image)}}" alt="">
                                </div>
                            </div>
                        @endif

                        <div class="text-center mt-3">
                            <h2>{{$restaurant->name}}</h2>
                        </div>
                        <div class="text-center">
                            {!! clean($restaurant->description) !!}
                        </div>
                            <hr>
                        <div class="text-center">
                            @foreach($categories as $categoryName=>$categoryItems)
                                <div class="row">
                                    <div class="col-lg-12">
                                    @foreach($categoryItems as $item)
                                        <div data-href="{{asset('uploads/'.$item->image)}}" class="btn custom-button">{{$item->name}}</div>
                                    @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script !src="">
        $('.custom-button').on('click',function (e) {
            e.preventDefault();
            location.href=$(this).attr('data-href')
        })
    </script>

@endsection

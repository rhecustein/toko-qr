@csrf
<div>
    <h4>{{trans('layout.general_info')}}</h4>
    <section>
        <div class="row">
            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.name')}}*</label>
                    <input value="{{old('name')?old('name'):(isset($restaurant)?$restaurant->name:'')}}" type="text" name="name" class="form-control" placeholder="Ex: The Disaster Cafe" required>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.location')}}</label>
                    <input value="{{old('location')?old('location'):(isset($restaurant)?$restaurant->location:'')}}" type="text" name="location" class="form-control" placeholder="Ex: 2806 Montague Rd, BC, Canada">
                </div>

            </div>
            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.email')}}</label>
                    <input value="{{old('email')?old('email'):(isset($restaurant)?$restaurant->email:'')}}" type="email" name="email" class="form-control" placeholder="example@example.com">
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.phone_number')}}</label>
                    <input value="{{old('phone_number')?old('phone_number'):(isset($restaurant)?$restaurant->phone_number:'')}}" type="text" name="phone_number" class="form-control" placeholder="(+0)000-000-0000">
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.timing')}}</label>
                    <input value="{{old('timing')?old('timing'):(isset($restaurant)?$restaurant->timing:'')}}" type="text" name="timing" class="form-control" placeholder="Ex: 8:00 - 20:00">
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.status')}}*</label>
                    <select name="status" class="form-control">
                        <option {{isset($restaurant) && $restaurant->status=='active'?'selected':''}} value="active">{{trans('layout.active')}}</option>
                        <option {{isset($restaurant) && $restaurant->status=='inactive'?'selected':''}} value="inactive">{{trans('layout.inactive')}}</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-12 mb-3">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.description')}}*</label>
                    <textarea rows="10" name="description" class="form-control" placeholder="Ex: The Disaster Cafe will deliver, with 7.8 richter scale earthquakes simulated during meals" required>{{old('description')?old('description'):(isset($restaurant)?$restaurant->description:'')}}</textarea>
                </div>
            </div>
        </div>
    </section>
    <h4>{{trans('layout.image_upload')}}</h4>
    <section>
        <div class="row">
            <div class="col-lg-12 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.profile')}}</label>
                    @if(isset($restaurant) && $restaurant->profile_image)
                        <img style="max-width: 50px" src="{{asset('uploads').'/'.$restaurant->profile_image}}" alt="{{$restaurant->profile_image}}">
                    @endif
                    <input type="file" name="profile_file" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="col-lg-12 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.cover')}}</label>
                    @if(isset($restaurant) && $restaurant->cover_image)
                        <img style="max-width: 50px" src="{{asset('uploads').'/'.$restaurant->cover_image}}" alt="{{$restaurant->cover_image}}">
                    @endif
                    <input type="file" name="cover_file" class="form-control" accept="image/*">
                </div>
            </div>
        </div>
    </section>
    <h4>{{trans('layout.choose_template')}}</h4>
    <section>
        <h4 class="mb-4">{{trans('layout.choose_template')}}</h4>
        <div class="form-group mb-0">
            <label class="radio-inline mr-3 restaurant-template"><input {{isset($restaurant) && $restaurant->template=='classic'?'checked':''}} type="radio" name="template" value="classic">
                <span>{{trans('layout.classic')}}</span>
                <img class="max-h-300" src="{{asset('images/classic_template.jpg')}}" alt="Classic Template" >

            </label>
            <label class="radio-inline mr-3 restaurant-template"><input {{isset($restaurant) && $restaurant->template=='modern'?'checked':''}} type="radio" name="template" value="modern">
                <span>{{trans('layout.modern')}}</span>
                <img class="max-h-300" src="{{asset('images/modern_template.png')}}" alt="Modern Template">

            </label>
            <label class="d-none radio-inline mr-3 restaurant-template"><input {{isset($restaurant) && $restaurant->template=='flipbook'?'checked':''}} type="radio" name="template" value="flipbook">
                <span>{{trans('layout.flipbook')}}</span>
                <img class="max-h-300" src="{{asset('images/classic_template.jpg')}}" alt="Flipbook Template">
            </label>
            <label class="d-none radio-inline mr-3 restaurant-template"><input {{isset($restaurant) && $restaurant->template=='custom'?'checked':''}} type="radio" name="template" value="custom">
                <span>{{trans('layout.custom')}}</span>
                <img class="max-h-300" src="{{asset('images/custom-preview.svg')}}" alt="Custom Template">
            </label>
        </div>
    </section>
</div>

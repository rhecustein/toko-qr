@csrf
<div class="custom-tab-1">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#basic"><i
                    class="la la-border-all mr-2"></i>{{trans('layout.basic')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#extra"><i
                    class="la la-plus-square mr-2"></i> {{trans('layout.extra')}}</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="basic" role="tabpanel">
            <div class="pt-4">

                <div>
                    <section>
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <div class="form-group">
                                    <label class="text-label">{{trans('layout.restaurant')}}*</label>
                                    <select name="restaurant_id" class="form-control">
                                        @foreach($restaurants as $restaurant)
                                            <option
                                                {{isset($item) && $item->restaurant_id==$restaurant->id?'selected':''}} value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-2">
                                <div class="form-group">
                                    <label class="text-label">{{trans('layout.category')}}*</label>
                                    <div class="pull-right"><a class="btn-info btn btn-xs mb-1"
                                                               href="{{route('category.create')}}">New</a></div>
                                    <select name="category_id" class="form-control">
                                        @foreach($categories as $category)
                                            <option
                                                {{isset($item) && $item->category_id==$category->id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-2">
                                <div class="form-group">
                                    <label class="text-label">{{trans('layout.item_name')}}*</label>
                                    <input value="{{old('name')?old('name'):(isset($item)?$item->name:'')}}" type="text"
                                           name="name"
                                           class="form-control" placeholder="Ex: Burger" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="form-group">
                                    <label class="text-label">{{trans('layout.item_details')}}</label>
                                    <input value="{{old('details')?old('details'):(isset($item)?$item->details:'')}}"
                                           type="text" name="details"
                                           class="form-control" placeholder="Ex: A great burger">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="form-group">
                                    <label class="text-label">{{trans('layout.price')}}*</label>
                                    <input value="{{old('price')?old('price'):(isset($item)?$item->price:'')}}" min="0"
                                           step="0.001" name="price"
                                           class="form-control" placeholder="Ex: 20" required>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-2 d-none">
                                <div class="form-group">
                                    <label class="text-label">{{trans('layout.discount_to')}}*</label>
                                    <select name="discount_to" class="form-control">
                                        <option
                                            {{isset($item) && $item->discount_to=='everyone'?'selected':''}} value="everyone">
                                            Everyone
                                        </option>
                                        <option
                                            {{isset($item) && $item->discount_to=='premium'?'selected':''}} value="premium">
                                            Premium
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-2">
                                <div class="form-group">
                                    <label class="text-label">{{trans('layout.tax')}}</label>
                                    <select name="tax_id" class="form-control">
                                        @foreach($taxes as $tax)
                                        <option
                                            {{isset($item) && $tax->id==$item->tax_id?'selected':''}} value="{{$tax->id}}">
                                          {{$tax->title}} ({{$tax->type=='flat'?formatNumberWithCurrSymbol($tax->amount):formatNumber($tax->amount).'%'}})
                                        </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-2">
                                <div class="form-group">
                                    <label class="text-label">{{trans('layout.discount')}}*</label>
                                    <input value="{{old('discount')?old('discount'):(isset($item)?$item->discount:'')}}"
                                           min="0" step="0.001" type="number" name="discount"
                                           class="form-control" placeholder="Ex: 5" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="form-group">
                                    <label class="text-label">{{trans('layout.discount_type')}}*</label>
                                    <select name="discount_type" class="form-control">
                                        <option
                                            {{isset($item) && $item->discount_type=='flat'?'selected':''}} value="flat">
                                            Flat
                                        </option>
                                        <option
                                            {{isset($item) && $item->discount_type=='percent'?'selected':''}} value="percent">
                                            Percent
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label class="text-label">{{trans('layout.item_image')}}</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="item_image" type="file" class="custom-file-input">
                                        <label class="custom-file-label">{{trans('layout.choose')}}</label>

                                    </div>

                                </div>
                            </div>


                            <div class="col-lg-6 mb-2">
                                <div class="form-group">
                                    <label class="text-label">{{trans('layout.status')}}*</label>
                                    <select name="status" class="form-control">
                                        <option
                                            {{isset($item) && $item->status=='active'?'selected':''}} value="active">
                                            Active
                                        </option>
                                        <option
                                            {{isset($item) && $item->status=='inactive'?'selected':''}} value="inactive">
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </section>

                </div>

            </div>
        </div>
        <div class="tab-pane fade" id="extra">
            <div class="pt-4">
                <h4>{{trans('layout.item_extra')}}</h4>
                @isset($item)
                    @foreach($item->extras as $key=>$extra)
                        <div class="row" id="extraSection{{$key}}">

                            <div class="col-lg-4 mb-2">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input name="extra_title[]" type="text" value="{{$extra->title}}" class="form-control"
                                               placeholder="{{trans('layout.add_extra_name')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-2">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input name="extra_price[]" type="number" value="{{$extra->price}}" step="0.0001"  min="0" class="form-control"
                                               placeholder="{{trans('layout.enter_price')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 mb-2">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <select name="extra_status[]" class="form-control">
                                            <option {{$extra->status=='active'?'selected':''}} value="active">{{trans('layout.active')}}</option>
                                            <option {{$extra->status=='inactive'?'selected':''}} value="inactive">{{trans('layout.inactive')}}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-2 mb-2">
                                <div class="form-group row mt-2">
                                    <button data-section="{{$key}}" type="button" class="btn btn-xs btn-danger delete-extra"><i class="la la-trash"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @endisset

                <div id="extraItemAddSection"></div>
                <div class="row">
                    <div class="col-lg-2 mb-2">
                        <button type="button"
                                class="btn btn-xs btn-info add_extra">{{trans('layout.add_extra')}}</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

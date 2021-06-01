@csrf
<div>
    <section>
        <div class="row">

            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.title')}}*</label>
                    <input value="{{old('title')?old('title'):(isset($tax)?$tax->title:'')}}" type="text" name="title"
                           class="form-control" placeholder="Ex: Tax-1" required>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.type')}}*</label>
                    <select name="type" class="form-control">
                        <option {{isset($tax) && $tax->type=='flat'?'selected':''}}
                                value="flat">{{trans('layout.flat')}}</option>
                        <option {{isset($tax) && $tax->type=='percentage'?'selected':''}}
                                value="percentage">{{trans('layout.percentage')}}</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.amount')}}*</label>
                    <input value="{{old('amount')?old('amount'):(isset($tax)?$tax->amount:'')}}" type="text" name="amount"
                           class="form-control" placeholder="Ex: 12" required>
                </div>
            </div>

            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.status')}}*</label>
                    <select name="status" class="form-control">
                        <option {{isset($tax) && $tax->status=='active'?'selected':''}}
                            value="active">{{trans('layout.active')}}</option>
                        <option {{isset($tax) && $tax->status=='inactive'?'selected':''}}
                            value="inactive">{{trans('layout.inactive')}}</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

</div>

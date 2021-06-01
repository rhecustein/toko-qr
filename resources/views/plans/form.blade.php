@csrf
<div>
    <section>
        <div class="row">
            <div class="col-lg-12 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.title')}}*</label>
                    <input value="{{old('title')?old('title'):(isset($plan)?$plan->title:'')}}" type="text" name="title"
                           class="form-control" placeholder="Ex: Basic" required>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.recurring_type')}}*</label>
                    <select name="recurring_type" class="form-control">
                        <option
                            {{isset($plan) && $plan->recurring_type=='onetime'?'selected':''}} value="onetime">{{trans('layout.onetime')}}</option>
                        <option
                            {{isset($plan) && $plan->recurring_type=='weekly'?'selected':''}} value="weekly">{{trans('layout.weekly')}}</option>
                        <option
                            {{isset($plan) && $plan->recurring_type=='monthly'?'selected':''}} value="monthly">{{trans('layout.monthly')}}</option>
                        <option
                            {{isset($plan) && $plan->recurring_type=='yearly'?'selected':''}} value="yearly">{{trans('layout.yearly')}}</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.status')}}*</label>
                    <select name="status" class="form-control">
                        <option
                            {{isset($plan) && $plan->status=='active'?'selected':''}} value="active">{{trans('layout.active')}}</option>
                        <option
                            {{isset($plan) && $plan->status=='inactive'?'selected':''}} value="inactive">{{trans('layout.inactive')}}</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.cost')}}*</label>
                    <input value="{{old('cost')?old('cost'):(isset($plan)?$plan->cost:'')}}" min="0" step="0.001" type="number" name="cost"
                           class="form-control" placeholder="Ex: 200" required>
                </div>
            </div>

            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.table_limit')}}*</label>
                    <div class="is-unlimited">
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    {{trans('layout.is_unlimited')}} <input data-name="table_limit" {{isset($plan) && $plan->table_unlimited=='yes'?'checked':''}} name="is_table_unlimited" type="checkbox" class="form-check-input isUnlimited" value="yes">
                                </label>
                            </div>
                        </div>
                    </div>
                    <input style="display: {{isset($plan) && $plan->table_unlimited=='yes'?'none':'block'}}"
                           value="{{old('table_limit')?old('table_limit'):(isset($plan)?$plan->table_limit:0)}}"
                           type="number" name="table_limit"
                           class="form-control" placeholder="Ex: 5" required min="0" step="0.001">
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.restaurant_limit')}}*</label>
                    <div class="is-unlimited">
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    {{trans('layout.is_unlimited')}} <input data-name="restaurant_limit" {{isset($plan) && $plan->restaurant_unlimited=='yes'?'checked':''}} name="is_restaurant_unlimited" type="checkbox" class="form-check-input isUnlimited" value="yes">
                                </label>
                            </div>
                        </div>
                    </div>
                    <input style="display: {{isset($plan) && $plan->restaurant_unlimited=='yes'?'none':'block'}}"
                        value="{{old('restaurant_limit')?old('restaurant_limit'):(isset($plan)?$plan->restaurant_limit:0)}}"
                        type="number" name="restaurant_limit"
                        class="form-control" placeholder="Ex: 5" required min="0" step="0.001">
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.item_limit')}}*</label>
                    <div class="is-unlimited">
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    {{trans('layout.is_unlimited')}} <input data-name="item_limit" {{isset($plan) && $plan->item_unlimited=='yes'?'checked':''}} name="is_item_unlimited" type="checkbox" class="form-check-input isUnlimited" value="yes">
                                </label>
                            </div>
                        </div>
                    </div>
                    <input style="display: {{isset($plan) && $plan->item_unlimited=='yes'?'none':'block'}}"
                           value="{{old('item_limit')?old('item_limit'):(isset($plan)?$plan->item_limit:0)}}"
                           type="number" name="item_limit"
                           class="form-control" placeholder="Ex: 5" required min="0" step="0.001">
                </div>
            </div>

        </div>
    </section>

</div>

<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\OrderDetails;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{

    public function index()
    {
        $data['items'] = auth()->user()->items;
        return view('item.index', $data);
    }

    public function create()
    {
        $data['restaurants'] = auth()->user()->active_restaurants;
        $data['categories'] = auth()->user()->active_categories;
        $data['taxes'] = auth()->user()->active_taxes;

        $data['extend_message'] = '';

        $user = auth()->user();
        if ($user->type != 'admin') {
            $userPlan = isset($user->current_plans[0]) ? $user->current_plans[0] : '';
            $userItems = $user->items()->count();
            if ((!$userPlan || $userItems >= $userPlan->item_limit ) && $userPlan->item_unlimited!='yes') {
                $data['extend_message']=trans('layout.item_extends');
            }
        }

        return view('item.create', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            "restaurant_id" => "required",
            "category_id" => "required",
            "name" => "required",
            "price" => "required | numeric|gt:-1",
            "discount_to" => "in:everyone,premium",
            "discount" => "numeric|gt:-1",
            "discount_type" => "in:flat,percent",
            "status" => "required|in:active,inactive",
            'item_image' => 'image',
            'extra_price.*' => 'numeric|min:0',
            'extra_status.*' => 'in:active,inactive',
        ]);
        $user = auth()->user();
        if ($user->type != 'admin') {
            $userPlan = isset($user->current_plans[0]) ? $user->current_plans[0] : '';
            $userItems = $user->items()->count();
            if ((!$userPlan || $userItems >= $userPlan->item_limit) && $userPlan->item_unlimited!='yes' ){
                return redirect()->back()->withErrors(['msg' => trans('layout.item_extends')]);
            }
        }

        if ($request->hasFile('item_image')) {
            $file = $request->file('item_image');
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('/uploads'), $imageName);
            $request['image'] = $imageName;
        }

        DB::beginTransaction();
        try{
            $item=$user->items()->create($request->all());

            if($request->extra_title) {
                $item->extras()->createMany(collect($request->extra_title)->map(function ($day, $key) use ($request) {
                    if ($request->extra_title[$key] && isset($request->extra_price[$key]) && $request->extra_status[$key]) {
                        return [
                            'title' => $request->extra_title[$key],
                            'price' => $request->extra_price[$key],
                            'status' => $request->extra_status[$key],
                        ];
                    }


                })->toArray());
            }
            DB::commit();
            return redirect()->route('item.index')->with('success', trans('layout.message.item_create'));
        }catch (\Exception $ex){
            DB::rollBack();
        }

    }

    public function edit(Item $item)
    {
        $data['item'] = $item;
        $data['restaurants'] = auth()->user()->active_restaurants;
        $data['categories'] = auth()->user()->active_categories;
        $data['taxes'] = auth()->user()->active_taxes;
        return view('item.edit', $data);
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            "restaurant_id" => "required",
            "category_id" => "required",
            "name" => "required",
            "price" => "required | numeric|gt:-1",
            "discount_to" => "in:everyone,premium",
            "discount" => "numeric|gt:-1",
            "discount_type" => "in:flat,percent",
            "status" => "required|in:active,inactive",
            'item_image' => 'image',
            'extra_price.*' => 'numeric|min:0',
            'extra_status.*' => 'in:active,inactive',
        ]);

      //  dd($request->all());

        if ($request->hasFile('item_image')) {

            $this->deleteItemImage($item);
            $file = $request->file('item_image');
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('/uploads'), $imageName);
            $request['image'] = $imageName;
        }


        DB::beginTransaction();
        try{
           $item->update($request->all());

           if($request->extra_title) {
               $extraData = [];
               $i = 0;
               foreach ($request->extra_title as $key => $extra) {
                   if ($request->extra_title[$key] && $request->extra_price[$key] && $request->extra_status[$key]) {
                       $extraData[$i]['title'] = $request->extra_title[$key];
                       $extraData[$i]['price'] = $request->extra_price[$key];
                       $extraData[$i]['status'] = $request->extra_status[$key];
                       $i++;
                   }
               }
               $item->extras()->delete();
               $item->extras()->createMany($extraData);
           }else{
               $item->extras()->delete();
           }
            DB::commit();
            return redirect()->route('item.index')->with('success', trans('layout.message.item_update'));
        }catch (\Exception $ex){
            DB::rollBack();
            Log::error($ex->getMessage());
            return redirect()->route('item.index')->withErrors(['msg'=> trans('layout.message.update_failed')]);
        }
    }

    public function destroy(Item $item)
    {
        $order_details = OrderDetails::where('item_id', $item->id)->first();
        if ($order_details) return redirect()->back()->withErrors(['msg' => trans('layout.message.item_not_delete')]);

        $this->deleteItemImage($item);

        $item->delete();
        return redirect()->back()->with('success', trans('layout.message.item_delete'));
    }

    function deleteItemImage(Item $item)
    {
        if ($item->image) {
            $fileN = public_path('uploads') . '/' . $item->image;
            if (File::exists($fileN))
                unlink($fileN);
        }
    }

}

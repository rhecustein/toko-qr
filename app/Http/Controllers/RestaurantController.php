<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomMenu;
use App\Models\CustomMenuDetails;
use App\Models\CustomMenuTempFiles;
use App\Models\Item;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use function PHPUnit\Framework\returnArgument;

class RestaurantController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        if ($user->type == 'admin') {
            $data['restaurants'] = Restaurant::all();
        } else {
            $data['restaurants'] = $user->restaurants;
        }
        return view('restaurant.index', $data);
    }


    public function create()
    {
        $user = auth()->user();

        $data['extend_message'] = '';
        $userPlan = isset($user->current_plans[0]) ? $user->current_plans[0] : '';
        $userRestaurants = $user->restaurants()->count();
        if (($user->type != 'admin' && (!$userPlan || $userRestaurants >= $userPlan->restaurant_limit)) && $userPlan->restaurant_unlimited!='yes') {
            $data['extend_message'] = trans('layout.restaurant_extends');
        }


        return view('restaurant.create', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'profile_file' => 'image',
            'cover_file' => 'image',
            'template' => 'required|in:classic,modern,flipbook,custom',
        ]);

        $user = auth()->user();
        if ($user->type != 'admin') {
            $userPlan = isset($user->current_plans[0]) ? $user->current_plans[0] : '';
            $userRestaurants = $user->restaurants()->count();
            if ((!$userPlan || $userRestaurants >= $userPlan->restaurant_limit) && $userPlan->restaurant_unlimited!='yes') {
                return redirect()->back()->withErrors(['msg' => trans('layout.restaurant_extends')]);
            }
        }

        if($user->type=='admin') $request['verified_at']=now();


        if ($request->hasFile('profile_file')) {
            $file = $request->file('profile_file');
            $imageName = time() . 'p.' . $file->extension();
            $file->move(public_path('/uploads'), $imageName);
            $request['profile_image'] = $imageName;
        }

        if ($request->hasFile('cover_file')) {
            $file = $request->file('cover_file');
            $imageName = time() . 'c.' . $file->extension();
            $file->move(public_path('/uploads'), $imageName);
            $request['cover_image'] = $imageName;
        }
        $request['slug'] = Str::slug($request->name);
        $request['description'] = clean($request->description);
        $user->restaurants()->create($request->all());

        return redirect()->route('restaurant.index')->with('success', trans('layout.message.restaurant_create'));

    }


    public function edit(Restaurant $restaurant)
    {
        $data['restaurant'] = $restaurant;
        return view('restaurant.edit', $data);
    }


    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'profile_file' => 'image',
            'cover_file' => 'image',
            'template' => 'required|in:classic,modern,flipbook,custom',
        ]);


        if ($request->hasFile('profile_file')) {

            if ($restaurant->profile_image) {
                $fileN = public_path('uploads') . '/' . $restaurant->profile_image;
                if (File::exists($fileN))
                    unlink($fileN);
            }

            $file = $request->file('profile_file');
            $imageName = time() . 'p.' . $file->extension();
            $file->move(public_path('/uploads'), $imageName);
            $request['profile_image'] = $imageName;
        }

        if ($request->hasFile('cover_file')) {
            if ($restaurant->cover_image) {
                $fileN = public_path('uploads') . '/' . $restaurant->cover_image;
                if (File::exists($fileN))
                    unlink($fileN);
            }
            $file = $request->file('cover_file');
            $imageName = time() . 'c.' . $file->extension();
            $file->move(public_path('/uploads'), $imageName);
            $request['cover_image'] = $imageName;
        }
        $request['slug'] = Str::slug($request->name);
        $request['description'] = clean($request->description);

        $restaurant->update($request->all());

        return redirect()->route('restaurant.index')->with('success', trans('layout.message.restaurant_update'));
    }


    public function destroy(Restaurant $restaurant)
    {
        $item = Item::where('restaurant_id', $restaurant->id)->first();
        if ($item) return redirect()->back()->withErrors(['msg' => trans('layout.message.restaurant_not_delete')]);

        $this->deleteRestaurantImage($restaurant);

        $restaurant->delete();
        return redirect()->back()->with('success', trans('layout.message.restaurant_delete'));
    }

    function deleteRestaurantImage(Restaurant $restaurant)
    {
        if ($restaurant->profile_image) {
            $fileN = public_path('uploads') . '/' . $restaurant->profile_image;
            if (File::exists($fileN))
                unlink($fileN);
        }

        if ($restaurant->cover_image) {
            $fileN = public_path('uploads') . '/' . $restaurant->cover_image;
            if (File::exists($fileN))
                unlink($fileN);
        }

    }

    public function showQr()
    {
        //return view('');
        $data['qr'] = $qr = QrCode::format('png')->generate(request()->fullUrl());

        //    return response($qr)->header('Content-type','image/png');

        return view('showQR', $data);
    }

    public function customMenuGenerate($id)
    {
        $user = auth()->user();
        $data['restaurant'] = $restaurant = $user->restaurants()->where('id', $id)->first();
        if (!$restaurant) return redirect()->back()->withErrors(['msg' => trans('layout.message.invalid_request')]);
        $data['categories'] = $user->active_categories;
        return view('restaurant.custom-menu-generate', $data);
    }

    public function storeCustomMenu(Request $request)
    {
        $request->validate([
            'menu_files.*' => 'mimes:jpeg,bmp,png,pdf,jpg',
            'id' => 'required',
            'header_image'=>'mimes:jpeg,bmp,png,jpg',
            'header_title'=>'required',
            'description'=>'required'
        ]);
       // dd($request->all());

        $user = auth()->user();
        if ($user->type == 'admin') {
            $restaurant = Restaurant::find($request->id);
        } else {
            $restaurant = $user->restaurants()->where('id', $request->id)->first();
        }

        if (!$restaurant) return redirect()->back()->withErrors(['msg' => trans('layout.message.invalid_request')]);

        DB::beginTransaction();
        try {
            $preImages = $restaurant->custom_menus()->pluck('image');
            $notChangedImages = [];
            $restaurant->custom_menus()->delete();
            $data = [];
            $i = 0;
            if (isset($request->category_id_pre)) {
                foreach ($request->category_id_pre as $key => $cat) {
                    $notChangedImages[] = $request->pre_image[$key];
                    if($request->title_pre[$key] && $request->category_id_pre[$key] && $request->pre_image[$key] ){
                        $data[$i]['restaurant_id'] = $restaurant->id;
                        $data[$i]['category_id'] = $request->category_id_pre[$key];
                        $data[$i]['name'] = $request->title_pre[$key];
                        $data[$i]['image'] = $request->pre_image[$key];
                        $data[$i]['created_at'] = now();
                        $data[$i]['updated_at'] = now();
                        $i++;
                    }

                }
            }

            if (isset($request->menu_files)) {
                foreach ($request->menu_files as $key => $file) {
                    if($request->title[$key] && $request->category_id[$key]){
                        $name = time() .$key. '.' . $file->extension();
                        $file->move(public_path('uploads'), $name);
                        $data[$i]['restaurant_id'] = $restaurant->id;
                        $data[$i]['category_id'] = $request->category_id[$key];
                        $data[$i]['name'] = $request->title[$key];
                        $data[$i]['image'] = $name;
                        $data[$i]['created_at'] = now();
                        $data[$i]['updated_at'] = now();
                        $i++;
                    }

                }
            }

            if($request->hasFile('header_image')){
                $file=$request->file('header_image');
                $name = time() . 'h.' . $file->extension();
                $file->move(public_path('uploads'), $name);

                $fileN = public_path('uploads') . '/' . $restaurant->cover_image;
                if (File::exists($fileN))
                    unlink($fileN);

                $restaurant->cover_image=$name;

            }
            $restaurant->description=$request->description;
            $restaurant->name=$request->header_title;
            $restaurant->footer=$request->footer;
            $restaurant->save();


            CustomMenu::insert($data);

            foreach ($preImages as $img) {
                if (!in_array($img, $notChangedImages)) {
                    $fileN = public_path('uploads') . '/' . $img;
                    if (File::exists($fileN))
                        unlink($fileN);
                }
            }
            DB::commit();

            return redirect()->route('restaurant.custom-menu', ['id' => $restaurant])->with('success', trans('layout.message.item_update'));

        } catch (\Exception $ex) {
            DB::rollBack();
            Log::error($ex);
            return redirect()->back()->withErrors(['msg' => trans('layout.message.invalid_request')]);
        }

    }

    public function loginAs(Request $request){
       if(auth()->user()->type!='admin') abort(404);
       auth()->loginUsingId($request->id);
       return redirect()->back()->with('success',trans('layout.message.login_as'));
    }

}

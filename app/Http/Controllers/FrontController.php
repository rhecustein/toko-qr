<?php

namespace App\Http\Controllers;

use App\Events\SendMail;
use App\Models\CustomMenu;
use App\Models\Item;
use App\Models\Plan;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    public function index()
    {
        $data['plans'] = Plan::where(['status' => 'active'])->where('id', '!=', 1)->get();
        return view('front.index', $data);
    }

    public function show($slug, Request $request)
    {
        // dd($slug);
        $data['restaurant'] = $restaurant = Restaurant::where('slug', $slug)->where('id', $request->id)->firstOrFail();

        $rest_categories = [];
        foreach ($restaurant->items as $item) {
            if (!in_array($item->category, $rest_categories)) {
                $rest_categories[] = $item->category;
            }
        }
        $data['rest_categories'] = $rest_categories;


        $data['tables'] = $restaurant->tables;

        if ($restaurant->template == 'custom' || $request->type == 'custom') {
            $data['categories'] = CustomMenu::with('category')->where('restaurant_id', $restaurant->id)->get()->groupBy(function ($item, $key) {
                return $item->category->name;
            });
            $data['customFooter'] = $restaurant->footer;
            return view('restaurant.show_custom_restaurant', $data);
        } else {
            $data['categories'] = Item::with('category')->where('restaurant_id', $restaurant->id)->get()->groupBy(function ($item, $key) {
                return $item->category->name;
            });

            if ($restaurant->template == 'modern') {
                return view('restaurant.show_restaurant_modern', $data);
            } else {
                return view('restaurant.show_restaurant', $data);
            }

        }


    }

    public function setLocale($type)
    {
        $availableLang = get_available_languages();

        if (!in_array($type, $availableLang)) abort(400);

        session()->put('locale', $type);

        // dd(session()->get('locale'));
        return redirect()->back();
    }

    public function subscribe(Request  $request){
        $email=$request->email;
        if(!$email) abort(400);

        SendMail::dispatch(config('mail.from.address'), "Newsletter Subscription", "You have got a new newsletter subscription of ".$email);
        return redirect()->back()->with('success','Thanks for your subscription');
    }
}

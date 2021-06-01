<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Plan;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\UserPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $auth=auth()->user();
        if($request->earning=='true' && $auth->type=='restaurant_owner'){
            $restaurantIds=$auth->restaurants()->pluck('id');
            $data['restaurants']=$auth->restaurants;
            $orders=Order::select('id','name','restaurant_id','payment_status','total_price','created_at')->whereIn('restaurant_id',$restaurantIds)->where('payment_status','paid')->with('restaurant');
            if ($request->from_to_dates) {
                $from_to_dates = explode('-', $request->from_to_dates);
                $dates = [];
                foreach ($from_to_dates as $date) {
                    $dates[] = Carbon::parse(trim($date))->format('Y-m-d');
                }
                $orders->whereBetween('created_at', $dates);
            }
            if ($request->order_type && $request->order_type!='all') {
                $orders->where('type', $request->order_type);
            }

            if ($request->restaurant_id && $request->restaurant_id!='all') {
                $orders->where('restaurant_id', $request->restaurant_id);
            }


            $data['orders']=$orders->get();
            return view('reports.restaurant_owner_earning',$data);
        }

        $data['customers'] = User::where('type', 'restaurant_owner')->select('id', 'email', 'name')->get();
        $data['plans'] = Plan::where('id', '!=', 1)->select('id', 'title', 'cost')->get();
        $userPlan = UserPlan::where('plan_id', '!=', 1)->where('status', 'approved')->orderBy('created_at', 'desc');

        if ($request->from_to_dates) {
            $from_to_dates = explode('-', $request->from_to_dates);
            $dates = [];
            foreach ($from_to_dates as $date) {
                $dates[] = Carbon::parse(trim($date))->format('Y-m-d');
            }
            $userPlan->whereBetween('created_at', $dates);
        }

        if ($request->plan_id && $request->plan_id!='all') {
            $userPlan->where('plan_id', $request->plan_id);
        }

        if ($request->customer_id && $request->customer_id!='all') {
            $userPlan->where('user_id', $request->customer_id);
        }


        $data['userPlans'] = $userPlan->get();

        if($auth->type=='admin'){
            return view('reports.index', $data);
        }elseif ($auth->type=='restaurant_owner'){
            return view('reports.restaurant_owner', $data);
        }
    }
}

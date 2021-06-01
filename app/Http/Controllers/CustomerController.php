<?php

namespace App\Http\Controllers;

use App\Events\SendMail;
use App\Models\EmailTemplate;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CustomerController extends Controller
{
    public function index()
    {
        $data['customers'] = User::where('type', 'restaurant_owner')->orderBy('created_at', 'desc')->get();
        return view('customer.index', $data);
    }

    public function create()
    {
        $data['plans'] = Plan::where('status', 'active')->where('id', '!=', 1)->get();
        return view('customer.create', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'plan_id' => 'required|exists:plans,id',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->email_verified_at = now();
        $user->type = 'restaurant_owner';
        $user->save();

        $plan = Plan::findOrFail($request->plan_id);

        $expiredDate = null;
        if ($plan->recurring_type == 'weekly') {
            $expiredDate = now()->addWeek();
        } else if ($plan->recurring_type == 'monthly') {
            $expiredDate = now()->addMonth();
        } else if ($plan->recurring_type == 'yearly') {
            $expiredDate = now()->addYear();
        }
        $userPlan = new UserPlan();
        $userPlan->user_id = $user->id;
        $userPlan->plan_id = $plan->id;
        $userPlan->start_date = now();
        $userPlan->expired_date = $expiredDate;
        $userPlan->is_current = 'yes';
        $userPlan->cost = $plan->cost;
        $userPlan->recurring_type = $plan->recurring_type;
        $userPlan->table_limit = $plan->table_limit;
        $userPlan->restaurant_limit = $plan->restaurant_limit;
        $userPlan->item_limit = $plan->item_limit;
        $userPlan->item_unlimited = $plan->item_unlimited;
        $userPlan->table_unlimited = $plan->table_unlimited;
        $userPlan->restaurant_unlimited = $plan->restaurant_unlimited;
        $userPlan->status = 'approved';
        $userPlan->save();

        $role = Role::findOrCreate('restaurant_owner');
        $user->assignRole($role);

        return redirect()->back()->with('success', trans('layout.message.restaurant_owner_created'));
    }

    public function edit(User $user)
    {
        $data['customer'] = $user;
        $data['plans'] = Plan::where('status', 'active')->where('id', '!=', 1)->get();
        $data['userPlans'] = isset($user->current_plans[0]) ? $user->current_plans[0] : '';

        return view('customer.edit', $data);

    }

    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id
        ]);

        $requested_plan_id = $request->plan_id;
        $customer = $user;
        $customer->name = $request->name;
        $customer->email = $request->email;
        if ($request->password) {
            $customer->password = bcrypt($request->password);
        }
        $customer->save();

        $plan = Plan::where('id', $requested_plan_id)->first();
        if (isset($customer->current_plans[0]) && $customer->current_plans[0]->plan_id != $requested_plan_id) {
            try {
                $emailTemplate = EmailTemplate::where('type', 'plan_accepted')->first();
                if ($emailTemplate) {
                    $planChangeTemp = str_replace('{customer_name}', $customer->name, $emailTemplate->body);
                    $planChangeTemp = str_replace('{plan_from}', $customer->current_plans[0]->plan->title, $planChangeTemp);
                    $planChangeTemp = str_replace('{plan_to}', $plan->title, $planChangeTemp);
                    SendMail::dispatch($customer->email, $emailTemplate->subject, $planChangeTemp);
                }
            } catch (\Exception $ex) {
                Log::error($ex->getMessage());
            }
        }


        $userPlan = UserPlan::where('user_id', $customer->id)->first();
        $expiredDate = null;
        if ($plan->recurring_type == 'weekly') {
            $expiredDate = now()->addWeek();
        } else if ($plan->recurring_type == 'monthly') {
            $expiredDate = now()->addMonth();
        } else if ($plan->recurring_type == 'yearly') {
            $expiredDate = now()->addYear();
        }
        $userPlan->plan_id = $requested_plan_id;
        $userPlan->status = 'approved';
        $userPlan->is_current = 'yes';
        $userPlan->expired_date = $expiredDate;
        $userPlan->transaction_id = '';
        $userPlan->save();

        return redirect()->route('customers.index')->with('success', trans('layout.message.customer_edit_success'));
    }

    public function user()
    {
        $authUser = auth()->user();
        if ($authUser->type == 'admin') {
            $data['users'] = User::where('type', 'customer')->orderBy('created_at', 'desc')->get();
            $data['restaurant_ids'] = $authUser->restaurants()->pluck('id');
        } else {
            $restaurants = Restaurant::where('user_id', $authUser->id)->pluck('id');
            $user_ids = Order::whereIn('restaurant_id', $restaurants)->whereNotNull('user_id')->pluck('user_id');
            $data['users'] = User::where('type', 'customer')->whereIn('id', $user_ids)->get();
            $data['restaurant_ids'] = $authUser->restaurants()->pluck('id');
        }
        return view('restaurant.user', $data);
    }

    public function destroy(User $user)
    {
        if(auth()->user()->type!='admin' || $user->type!='restaurant_owner'){
            abort(404);
        }
        $role = Role::findOrCreate('restaurant_owner');
        $user->removeRole($role);
        $user->delete();
        return redirect()->back()->with('success', trans('layout.message.customer_deleted'));
    }
}

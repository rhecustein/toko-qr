<?php

use Barryvdh\TranslationManager\Models\Translation;

function short_word($string, $wordCount = 1, $el = "...")
{
    return \Illuminate\Support\Str::words($string, $wordCount, $el);
}

function isSidebarActive($routeName)
{
    return request()->routeIs($routeName) ? 'mm-active' : '';

}

function formatDate($date)
{
    $setting = json_decode(get_settings('local_setting'));
    if (!isset($setting->date_time_format) || !isset($setting->date_time_separator) || !isset($setting->timezone)) return $date;

    return str_replace([',', '_'], [', ', ' '], Carbon\Carbon::createFromTimeString($date)->timezone($setting->timezone)->format(str_replace(' ', $setting->date_time_separator, $setting->date_time_format)));
}

function formatNumber($number)
{
    $setting = json_decode(get_settings('local_setting'));
    if (!isset($setting->decimal_format) || !isset($setting->decimals) || !isset($setting->thousand_separator)) return $number;

    try {
        return number_format($number, $setting->decimals, $setting->decimal_format, $setting->thousand_separator);
    } catch (\Exception $ex) {
        return $number;
    }
}

function formatNumberWithCurrSymbol($number)
{
    $setting = json_decode(get_settings('local_setting'));
    $formattedNumber = formatNumber($number);
    if (!isset($setting->currency_symbol_position) || !isset($setting->currency_symbol)) return $formattedNumber;
    if ($setting->currency_symbol_position == 'after')
        return $formattedNumber . $setting->currency_symbol;
    else if ($setting->currency_symbol_position == 'before')
        return $setting->currency_symbol . $formattedNumber;
    else
        return $formattedNumber;
}

function get_settings($name)
{
    $value = cache('settings');

    if (!$value) {
        if (\Illuminate\Support\Facades\DB::connection()->getPdo() && \Illuminate\Support\Facades\DB::table('settings')->exists()) {
            $settings = \App\Models\Setting::all();
            $sortSettings = [];
            foreach ($settings as $setting) {
                $sortSettings[$setting->name] = $setting->value;
            }
            cache()->remember('settings', 10800, function () use ($sortSettings) {
                return $sortSettings;
            });
        }
    } else {
        $sortSettings = $value;
    }

    return isset($sortSettings[$name]) ? $sortSettings[$name] : '';
}

function get_restaurant_gateway_settings($user_id)
{
    return \App\Models\RestaurantPaymentGateway::where('user_id', $user_id)->first();
}

function get_currency()
{
    $setting = json_decode(get_settings('local_setting'));
    if (!isset($setting->currency_code)) return 'USD';
    return $setting->currency_code;
}

function get_currency_symbol()
{
    return "$";
}

function get_stripe_publish_key()
{
    $credentials = json_decode(get_settings('payment_gateway'));
    if (!$credentials->stripe_publish_key || !$credentials->stripe_secret_key) {
        return "";
    }
    return $credentials->stripe_publish_key;
}

function notification($type, $ref_id, $to_user_id, $message)
{
    $notification = new \App\Models\Notification();
    $notification->type = $type;
    $notification->ref_id = $ref_id;
    $notification->to_user_id = $to_user_id;
    $notification->message = $message;
    $notification->save();
}

function get_notifications()
{
    $notifications = \App\Models\Notification::where('to_user_id', auth()->id())->orderBy('created_at', 'desc')->limit(5)->get();

    return $notifications;
}

function get_customer_permissions()
{
    return ['order_list', 'general_setting', 'change_password'];
}

function get_restaurant_permissions()
{
    return [
        "restaurant_manage",
        "order_manage",
        "item_manage",
        "table_manage",
        "dashboard",
        "general_setting",
        "change_password",
        "order_payment_status_change",
        "order_list",
        "billing",
        "category_manage",
        "qr_manage",
        "payment_gateway_setting",
        "tax_manage",
        "report",
    ];
}

function get_admin_permission()
{
    return [
        "restaurant_manage",
        "plan_manage",
        "dashboard",
        "general_setting",
        "change_password",
        "site_setting",
        "email_setting",
        "email_template_setting",
        "payment_gateway_setting",
        "sms_gateway_setting",
        "role_permission",
        "user_plan_change",
        "local_setting",
        "report",
        "restaurant_owner_manage"

    ];
}

function format_number($number, $decimals = 2)
{
    return number_format((float)$number, $decimals, '.', '');
}

function getAllTimeZones()
{
    $timezone = array();
    $timestamp = time();

    foreach (timezone_identifiers_list(\DateTimeZone::ALL) as $key => $t) {
        date_default_timezone_set($t);
        $timezone[$key]['zone'] = $t;
        $timezone[$key]['GMT_difference'] = date('P', $timestamp);
    }
    $timezone = collect($timezone)->sortBy('GMT_difference');
    return $timezone;
}

function get_available_languages()
{
    $value = cache('language');

    if (!$value) {
        $all_locales = Translation::select('locale')->groupBy('locale')->get()->pluck('locale')->toArray();
        cache()->remember('language', 10800, function () use ($all_locales) {
            return $all_locales;
        });

        return $all_locales;
    } else {
        return $value;
    }
}

function generateOrderSlot(){
    return "<option value='00:00-01:00'>00:00-01:00</option> <option value='01:00-02:00'>01:00-02:00</option> <option value='02:00-03:00'>02:00-03:00</option> <option value='03:00-04:00'>03:00-04:00</option> <option value='04:00-05:00'>04:00-05:00</option> <option value='05:00-06:00'>05:00-06:00</option> <option value='06:00-07:00'>06:00-07:00</option> <option value='07:00-08:00'>07:00-08:00</option> <option value='08:00-09:00'>08:00-09:00</option> <option value='09:00-10:00'>09:00-10:00</option> <option value='10:00-11:00'>10:00-11:00</option> <option value='11:00-12:00'>11:00-12:00</option> <option value='12:00-13:00'>12:00-13:00</option> <option value='13:00-14:00'>13:00-14:00</option> <option value='14:00-15:00'>14:00-15:00</option> <option value='15:00-16:00'>15:00-16:00</option> <option value='16:00-17:00'>16:00-17:00</option> <option value='17:00-18:00'>17:00-18:00</option> <option value='18:00-19:00'>18:00-19:00</option> <option value='19:00-20:00'>19:00-20:00</option> <option value='20:00-21:00'>20:00-21:00</option> <option value='21:00-22:00'>21:00-22:00</option>";
}

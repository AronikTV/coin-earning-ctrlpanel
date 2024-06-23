<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class EarnController extends Controller
{
    private $dailyLimit = 2; // Set the daily limit here
    private $minTimeBetweenEarnings = 10; // Minimum time between earnings in seconds (adjust as needed)
    private $timezone = 'Asia/Dhaka'; //you can find from your time zone here - https://en.wikipedia.org/wiki/Time_zone

    public function getDailyLimit()
    {
        return $this->dailyLimit;
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    /** Show the application dashboard. */
    public function index(Request $request)
    {
        return view('earn')->with([
            
        ]);
    }

    public function start(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $today = Carbon::now($this->timezone)->format('Y-m-d');

        if (!Session::has("linkvertise_count_$userId")) {
            Session::put("linkvertise_count_$userId", 0);
            Session::put("linkvertise_date_$userId", $today);
            Session::put("linkvertise_complete_$userId", false);
            Session::put("current_earn_code_$userId", null);
        }

        if (Session::get("linkvertise_date_$userId") !== $today) {
            Session::put("linkvertise_count_$userId", 0);
            Session::put("linkvertise_date_$userId", $today);
            Session::put("linkvertise_complete_$userId", false);
            Session::put("current_earn_code_$userId", null);
        }

        if (Session::get("linkvertise_count_$userId") >= $this->dailyLimit) {
            return redirect()->route('earn.index')->with('error', __("You have reached today's Linkvertise earning limit. Please try again tomorrow."));
        }

        if (!Session::get("current_earn_code_$userId")) {
            $code = rand(20000, 30000);
            Session::put("current_earn_code_$userId", $code);
        }

        Session::put("earn_ip_$userId", $request->ip());

        // Construct Linkvertise URL using $code
        $base = "https://link-to.net/" . 'Your_Publisher_ID';
        $base .= "/" . rand(100, 1000) . "." . rand(999, 10000000) . "/dynamic/?r=";
        $base .= base64_encode(env('APP_URL', 'Your_CtrlPanel_Domain') . '/redeem?code=' . Session::get("current_earn_code_$userId"));

        return redirect()->away($base)->withCookie(cookie('earn_code', Session::get("current_earn_code_$userId"), 15));
    }

    public function redeem(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $code = $request->query('code');
        $storedCode = Session::get("current_earn_code_$userId");

        if ($code !== strval($storedCode)) {
            return redirect()->route('earn.index')->with('error', __("Invalid code. Please try again."));
        }

        if (Session::get("linkvertise_complete_$userId")) {
            return redirect()->route('earn.index')->with('error', __("You have already completed this earning session. Please try again later."));
        }

        $earnIp = Session::get("earn_ip_$userId");
        $lastEarnIpTime = Session::get("last_earn_ip_time_$userId");

        if ($lastEarnIpTime && $earnIp === $lastEarnIpTime['ip'] && now()->diffInSeconds($lastEarnIpTime['time']) < $this->minTimeBetweenEarnings) {
            return redirect()->route('earn.index')->with('error', __("You cannot earn coins twice from the same IP address within a short time."));
        }

        Session::increment("linkvertise_count_$userId");
        if (Session::get("linkvertise_count_$userId") >= $this->dailyLimit) {
            Session::put("linkvertise_complete_$userId", true);
        } else {
            Session::put("linkvertise_complete_$userId", false);
        }

        // Credit user with reward
        $reward = 5; // Linkvertise Earning Reward
        $user->increment('credits', $reward);

        Session::forget("current_earn_code_$userId");

        Session::put("last_earn_ip_time_$userId", ['ip' => $earnIp, 'time' => now()]);

        return redirect()->route('earn.index')->with('success', __("You successfully got Coins!"));
    }

    public function adsense(Request $request)
    {
        $timerStart = now();
        Session::put('adsense_start', $timerStart);

        return redirect()->route('earn.adpage')->with('success', __("Adsense is starting now..."));
    }

    public function timerPage()
    {
        $reward_a = 0;
        $button = false;

        if (Session::has('adsense_start')) {
            $timerStart = Session::get('adsense_start');
            $currentTime = now();
            $elapsedTime = $currentTime->diffInSeconds($timerStart);
            $remainingTime = max(10 - $elapsedTime, 0);

            if ($remainingTime === 0) {
                Auth::user()->increment('credits', $reward_a);
                Session::forget('adsense_start');
                $button = true;
            }

            return view('earn.adpage', [
                'remainingTime' => $remainingTime,
                'button' => $button,
            ]);
        }

        return view('earn.adpage', [
            'remainingTime' => null,
            'coinsEarned' => 0,
            'button' => $button,
        ]);
    }

    public function redirectToEarnIndex()
    {
        return redirect()->route('earn.index')->with('success', __("You successfully got Coins!"));
    }

    public function clickcoin(Request $request)
    {
        $clickcoinReward = 1; // Define the reward amount here

        $lastClickTime = $request->session()->get('clickcoin_last_click', null);
        $minTimeBetweenClicks = 100; // Minimum time between clicks in seconds (adjust as needed)

        $request->session()->put('clickcoin_last_click', now());

        if ($lastClickTime !== null && now()->diffInSeconds($lastClickTime) < $minTimeBetweenClicks) {
            return redirect()->route('earn.index')->with('error', 'Please wait 3 minutes before clicking again.');
        }

        $clickcoinLink = 'Your_Direct_Ad_Link_Here';
        $response = Http::get($clickcoinLink);

        if ($response->status() === 200) {
            $user = Auth::user();
            $user->increment('credits', $clickcoinReward);

            return redirect()->away($clickcoinLink)->with('success', 'You earned ' . $clickcoinReward . ' coins!');
        } else {
            return redirect()->route('earn.index')->with('error', 'Failed to redirect to Clickcoin link.');
        }
    }
}

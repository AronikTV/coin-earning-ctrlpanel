<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Session;


class EarnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /** Show the application dashboard. */
    public function index(Request $request)
    {


        // RETURN ALL VALUES
        return view('earn')->with([
            // Coming Soon
        ]);
    }

    public function start(Request $request)
    {

        
        $randomnumber = rand(1000, 1500);
        $code = rand(20000, 30000);

        $base = "https://link-to.net/" . 'yourid';
        $base .= "/" . rand(100, 1000) . "." . rand(999, 10000000) . "/dynamic/?r=";
        $base .= base64_encode(env('APP_URL', 'https://my.domain.example') . '/redeem?code=' . strval($code)); 


        return redirect()->away($base)->withCookie(cookie('earn_code', $code, 15));;
    }

    public function redeem(Request $request)
    {
        $reward = 30;

        $code = $request->cookie('earn_code');

        $referer = request()->headers->get('referer');

        if (!str_contains($referer, 'linkvertise.com'))
        {
         
            // @Aronik if necessary add Discord logging again -> I can also implement a handler for it
            return redirect()->route('earn.index')->with('error', __("You bypassed linkvertise! Please don't use cheats."));
        }

        if($request->query('code') !== $code)
        {
            // @Aronik if necessary add Discord logging again -> I can also implement a handler for it
            return redirect()->route('earn.index')->with('error', __("We cannot verify this being a legitimate request. Please try again later."));
        }

        Auth::user()->increment('credits', $reward);

        return redirect()->route('earn.index')->with('success', __("You successfully got Coins!"))->withoutCookie('earn_code');
    }
    
    public function adsense(Request $request)
    {
        
        $timerStart = now();
        Session::put('adsense_start', $timerStart);
  
        return redirect()->route('earn.adpage')->with('success', __("Adsense is starting now..."));
    }
        
        public function timerPage()
        {
            $reward_a = 5;
            $button = false;
            
            if (Session::has('adsense_start')) {
                $timerStart = Session::get('adsense_start');
                $currentTime = now();
                $elapsedTime = $currentTime->diffInSeconds($timerStart);
                $remainingTime = max(10 - $elapsedTime, 0);

                if ($remainingTime === 0) {
                    // Here you can add logic to award coins to the user
                    Auth::user()->increment('credits', $reward_a);
                    Session::forget('adsense_start'); // Reset the timer
                    
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
        

        return redirect()->route('earn.index')->with('success', __("You successfully got Coins!"))->withoutCookie('earn_code');
    }

    public function clickcoin(Request $request)
        {
            $clickcoinReward = 1; // Define the reward amount here

            $lastClickTime = $request->session()->get('clickcoin_last_click', null);
            $minTimeBetweenClicks = 60; // Minimum time between clicks in seconds (adjust as needed)

            if ($lastClickTime !== null && now()->diffInSeconds($lastClickTime) < $minTimeBetweenClicks) {
            // Spam protection: User clicked too quickly, show an error message or redirect them back.
               return redirect()->route('earn.index')->with('error', 'Please wait 60seconds before clicking again.');
            }

            // Redirect the user to the specified link
            $clickcoinLink = 'your direct ad link';

            // Check if the redirection is successful
            $response = Http::get($clickcoinLink);

            if ($response->status() === 200) {
            // Award the reward to the user
            $user = Auth::user();
            $user->increment('credits', $clickcoinReward);

            // Set the current time as the last click time
            $request->session()->put('clickcoin_last_click', now());

              return redirect()->away($clickcoinLink)->with('success', 'You earned ' . $clickcoinReward . ' coins!');
            } else {
        // If the redirection was not successful, show an error message or handle it accordingly.
        return redirect()->route('earn.index')->with('error', 'Failed to redirect to Clickcoin link.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SpinerGamaController extends Controller
{

    public function verifyUserAlreadySpinned(Request $request)
    {
        $u_id = $request->user_id;

        // Fetch the user's last spin record
        $response = DB::table('game_registrations')
            ->where('userid', $u_id)
            ->first();

        $lastSpinTime = $response->updated_at;
        $currentTime = now();
        $hoursDifference = $currentTime->diffInHours($lastSpinTime);

        // Count direct referrals for the user
        $direct_referral_count = DB::table('game_registrations')
            ->where('dsponserid', $u_id)
            ->count();

        // Check if the user has already used the referral-based spin
        if ($direct_referral_count >= 3 && !$response->referral_spin_used) {
            // Allow user to spin if they have 3 or more referrals and haven't used the referral-based spin
            DB::table('game_registrations')
                ->where('userid', $u_id)
                ->update(['referral_spin_used' => 1]);  // Mark referral-based spin as used

            return response()->json([
                'status' => false,
                'message' => 'User has 3 or more direct referrals, allowed to spin now.',
            ]);
        }

        if ($hoursDifference >= 6) {
            // Allow the user to spin again
            return response()->json([
                'status' => false,
                'message' => 'You can spin again!'
            ]);
        }
        // Check if the user has spun before
        if ($response) {
            if (is_null($response->updated_at) || $response->updated_at === "0000-00-00 00:00:00") {
                return response()->json([
                    'status' => false,
                    'message' => 'User Not Spinned (First Time)',
                ]);
            }

            $timerCountDown_Result = $this->timerCountDown($response);
            $timeRemaining = $timerCountDown_Result;

            return response()->json([
                'status' => true,
                'message' => 'User Already Spinned',
                'next_spin_time' => "You can spin again after " . $timeRemaining,
                'remaining_time' => $timeRemaining,
            ]);
        }

        // If user hasn't spun in the last 24 hours or it's their first time, allow them to spin
        return response()->json([
            'status' => false,
            'message' => 'User Not Spinned',
        ]);
    }

    public function spinerGameRegisteration(Request $request)
    {
        $userEmail = $request->email;

        // Check if the email is already registered
        $alreadyRegisterUser = DB::table('game_registrations')->where('email', $userEmail)->first();
        if ($alreadyRegisterUser) {
            Log::info("Registration attempt for already registered email: $userEmail");
            return redirect()->back()->with('message', "User $userEmail is already registered");
        }

        // Check if the referral email (dsponserid) is provided
        if (!empty($request->dsponserid)) {
            // Fetch the sponsor's record by email
            $res = DB::table('game_registrations')->where('email', $request->dsponserid)->first();

            // If no matching sponsor record is found, return with an error message
            if (!$res) {
                Log::warning("Referral email not found: " . $request->dsponserid);
                return redirect()->back()->with('message', "Referral email '$request->dsponserid' not found.");
            }

            // Log sponsor details
            Log::info("Referral found. Sponsor ID: {$res->userid}, Sponsor Email: {$res->email}");

            // Set sponsor details
            $dsponserid = $res->userid;
            $dsponserid_username = $res->email;
            $upsponserid = $res->upsponserid;
            $upsponserid_username = $res->upsponserid_username;
        } else {
            // No referral email provided
            $dsponserid = null;
            $dsponserid_username = null;
            $upsponserid = null;
            $upsponserid_username = null;
            Log::info("No referral email provided for registration.");
        }

        // Get the next available user ID for the new registration
        $nextId = DB::table('game_registrations')->max('userid') + 1;
        Log::info("Next available user ID: $nextId");

        // Insert the new user into the game_registrations table
        $response = DB::table('game_registrations')->insertGetId([
            'userid' => $nextId,
            'username' => $request->fullName,
            'email' => $request->email,
            'password' => $request->password1,  // Hash the password
            'dsponserid' => $dsponserid ?? 0,
            'dsponserid_username' => $dsponserid_username ?? '',
            'upsponserid' => $upsponserid ?? 0,
            'upsponserid_username' => $upsponserid_username ?? '',
            'created_at' => now(),
        ]);

        if ($response) {
            // Fetch the newly registered user
            $current_user = DB::table('game_registrations')->where('userid', $nextId)->first();

            // Log successful registration
            Log::info("New user registered successfully. User ID: {$current_user->userid}, Email: {$current_user->email}");

            // Store user details in session
            session()->put('user_id', $current_user->userid);
            session()->put('user_email', $current_user->email);

            return redirect()->route('spinner-game')->with('message', 'Registration Successful');
        } else {
            // Log registration failure
            Log::error("User registration failed for email: $userEmail");
            return redirect()->back()->with('message', 'Registration Failed');
        }
    }
    public function spinerGameLoginView(Request $request)
    {
        $user_email = $request->user_email;
        return view('spinnergame.gamelogin', compact('user_email'));
    }

    public function spinerGameLoginStore(Request $request)
    {

        $response = DB::table('game_registrations')->where('email', $request->email)
            ->where('password', $request->password)
            ->first();
        if ($response) {
            session()->put('user_id', $response->userid);
            session()->put('user_email', $response->email);
            return redirect()->route('spinner-game');
        } else {
            return redirect()->back()->with('message', 'Login Failed');
        }
    }

    public function spinerGame()
    {
        // dd(session()->all());
        $u_id = session()->get('user_id');
        $results = DB::table('game_registrations')
            ->select('email', 'total_reward_tokens', 'wallet_address', 'created_at', 'updated_at')
            ->where('userid', $u_id)->first();
        $prize_tokens = isset($results) ? $results->total_reward_tokens : 0;
        $walletAddress = isset($results) ? $results->wallet_address : '';

        $direct_referral = DB::table('game_registrations')->where('dsponserid', $u_id)->get();
        $direct_referral_count = $direct_referral->count();

        $timerCountDown_Result = $this->timerCountDown($results);
        $timeRemaining = $timerCountDown_Result;
        $social_sources = DB::table('game_rewards')->where('userid', $u_id)->pluck('source');

        $social_media_rewards = DB::table('game_rewards')->where('userid', $u_id)->whereNotIn('source', ['web_app'])->sum('total_earn_tokens');
        $user_email = isset($results) ? $results->email : '';
        $user_referral_link = "http://localhost:8000/spinner-game-login?user_email=" . $user_email;


        $instagram_claimed = isset($social_sources) ? $social_sources->contains('instagram') : false;
        $telegram_claimed = isset($social_sources) ? $social_sources->contains('telegram') : false;
        $linkedIn_claimed = isset($social_sources) ? $social_sources->contains('linkedIn') : false;
        $facebook_claimed = isset($social_sources) ? $social_sources->contains('facebook') : false;
        $twitter_join_claimed = isset($social_sources) ? $social_sources->contains('x_join(twitter)') : false;
        $twitter_like_claimed = isset($social_sources) ? $social_sources->contains('x_like(twitter)') : false;
        $youtube_claimed = isset($social_sources) ? $social_sources->contains('youtube_follow') : false;
        $FollowCEO = isset($social_sources) ? $social_sources->contains('FollowCEO') : false;
        $FollowCTO = isset($social_sources) ? $social_sources->contains('FollowCTO') : false;
        $watchYouTubeVideo = isset($social_sources) ? $social_sources->contains('watchYouTubeVideo') : false;
        $ReTweetLink = isset($social_sources) ? $social_sources->contains('ReTweetLink') : false;

        return view('spinnergame.spinnergame', compact('prize_tokens', 'direct_referral', 'direct_referral_count', 'timeRemaining', 'instagram_claimed', 'linkedIn_claimed','telegram_claimed', 'facebook_claimed', 'twitter_join_claimed','twitter_like_claimed', 'youtube_claimed' , 'FollowCEO' , 'FollowCTO' , 'watchYouTubeVideo' , 'ReTweetLink', 'social_media_rewards', 'user_referral_link', 'walletAddress'));
    }

    public function spinnerGameReward(Request $request)
    {

        $response = DB::table('game_rewards')->insertGetId([
            'userid' => $request->user_id,
            'username' => session()->get('user_email'),
            'email' => session()->get('user_email'),
            'total_earn_tokens' => $request->prize_amount,
            'source' => $request->source,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if ($response) {
            DB::table('game_registrations')->where('userid', $request->user_id)->update([
                'total_spin_clicked' => DB::raw('total_spin_clicked + 1'),
                'total_reward_tokens' => DB::raw('total_reward_tokens + ' . $request->prize_amount),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json([
                'status' => true,
                'prize_amount' => $request->prize_amount,
                'message' => 'Reward Added Successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Reward Added Failed',
            ]);
        }
    }

    public function socialMediaRewards(Request $request)
    {
        $u_id = $request->user_id;
        $source = $request->source;
        $points = $request->points;


        $user = DB::table('game_registrations')->where('userid', $u_id)->first();

        $response = DB::table('game_rewards')
            ->where('userid', $u_id)
            ->where('source', $source)->first();

        if ($response == null) {
            DB::table('game_rewards')->insert([
                'userid' => $user->userid,
                'username' => $user->username,
                'email' => $user->email,
                'total_earn_tokens' => $points,
                'source' => $source,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            DB::table('game_registrations')->where('userid', $u_id)->update([
                'total_reward_tokens' => DB::raw('total_reward_tokens + ' . $points)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Reward Claimed',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Reward Already Claimed',
            ]);
        }
    }
    public static function timerCountDown($response)
    {

        $currentTime = Carbon::now();
        $date = isset($response) ? $response->updated_at : (isset($response) ? $response->created_at : $currentTime);
        $lastSpinTime = Carbon::parse($date); // Parse the last spin time
        $nextAllowedSpinTime = $lastSpinTime->addHours(6);   // Next spin allowed 6 hours later

        $currentTime = Carbon::now();

        // Check if the current time is before the next allowed spin time
        if ($currentTime->lessThan($nextAllowedSpinTime)) {
            $hoursRemaining = $currentTime->diffInHours($nextAllowedSpinTime);
            $minutesRemaining = $currentTime->copy()->addHours($hoursRemaining)->diffInMinutes($nextAllowedSpinTime) % 60;
            $secondsRemaining = $currentTime->copy()->addHours($hoursRemaining)->addMinutes($minutesRemaining)->diffInSeconds($nextAllowedSpinTime) % 60;

            $timeRemaining = sprintf('%02d:%02d:%02d', $hoursRemaining, $minutesRemaining, $secondsRemaining);

            return $timeRemaining;
        }
    }
    public function addWalletAddress(Request $request)
    {
        $u_id = session()->get('user_id');
        $response = DB::table('game_registrations')->where('userid', $u_id)->update([
            'wallet_address' => $request->wallet_address,
        ]);
        if ($response) {
            return redirect()->route('spinner-game')->with('message', 'Wallet Address Added Successfully');
        } else {
            return redirect()->route('spinner-game')->with('message', 'Wallet Address Added Failed');
        }
    }
}

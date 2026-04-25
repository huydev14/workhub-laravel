<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAccountController extends Controller
{
    public function redirect(Request $request, $provider)
    {
        $type = $request->query('type', 'user');

        return Socialite::driver($provider)
            ->with(['state' => 'type=' . $type])
            ->stateless()
            ->redirect();
    }

    public function callback(Request $request, $provider)
    {
        try {
            $state = $request->input('state');
            parse_str($state, $stateParams);
            $type = $stateParams['type'] ?? 'user';

            $socialUser = Socialite::driver($provider)->stateless()->user();
            $socialAccount = SocialAccount::where('provider_name', $provider)
                ->where('provider_id', $socialUser->getId())
                ->first();

            if ($socialAccount) {
                $user = ($type === 'customer') ? $socialAccount->customer : $socialAccount->user;
            } else {
                if ($type === 'customer') {
                    $user = Customer::where('email', $socialUser->getEmail())->first();
                    if (!$user) {
                        $user = Customer::create([
                            'fullname' => $socialUser->getName(),
                            'email' => $socialUser->getEmail(),
                            'avatar' => $socialUser->getAvatar(),
                            'email_verified_at' => now(),
                        ]);
                    }
                } else {
                    $user = User::where('email', $socialUser->getEmail())->first();
                    if (!$user) {
                        $user = User::create([
                            'name' => $socialUser->getName(),
                            'email' => $socialUser->getEmail(),
                            'email_verified_at' => now(),
                        ]);
                    }
                }

                $user->socialAccounts()->create([
                    'provider_name' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);
            }

            $guard = ($type === 'customer') ? 'api_customer' : 'api';
            $token = auth($guard)->login($user);

            return view('auth.callback', [
                'token' => $token,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return view('auth.callback', [
                'error' => 'Đăng nhập thất bại: ' . $e->getMessage()
            ]);
        }
    }
}

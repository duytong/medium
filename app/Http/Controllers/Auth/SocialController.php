<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;

class SocialController extends Controller
{
    /**
     * Redirect the user to the provider authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $socialite = \Socialite::driver($provider)->user();
        $social    = \App\Social::where('provider_id', $socialite->id)->first();
        $email     = User::where('email', $socialite->email)->first();
        $username  = User::where('username', str_slug($socialite->name, ''))->first();

        if (!$social) {
            if (!$email && !$username) {
                if ($provider == 'github' || $provider == 'facebook') {
                    $file = file_get_contents($socialite->avatar);
                } else {
                    $file = file_get_contents($socialite->avatar_original);
                }
               
                $filename  = time() . '_' . str_random(9) . '.jpg';
                $location  = public_path('storage/users/' . $filename);
                \Image::make($file)->save($location);

                $user = User::create([
                    'name'     => $socialite->name,
                    'username' => str_slug($socialite->name, ''),
                    'email'    => $socialite->email,
                    'password' => bcrypt(str_random(6)),
                    'avatar'   => $filename
                ]);

                switch ($provider) {
                    case 'facebook':
                        $providerUrl = 'https://facebook.com/' . $socialite->id;
                        break;
                    case 'twitter':
                        $providerUrl = 'https://twitter.com/' . $socialite->nickname;
                        break;
                    case 'github':
                        $providerUrl = 'https://github.com/' . $socialite->nickname;
                        break;
                    default:
                        $providerUrl = null;
                        break;
                }

                $user->socials()->create([
                    'user_id' => $user->id,
                    'provider_id' => $socialite->id,
                    'provider' => $provider,
                    'provider_url' => $providerUrl
                ]);

                auth()->login($user, true);
                return redirect()->intended('/');
            } else {
                if (!empty($email)) {
                    $user = User::find($email->id);
                } else {
                    $user = User::find($username->id);
                }

                switch ($provider) {
                    case 'facebook':
                        $providerUrl = 'https://facebook.com/' . $socialite->id;
                        break;
                    case 'twitter':
                        $providerUrl = 'https://twitter.com/' . $socialite->nickname;
                        break;
                    case 'github':
                        $providerUrl = 'https://github.com/' . $socialite->nickname;
                        break;
                    default:
                        $providerUrl = null;
                        break;
                }

                $user->socials()->create([
                    'user_id' => $user->id,
                    'provider_id' => $socialite->id,
                    'provider' => $provider,
                    'provider_url' => $providerUrl
                ]);

                auth()->login($user, true);
                return redirect()->intended('/');
            }
        } else {
            auth()->login($social->user, true);
            return redirect()->intended('/');
        }
    }
}

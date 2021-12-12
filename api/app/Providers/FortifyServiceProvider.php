<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        Fortify::authenticateUsing(function (Request $request) {
            \Artisan::call('config:clear');
            \Artisan::call('cache:clear');
            \Artisan::call('config:cache');
            \DB::disconnect();
            $config = \Config::get('database.connections.mysql');
           // print_r( $config);
        $config['database'] = 'quickmas_'.$request->company_id;
        \config()->set('database.connections.mysql', $config);
        \DB::reconnect();
        \DB::purge('mysql');

        $config = \Config::get('database.connections.mysql');
        \config(['database.default'=>$request->company_id]);
            $user = User::where('email', $request->username)->orwhere('username', $request->username)->orwhere('phone', $request->username)->first();
           
            if ($user &&
                Hash::check($request->password, $user->password)) {
                    //return $user->createToken('token')->plainTextToken;
                return $user;
            }
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Hash;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }

    public static function generateBearerToken() {
        //Create a random token, and record it into the valid tokens file, along with the datetime
        //Ideally you'd like to hash user and date time, but date time will do for us
        $timestamp = now()->toDateTimeString();
        $token = Hash::make($timestamp);
        $tkFile = fopen('./validTokens.dat', 'w');
        fwrite($tkFile, $token . ',' . $timestamp . '\n');
        fclose($tkFile);
        return $token;
    }

    public static function validToken($token) {
        //Get the line from the file
        $file = fopen('./validTokens.dat', 'r');
        $line = fread($file, 160);
        //The first substr (64 chars) is the token, make sure that is the same as the one passed on the arg
        $fileToken = substr($line, 0, 64);
        return $token == $fileToken;
    }

}

<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Facades\Artisan;
use Brotzka\DotenvEditor\DotenvEditor;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $db = trim($input['username']);
        Artisan::call('config:clear');
Artisan::call('config:cache');
Artisan::call('cache:clear');
        DB::statement('create database ' .$db );
        // Config::set("database.connections.mysql", [
        //     "host" => "127.0.0.1",
        //     "database" => $db,
        //     "username" => "root",
        //     "password" => ""
        // ]);
        //get old dbname
$oldDbName = env("DB_DATABASE");


$env = new DotenvEditor();

// Changes the value of the Database name and username
$env->changeEnv([
    'DB_DATABASE'   => $db,
]);
Artisan::call('config:clear');
Artisan::call('config:cache');
Artisan::call('cache:clear');
DB::disconnect(env("DB_CONNECTION"));

Config::set('database.connections.' . env("DB_CONNECTION"), array(
        'driver'    => 'mysql', //or $request['driver'],
        'host'      => "127.0.0.1",
        'database'  => $db,
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_general_ci',
        'prefix'    => '',
));

//Trying reconnect database
try {
        DB::connection()->getPdo();
    } catch (\Exception $e) {
        DB::disconnect(env("DB_CONNECTION"));
        Config::set('database.connections.' . env("DB_CONNECTION") .'.database', $oldDbName );
    }
        Artisan::call('migrate');
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}

<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// need to run `php artisan user`
Artisan::command('user', function () {
    User::create([
        'name' => 'Test Console User',
        'email' => 'consoleuser@email.com',
        'password' => bcrypt('console')
    ]);
})->describe('Create sample user');

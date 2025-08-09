<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
//
//Broadcast::channel('admin.notifications', function ($user) {
//    return true; // Only admins get access
//});

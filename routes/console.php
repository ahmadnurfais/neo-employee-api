<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\ListModels;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

/**
 * Command to check the models list
 * Before call the handle method,
 * need to set the output context first
 */

// Artisan::command('models:list', function () {
//     (new ListModels())->handle();
// });

Artisan::command('models:list', callback: function () {
    $command = new ListModels();
    $command->setOutput($this->output);
    $command->handle();
});

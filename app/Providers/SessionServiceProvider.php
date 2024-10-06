<?php

namespace App\Providers;

use App\Session\MongoSessionHandler;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\ConnectionInterface;
use MongoDB\Laravel\MongoDBServiceProvider;

class SessionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(MongoDBServiceProvider::class); // Required to make the Laravel app recognize the mongodb
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(ConnectionInterface $connection)
    {
        /**
         * Code Example:
         * Access the session manager and get configuration values
         */
        // $sessionManager = $this->app['session'];
        // $table = $sessionManager->getSessionConfig()['table'];
        // $minutes = $sessionManager->getSessionConfig()['lifetime'];

        Session::extend('database', function ($app) use ($connection) {
            $table = config('session.table');
            $minutes = config('session.lifetime');
            return new MongoSessionHandler($connection, $table, $minutes, $app);
        });
    }
}

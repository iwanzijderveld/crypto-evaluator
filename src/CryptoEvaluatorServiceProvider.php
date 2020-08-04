<?php 

namespace Insanetlabs\CryptoEvaluator;

/**
 * @author Iwan van Zijderveld <iwanzijderveld@gmail.com>
 * @package Insanetlabs\CryptoEvaluator
 * 
 */
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Insanetlabs\CryptoEvaluator\Jobs\FetchCMCDataJob;
use Insanetlabs\CryptoEvaluator\Services\CoinMarketCapService;
use Insanetlabs\CryptoEvaluator\ViewComposers\CryptoEvaluatorViewComposer;

class CryptoEvaluatorServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        /**
         * Database migrations
         */
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        /**
         * Translation
         */
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'crypto-evaluator');

        /**
         * Controllers
         */
        $this->app->make('Insanetlabs\CryptoEvaluator\Controllers\CryptoEvaluatorController');
        $this->app->make('Insanetlabs\CryptoEvaluator\Controllers\Auth\LoginController');
        $this->app->make('Insanetlabs\CryptoEvaluator\Controllers\Auth\RegisterController');
        $this->app->make('Insanetlabs\CryptoEvaluator\Controllers\Auth\ForgotPasswordController');
        $this->app->make('Insanetlabs\CryptoEvaluator\Controllers\Auth\ResetPasswordController');

        /**
         * Routes
         */
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        /**
         * Views
         */
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'crypto-evaluator');

        $this->publishes([__DIR__ . '/../resources/css' => public_path('vendor/crypto-evaluator/css')], 'public');
        /**
         * Merge configuration files
         */
        $this->mergeConfigFrom(__DIR__ . '/../config/guards.php', 'auth.guards');
        $this->mergeConfigFrom(__DIR__ . '/../config/providers.php', 'auth.providers');
        $this->mergeConfigFrom(__DIR__ . '/../config/passwords.php', 'auth.passwords');

        $this->app->bind(CoinMarketCapService::class, function() {
            return new CoinMarketCapService();
        });

        View::composer('crypto-evaluator::layouts.app', CryptoEvaluatorViewComposer::class);
        
        $this->app->booted(function () {
            $schedule = app(Schedule::class);
            $schedule->job(new FetchCMCDataJob(app()->make(CoinMarketCapService::class)))->hourly();
        });
    }
}
?>
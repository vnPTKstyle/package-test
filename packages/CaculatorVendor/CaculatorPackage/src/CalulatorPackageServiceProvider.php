<?php

namespace CaculatorVendor\CaculatorPackage;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CalulatorPackageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');

        // Đăng ký view
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'caculatorpackage');

        // Đăng ký config
        $this->mergeConfigFrom(__DIR__ . '/../config/yourpackage.php', 'caculatorpackage');

        // Đăng ký middleware
        $router = $this->app->make(Route::class);
        $router->aliasMiddleware('log.http.methods', \CaculatorVendor\CaculatorPackage\Http\Middleware\LogHttpMethods::class);

        // Merge cấu hình logging
        $loggingConfig = config('logging.channels', []);
        $customConfig = require __DIR__.'/../config/logging.php';

        config()->set('logging.channels', array_merge($loggingConfig, $customConfig['channels']));

        $this->publishes([
            __DIR__ . '/../config/caculatorpackage.php' => config_path('caculatorpackage.php'),
        ]);
    }

    public function register()
    {
        // Đăng ký binding vào container
        $this->app->singleton('caculatorpackage', function ($app) {
            return new CalulatorPackageServiceProvider::class;
        });
    }
}

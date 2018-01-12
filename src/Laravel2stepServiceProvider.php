<?php

namespace jeremykenedy\laravel2step;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use jeremykenedy\laravel2step\App\Http\Middleware\Laravel2step;

class laravel2stepServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->middlewareGroup('twostep',[Laravel2step::class]);
        $this->loadTranslationsFrom(__DIR__.'/resources/lang/', 'laravel2step');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views/', 'laravel2step');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->mergeConfigFrom(__DIR__.'/config/laravel2step.php', 'laravel2step');
        $this->publishFiles();
    }

    /**
     * Publish files for Laravel Monitor.
     *
     * @return void
     */
    private function publishFiles()
    {
        $publishTag = 'laravel2step';

        $this->publishes([
            __DIR__.'/App/Mail/SendVerificationCode.php' => app_path('Mail/SendVerificationCode.php'),
        ], $publishTag);

        $this->publishes([
            __DIR__.'/config/laravel2step.php' => base_path('config/laravel2step.php'),
        ], $publishTag);


        // $this->publishes([
        //     __DIR__.'/resources/views/emails/verification.blade.php' => resource_path('views/emails/verification.blade.php'),
        // ], $publishTag);

        // $this->publishes([
        //     __DIR__.'/resources/views' => base_path('resources/views/vendor/laravel2step'),
        // ], $publishTag);

        // $this->publishes([
        //     __DIR__.'/resources/lang' => base_path('resources/lang/vendor/laravel2step'),
        // ], $publishTag);

    }
}

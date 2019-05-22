<?php

namespace RB28DETT\RB28DETT;

use Illuminate\Support\ServiceProvider;
use RB28DETT\RB28DETT\Commands\RB28DETTCreatePackage;
use RB28DETT\RB28DETT\Commands\RB28DETTInfo;
use RB28DETT\RB28DETT\Commands\RB28DETTPackages;
use RB28DETT\RB28DETT\Commands\RB28DETTPublish;
use RB28DETT\RB28DETT\Commands\RB28DETTSettings;
use RB28DETT\RB28DETT\Commands\RB28DETTSuperAdmins;
use RB28DETT\Permissions\PermissionsChecker;

class RB28DETTServiceProvider extends ServiceProvider
{
    /**
     * The mandatory permissions for the module.
     *
     * @var array
     */
    protected $permissions = [
        [
            'name' => 'RB28DETT Access',
            'slug' => 'rb28dett::access',
            'desc' => 'Grants access to all rb28dett infrastructure',
        ],
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        // Load middlewares
        $router->aliasMiddleware('rb28dett.base', Middleware\RB28DETTBase::class);
        $router->aliasMiddleware('rb28dett.auth', Middleware\RB28DETTAuth::class);

        $this->loadTranslationsFrom(__DIR__.'/Translations', 'rb28dett');

        $this->publishes([
            __DIR__.'/../config/rb28dett.php' => config_path('rb28dett.php'),
        ], 'rb28dett_config');

        $this->loadViewsFrom(__DIR__.'/Views', 'rb28dett');

        if (!$this->app->routesAreCached()) {
            require __DIR__.'/Routes/web.php';
            require __DIR__.'/Routes/api.php';
        }

        // Manually register other user packages
        $this->app->register('ConsoleTVs\\Charts\\ChartsServiceProvider');
        $this->app->register('Unicodeveloper\\Identify\\IdentifyServiceProvider');
        $this->app->register('Aitor24\\Localizer\\LocalizerServiceProvider');

        // Make sure the permissions are OK
        PermissionsChecker::check($this->permissions);

        // Mass service provider registerer & menu creator
        foreach (Packages::all() as $package) {
            $provider = Packages::provider($package);
            if ($provider) {
                if (class_exists('RB28DETT\\'.ucfirst($package)."\\$provider")) {
                    $this->app->register('RB28DETT\\'.ucfirst($package)."\\$provider");
                } elseif (class_exists('RB28DETT\\'.strtoupper($package)."\\$provider")) {
                    $this->app->register('RB28DETT\\'.strtoupper($package)."\\$provider");
                }
            }
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                RB28DETTInfo::class,
                RB28DETTPackages::class,
                RB28DETTPublish::class,
                RB28DETTSuperAdmins::class,
                RB28DETTSettings::class,
                RB28DETTCreatePackage::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/rb28dett.php', 'rb28dett'
        );
    }
}

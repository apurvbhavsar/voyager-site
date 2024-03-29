<?php


namespace Apurv\LaravelSite;

use Apurv\LaravelSite\Commands\InstallCommand;
use Apurv\LaravelSite\Commands\PageCommand;
use Apurv\LaravelSite\Facades\Site;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class VoyagerSiteProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('site', Site::class);




        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
            $this->commands(PageCommand::class);

            $this->commands(InstallCommand::class);
        }
    }

    /**
     * Bootstrap services.
     * @todo Create install command to check if tcg voyager installed or not
     * @todo If installed then add our pages and seed database
     * @todo Create new command to create page in database and add in site menu with option in cmd
     *
     * @return void
     */
    public function boot()
    {
        // $this->publishes([
        //     __DIR__ . '/../config/voyager-site.php' => config_path('voyager-site.php'),
        //     __DIR__ . '/../database/migrations' => 'database/migrations',
        //     __DIR__ . '/../database/seeders' => 'database/seeders',
        // ]);

        // $this->publishes([
        //     __DIR__ . '/../assets' => public_path('assets'),
        // ], 'public');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'voyager-site');
    }

    /**
     * Register the publishable files.
     */
    private function registerPublishableResources()
    {
        $this->publishes([
            __DIR__ . '/../config/voyager-site.php' => config_path('voyager-site.php'),
            __DIR__ . '/../database/migrations' => 'database/migrations',
            __DIR__ . '/../database/seeders' => 'database/seeders',
        ]);

        $this->publishes([
            __DIR__ . '/../assets' => public_path('assets'),
        ], 'public');
    }
}

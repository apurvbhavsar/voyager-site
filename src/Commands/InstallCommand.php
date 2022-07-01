<?php

namespace Apurv\LaravelSite\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Filesystem;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Voyager Site with Pages module and basic configuration';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Filesystem $filesystem)
    {
        $this->info('Publishing the Voyager Site assets, database, and config file');

        // Publish only relevant resources on install
        $tags = ['seeds'];

        $this->call('vendor:publish', ['--provider' => VoyagerSiteProvider::class, '--tag' => $tags]);

        $this->info('Migrating the database tables into your application');
        $this->call('migrate', ['--force' => $this->option('force')]);

        $this->info('Adding Dynamic CMS route to routes/web.php');
        $routes_contents = $filesystem->get(base_path('routes/web.php'));
        if (false === strpos($routes_contents, 'Voyager::routes()')) {
            $filesystem->append(
                base_path('routes/web.php'),
                PHP_EOL . PHP_EOL . "Route::get('/{slug?}', [Apurv\LaravelSite\Http\Controllers\CMSController::class, 'index']);" .  PHP_EOL
            );
        }

        $publishablePath = dirname(__DIR__) . '/../publishable';

        $this->call('vendor:publish', ['--provider' => VoyagerSiteProvider::class, '--tag' => ['config', 'voyager_avatar']]);

        // $this->addNamespaceIfNeeded(
        //     collect($filesystem->files("{$publishablePath}/database/seeds/")),
        //     $filesystem
        // );

        $this->info('Dumping the autoloaded files and reloading all new files');
        $this->composer->dumpAutoloads();
        require_once base_path('vendor/autoload.php');

        $this->info('Seeding data into the database');
        $this->call('db:seed', ['--class' => 'SiteDatabaseSeeder']);

        $this->info('Successfully installed Dyanamic Web Engine! Enjoy');

        return Command::SUCCESS;
    }
}

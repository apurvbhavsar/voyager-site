<?php

namespace Apurv\LaravelSite\Commands;

use Apurv\LaravelSite\VoyagerSiteProvider;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;

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
    public function __construct(Composer $composer)
    {
        parent::__construct();

        $this->composer = $composer;
        $this->composer->setWorkingPath(base_path());
    }

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production', null]
        ];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Filesystem $filesystem)
    {
        $routes_contents = $filesystem->get(base_path('routes/web.php'));

        $this->info('Publishing the Voyager Site assets, database, and config file');

        $this->info('Checking if Voyager Admin panel is installed');
        if (
            false === strpos($routes_contents, 'Voyager::routes()')
        ) {
            $this->error('Voyager not Installed. Installing the Voyager Admin panel');
            $this->call('voyager:install');
        } else {
            $this->info('Found! Voyager Installed');
        }
        // Publish only relevant resources on install
        $tags = ['seeds'];

        $this->call('vendor:publish', ['--provider' => VoyagerSiteProvider::class]);

        $this->info('Migrating the database tables into your application');
        $this->call('migrate');

        $this->info('Adding Dynamic CMS route to routes/web.php');

        if (false === strpos($routes_contents, "Route::get('/{slug?}'")) {
            $filesystem->append(
                base_path('routes/web.php'),
                PHP_EOL . PHP_EOL . "Route::get('/{slug?}', [Apurv\LaravelSite\Http\Controllers\CMSController::class, 'index']);" .  PHP_EOL
            );
        }

        $this->info('Dumping the autoloaded files and reloading all new files');
        $this->composer->dumpAutoloads();
        require_once base_path('vendor/autoload.php');

        $this->info('Seeding data into the database');
        $this->call('db:seed', ['--class' => 'SiteDatabaseSeeder']);

        $this->info('Successfully installed Dyanamic Web Engine! Enjoy');

        return Command::SUCCESS;
    }
}

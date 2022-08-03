<?php

namespace Apurv\LaravelSite\Commands;

use Apurv\LaravelSite\Models\Page;
use Apurv\LaravelSite\VoyagerSiteProvider;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;

class PageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'page:create 
                                {title : Title of the page}
                                {--T|t|template=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new page with default template';

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
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../../stubs/default.stub';
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Creating new page with default template');

        $title = $this->argument('title');
        $template = $this->option('template');

        $this->createPage($title, $template);
        

        $this->info('Successfully installed Dyanamic Web Engine! Enjoy');

        return Command::SUCCESS;
    }

    private function createPage($title, $template) {
        return Page::create([
            'title' => $title,
            'template' => $template,
            'slug' => str_slug($title),
            'status' => 'DRAFT'           
        ]);
    }
}

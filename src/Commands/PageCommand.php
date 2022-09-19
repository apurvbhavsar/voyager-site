<?php

namespace Apurv\LaravelSite\Commands;

use Apurv\LaravelSite\Models\Page;
use Illuminate\Console\Command;

class PageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'page:create { title : Title of the page } {--template=default : Template name}';

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


        $this->info('Successfully created New Page! Enjoy');

        return Command::SUCCESS;
    }

    private function createPage($title, $template) {
        return Page::create([
            'title' => $title,
            'template' => $template,
            'slug' => $this->create_slug($title),
            'status' => '0',
            'author_id' => '1'
        ]);
    }

    function create_slug($str) {
        $str = strtolower($str);
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = preg_replace('/-+/', "-", $str);
        return $str;
    }
}

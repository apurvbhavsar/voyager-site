<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Apurv\LaravelSite\Models\Page;
use TCG\Voyager\Models\Permission;

class SitePageTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        Permission::generateFor('pages');

        //Content
        $page = Page::firstOrNew([
            'slug' => 'home',
        ]);
        if (!$page->exists) {
            $page->fill([
                'author_id' => 1,
                'title'     => 'Home',
                'excerpt'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'body'      => null,
                'image'            => '',
                'meta_description' => 'Meta Description',
                'meta_keywords'    => 'Keyword1, Keyword2',
                'status'           => Page::STATUS_ACTIVE,
                'template'         => 'home',
            ])->save();
        }
    }
}

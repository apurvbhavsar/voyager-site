<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;

class SiteMenusTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        Menu::firstOrCreate([
            'name' => 'admin',
        ]);

        //Create Site menu for Website
        Menu::firstOrCreate([
            'name' => 'site',
        ]);

        //Create Social menu for Website Footer
        Menu::firstOrCreate([
            'name' => 'social',
        ]);

        //Create Social menu for Website Footer
        Menu::firstOrCreate([
            'name' => 'footer',
        ]);
    }
}

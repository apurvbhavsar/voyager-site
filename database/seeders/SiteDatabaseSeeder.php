<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SiteDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SiteSettingSeeder::class,
            SiteMenusTableSeeder::class,
            SiteMenuItemsTableSeeder::class,
            SitePageTableSeeder::class,
        ]);
    }
}

<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class SiteMenuItemsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::where('name', 'admin')->firstOrFail();

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.pages'),
            'url'     => '',
            'route'   => 'voyager.pages.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-file-text',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 7,
            ])->save();
        }

        $sitemenu = Menu::where('name', 'site')->firstOrFail();

        $siteMenuItem = MenuItem::firstOrNew([
            'menu_id' => $sitemenu->id,
            'title'   => __('Home'),
            'url'     => '/',
            'route'   => '',
        ]);
        if (!$siteMenuItem->exists) {
            $siteMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-file-text',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 1,
            ])->save();
        }

        // Social menu items need to be added
        $socialmenu = Menu::where('name', 'social')->firstOrFail();

        $socialMenuItem = MenuItem::firstOrNew([
            'menu_id' => $socialmenu->id,
            'title'   => __('Facebook'),
            'url'     => '#',
            'route'   => '',
        ]);
        if (!$socialMenuItem->exists) {
            $socialMenuItem->fill([
                'target'     => '_blank',
                'icon_class' => 'fab fa-facebook-f',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 1,
            ])->save();
        }

        $socialMenuItem = MenuItem::firstOrNew([
            'menu_id' => $socialmenu->id,
            'title'   => __('LinkedIn'),
            'url'     => '#',
            'route'   => '',
        ]);
        if (!$socialMenuItem->exists) {
            $socialMenuItem->fill([
                'target'     => '_blank',
                'icon_class' => 'fab fa-linkedin-in',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 2,
            ])->save();
        }

        $socialMenuItem = MenuItem::firstOrNew([
            'menu_id' => $socialmenu->id,
            'title'   => __('Twitter'),
            'url'     => '#',
            'route'   => '',
        ]);
        if (!$socialMenuItem->exists) {
            $socialMenuItem->fill([
                'target'     => '_blank',
                'icon_class' => 'fab fa-twitter',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 3,
            ])->save();
        }

        $socialMenuItem = MenuItem::firstOrNew([
            'menu_id' => $socialmenu->id,
            'title'   => __('Instagram'),
            'url'     => '#',
            'route'   => '',
        ]);
        if (!$socialMenuItem->exists) {
            $socialMenuItem->fill([
                'target'     => '_blank',
                'icon_class' => 'fab fa-instagram',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 4,
            ])->save();
        }

        //Footer menu items
        $footermenu = Menu::where('name', 'footer')->firstOrFail();

        $siteMenuItem = MenuItem::firstOrNew([
            'menu_id' => $footermenu->id,
            'title'   => __('Terms and Condition'),
            'url'     => '/terms-and-conditions',
            'route'   => '',
        ]);
        if (!$siteMenuItem->exists) {
            $siteMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-file-text',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 1,
            ])->save();
        }

        $siteMenuItem = MenuItem::firstOrNew([
            'menu_id' => $footermenu->id,
            'title'   => __('Privacy Policy'),
            'url'     => '/privacy-policy',
            'route'   => '',
        ]);
        if (!$siteMenuItem->exists) {
            $siteMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-file-text',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 2,
            ])->save();
        }
    }
}

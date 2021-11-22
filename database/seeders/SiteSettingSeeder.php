<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Setting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $setting = $this->findSetting('site.description');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('Description'),
                'value'        => __('description'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 5,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.address');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('Address'),
                'value'        => __('address'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 6,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.email');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('Email'),
                'value'        => __('email'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 7,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.phone');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('Phone'),
                'value'        => __('phone'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'Site',
            ])->save();
        }
    }

    /**
     * [setting description].
     *
     * @param [type] $key [description]
     *
     * @return [type] [description]
     */
    protected function findSetting($key)
    {
        return Setting::firstOrNew(['key' => $key]);
    }
}

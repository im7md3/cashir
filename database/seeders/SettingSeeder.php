<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();
        Setting::create(['key' => 'website_name','value' => 'كاشير',]);
        Setting::create(['key' => 'tax_no','value' => '123123',]);
        Setting::create(['key' => 'tax','value' => '10',]);
        Setting::create(['key' => 'capital','value' => '100000',]);
        Setting::create(['key' => 'address','value' => 'عنوان الشركه',]);
        Setting::create(['key' => 'building_no','value' => '100',]);
        Setting::create(['key' => 'street','value' => 'اسم شارع',]);
        Setting::create(['key' => 'phone','value' => '+966 554 913915',]);
        Setting::create(['key' => 'active_tax','value' => 1,]);
        Setting::create(['key' => 'website_inactive_message','value' => 'نعتذر الموقع مغلق للصيانة ....!!',]);
        Setting::create(['key' => 'website_active','value' => 1,]);
        Setting::create(['key' => 'logo_img','value' => 'settings/1.jpg',]);
        Setting::create(['key' => 'site_img','value' => 'settings/2.jpeg',]);


        // Setting::create(['key' => 'link','value' => 'https://law-mawthuq.com/',]);
        // Setting::create(['key' => 'facebook','value' => 'https://facebook.com/',]);
        // Setting::create(['key' => 'twitter','value' => 'https://twitter.com/',]);
        // Setting::create(['key' => 'snapchat','value' => 'https://snapchat.com/',]);
        // Setting::create(['key' => 'support_mail','value' => 'm@gmail.com',]);
        // Setting::create(['key' => 'email','value' => 'mmmm@gmail.com',]);


    }
}

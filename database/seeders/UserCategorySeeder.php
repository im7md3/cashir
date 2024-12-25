<?php

namespace Database\Seeders;

use App\Models\UserCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        UserCategory::truncate();
        UserCategory::create(['name' => 'الإدارة']);
        UserCategory::create(['name' => 'موظف']);
        UserCategory::create(['name' => 'محاسب']);
        UserCategory::create(['name' => 'استقبال']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

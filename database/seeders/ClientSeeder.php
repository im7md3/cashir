<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Client::truncate();
        Client::create(['name' => 'احمد رجب', 'phone' => '0000','social_situation'=>'single']);
        Client::create(['name' => 'محمد خالد', 'phone' => '1111','social_situation'=>'married']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

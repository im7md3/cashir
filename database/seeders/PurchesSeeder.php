<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Purchase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Purchase::truncate();
        Purchase::create([
            'name' => 'sssssss',
            'amount' => '5000',
            'status' => 0,
        ]);
        Purchase::create([
            'name' => 'zzz',
            'amount' => '1000',
            'status' => 1,
        ]);
        Purchase::create([
            'name' => 'ddddd',
            'amount' => '6000',
            'status' => 1,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

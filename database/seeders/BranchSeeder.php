<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Branch::truncate();
        Branch::create(['name' => 'فرع 1']);
        Branch::create(['name' => 'فرع 2']);
        Branch::create(['name' => 'فرع 3']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Department::truncate();
        Department::create(['name' => 'عصائر']);
        Department::create(['name' => 'مشاوي']);
        Department::create(['name' => 'أسماك']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

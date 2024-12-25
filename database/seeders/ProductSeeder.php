<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        Product::create(['name' => 'برتقال','department_id'=>1,'saleprice'=>5,'price'=>7,'cover' => '1.jpg','unit_id'=>1,'code'=>'111']);
        Product::create(['name' => 'مانجا','department_id'=>1,'saleprice'=>5,'price'=>10,'cover' => '2.jpg','unit_id'=>1,'code'=>'222']);
        Product::create(['name' => 'شاورما','department_id'=>2,'saleprice'=>5,'price'=>15,'cover' => '3.jpg','unit_id'=>2,'code'=>'333']);
        Product::create(['name' => 'كباب','department_id'=>2,'saleprice'=>5,'price'=>20,'cover' => '4.jpg','unit_id'=>2,'code'=>'444']);
        Product::create(['name' => 'فليه','department_id'=>3,'saleprice'=>5,'price'=>25,'cover' => '5.jpg','unit_id'=>3,'code'=>'555']);
        Product::create(['name' => 'جمبري','department_id'=>3,'saleprice'=>5,'price'=>30,'cover' => '6.jpg','unit_id'=>3,'code'=>'666']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

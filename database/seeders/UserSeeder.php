<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        $superadmin = User::create([
            'name' => 'ادارة الموقع',
            'phone' => '0000',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'user_category_id' => 1,
            'remember_token'     => Str::random(10),
            'email_verified_at' => now(),
        ]);
        $superadmin->attachRole('super_admin');
        $admin = User::create([
            'name'         => 'yasin',
            'phone'             => '01000000000',
            'email'             => 'admin@app.com',
            'password'          => bcrypt('123123'),
            'user_category_id'  => 1,
            'remember_token'     => Str::random(10),
            'email_verified_at' => now(),
        ]);
        $admin->attachRole('admin');
        $user = User::create([
            'name'              => 'sara',
            'phone'             => '01000000005',
            'email'             => 'user@app.com',
            'password'          => bcrypt('123123'),
            'user_category_id'  => 1,
            'remember_token'     => Str::random(10),
            'email_verified_at' => now(),
        ]);
        $user->attachRole('user');
        // for ($i = 1; $i <= 20; $i++) {
        //     $random_user = User::create([
        //         'name'              => $faker->name,
        //         'phone'             => '010' . $faker->numberBetween(10000000, 99999999),
        //         'email'             => $faker->unique()->safeEmail,
        //         'password'          => bcrypt('123123'),
        //         'user_category_id'  => 1,
        //         'remember_token'     => Str::random(10),
        //         'email_verified_at' => now(),
        //     ]);
        //     $random_user->attachRole('user');
        // }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

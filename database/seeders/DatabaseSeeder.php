<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\UserCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingSeeder::class,
            BranchSeeder::class,
            PaymentMethodSeeder::class,
            DepartmentSeeder::class,
            UnitSeeder::class,
            ProductSeeder::class,
            ClientSeeder::class,
            UserCategorySeeder::class,
            LaratrustSeeder::class,
            UserSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

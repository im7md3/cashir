<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create([
            'name' => 'درج نقدية 1',
            'status' => 1,
            'is_cash' => 1,
            'default_payment' => 0,
        ]);

        PaymentMethod::create([
            'name' => 'درج نقدية 2',
            'status' => 1,
            'is_cash' => 1,
            'default_payment' => 0,
        ]);

        PaymentMethod::create([
            'name' => 'شبكة',
            'status' => 1,
            'is_cash' => 0,
            'default_payment' => 1,
        ]);

        PaymentMethod::create([
            'name' => 'تحويل',
            'status' => 1,
            'is_cash' => 0,
            'default_payment' => 0,
        ]);
    }
}

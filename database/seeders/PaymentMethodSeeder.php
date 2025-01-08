<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $paymentMethods = [
            [
                'name' => 'Bank Transfer BCA',
                'description' => 'Transfer ke rekening BCA Sabaleh Homestay',
                'account_name' => 'PT Sabaleh Homestay',
                'account_number' => '1234567890',
            ],
            [
                'name' => 'Bank Transfer Mandiri',
                'description' => 'Transfer ke rekening Mandiri Sabaleh Homestay',
                'account_name' => 'PT Sabaleh Homestay',
                'account_number' => '0987654321',
            ],
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::create($method);
        }
    }
}
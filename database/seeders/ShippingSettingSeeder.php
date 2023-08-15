<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliverySetting;
use App\Models\PaymentSetting;

class ShippingSettingSeeder extends Seeder
{
    public $delivery_methods = [
        [
            'name' => 'Delivery',
            'icon_class' => 'bx bxs-truck',
            'status' => 1,
            'created_by' => 1
        ],
        [
            'name' => 'Self-Pickup',
            'icon_class' => 'bx bxs-store-alt',
            'status' => 2,
            'created_by' => 1
        ]
    ];

    public $payment_settings = [
        [
            'name' => 'Purchase Wallet',
            'icon_class' => 'bx bxs-wallet',
            'created_by' => 1
        ],
        [
            'name' => 'Manual Transfer',
            'icon_class' => 'bx bxl-paypal',
            'created_by' => 1
        ],
        [
            'name' => 'Online Banking',
            'icon_class' => 'bx bx-credit-card',
            'created_by' => 1
        ],
        [
            'name' => 'Payment at Counter',
            'icon_class' => 'bx bx-money',
            'created_by' => 1
        ]
    ];

    public function run()
    {
        foreach ($this->delivery_methods as $delivery_method) {
            DeliverySetting::create($delivery_method);
        }
        foreach ($this->payment_settings as $payment_setting) {
            PaymentSetting::create($payment_setting);
        }
    }
}

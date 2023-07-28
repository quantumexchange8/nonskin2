<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentStatus;

class PaymentStatusSeeder extends Seeder
{
    public $payment_statues = [
        [
            'name' => 'Pending',
            'description' => 'This status can be used for payments that have been initiated but are yet to be completed or verified',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Paid',
            'description' => 'This status indicates that the payment has been successfully processed and received',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Failed',
            'description' => 'This status can be used for payments that have failed or encountered an error during the processing',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Refunded',
            'description' => 'This status represents payments that have been refunded to the customer',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Partially Refunded',
            'description' => 'In case of partial refunds, this status can indicate that only a portion of the payment amount has been refunded',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Authorized',
            'description' => 'This status can be used when the payment has been authorized but not yet captured. Some payment gateways may support an authorization step before the actual payment capture',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Chargeback',
            'description' => 'This status can be used when a chargeback has been initiated by the customer or the card issuer',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Canceled',
            'description' => 'This status can be used for payments that have been canceled before completion',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Expired',
            'description' => 'This status can indicate payments that have expired or timed out without successful completion',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Onhold',
            'description' => 'This status can be used when a payment is put on hold for manual review or additional verification',
            'updated_at' => null,
            'created_by' => 1
        ]
    ];

    public function run()
    {
        foreach ($this->payment_statues as $payment_status) {
            PaymentStatus::create($payment_status);
        }
    }
}

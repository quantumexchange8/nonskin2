<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

enum WalletType: string
{
    case PURCHASE_WALLET = 'Purchase Wallet';
    case CASH_WALLET = 'Cash Wallet';
    case PRODUCT_WALLET = 'Product Wallet';
}

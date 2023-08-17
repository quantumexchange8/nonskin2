<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

enum WalletType: string
{
    case PURCHASE_WALLET = 'purchase_wallet';
    case CASH_WALLET = 'cash_wallet';
    case PRODUCT_WALLET = 'product_wallet';
}

<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

enum PaymentType: string
{
    case DEPOSIT = 'Deposit';
    case WITHDRAW = 'Withdraw';
}

<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

enum PaymentStatus: string
{
    case PENDING = 'Pending';
    case SUCCESS = 'Success';
    case FAILED = 'Failed';
}

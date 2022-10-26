<?php

namespace App\Enums;

enum BloodType: string
{

    case APOSITIVE = 'A Positive';
    case ANEGATIVE = 'A Negative';
        //
    case BPOSITIVE = 'B Positive';
    case BNEGATIVE = 'B Negative';
        //
    case OPOSITIVE = 'O Positive';
    case ONEGATIVE = 'O Negative';
        //
    case ABPOSITIVE = 'AB Positive';
    case ABNEGATIVE = 'AB Negative';
}

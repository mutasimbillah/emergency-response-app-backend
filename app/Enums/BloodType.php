<?php

namespace App\Enums;

enum BloodType: string
{

    case APOSITIVE = 'A+';
    case ANEGATIVE = 'A-';
        //
    case BPOSITIVE = 'B+';
    case BNEGATIVE = 'B-';
        //
    case OPOSITIVE = 'O+';
    case ONEGATIVE = 'O-';
        //
    case ABPOSITIVE = 'AB+';
    case ABNEGATIVE = 'AB-';
}

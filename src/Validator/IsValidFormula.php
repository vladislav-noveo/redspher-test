<?php

namespace App\Validator;

use App\Validator\BaseConstraint;
use Attribute;

#[Attribute]
class IsValidFormula extends BaseConstraint
{
    public string $message = 'formula.invalid';
}

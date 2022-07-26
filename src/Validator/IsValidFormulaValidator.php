<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class IsValidFormulaValidator extends ConstraintValidator
{
    public function __construct()
    {}

    private $regex = "/^\d+(\.\d+){0,1}([+\-*\/]{1}\d+(\.\d+){0,1})+$/";
    public function validate($value, Constraint $constraint)
    {
        if(preg_match($this->regex, $value)) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->addViolation();
    }
}

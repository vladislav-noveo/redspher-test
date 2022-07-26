<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

abstract class BaseConstraint extends Constraint
{
    public string $message;
    /**
     * {@inheritDoc}
     */
    public function validatedBy()
    {
        return static::class.'Validator';
    }
}

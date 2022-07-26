<?php

namespace App\Service;

interface CalculationServiceInterface
{
    public function calculate(string $mathProblem): float;
}

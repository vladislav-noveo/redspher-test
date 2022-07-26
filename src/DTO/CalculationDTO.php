<?php

namespace App\DTO;

use App\Validator\IsValidFormula;
use Symfony\Component\Validator\Constraints as Assert;

class CalculationDTO
{
    #[Assert\Type('string')]
    #[IsValidFormula]
    private $input;

    public function setInput(string $input): self
    {
        $this->input = $input;

        return $this;
    }

    public function getInput(): string
    {
        return $this->input;
    }
}

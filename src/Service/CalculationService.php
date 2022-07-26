<?php

namespace App\Service;

final class CalculationService implements CalculationServiceInterface
{
    private const REGEX_DIV_MULT = '/(\d+(\.\d+){0,1})([\*\/])(\d+(\.\d+){0,1})/';
    private const REGEX_SUM_SUB = '/(\d+(\.\d+){0,1})([\+\-])(\d+(\.\d+){0,1})/';

    public function calculate(string $mathProblem): float
    {
        $mathProblem = $this->processMultiplicationAndDivision($mathProblem);
        $mathProblem = $this->processAddAndSubtract($mathProblem);

        return (float) $mathProblem;
    }

    private function processMultiplicationAndDivision($mathProblem): string
    {
        while (preg_match(self::REGEX_DIV_MULT, $mathProblem)) {
            $mathProblem = preg_replace_callback(
                self::REGEX_DIV_MULT,
                function ($matches) {
                    $replace = '';
                    match ($matches[3]) {
                        '*' => $replace = $matches[1] * $matches[4],
                        '/' => $replace = $matches[1] / $matches[4],
                    };
                    
                    return $replace;
                },
                $mathProblem
            );
        }

        return $mathProblem;
    }

    private function processAddAndSubtract($mathProblem): string
    {
        while (preg_match(self::REGEX_SUM_SUB, $mathProblem)) {
            $mathProblem = preg_replace_callback(
                self::REGEX_SUM_SUB,
                function ($matches) {
                    $replace = '';
                    match ($matches[3]) {
                        '+' => $replace = $matches[1] + $matches[4],
                        '-' => $replace = $matches[1] - $matches[4],
                    };
                    
                    return $replace;
                },
                $mathProblem
            );
        }

        return $mathProblem;
    }
}

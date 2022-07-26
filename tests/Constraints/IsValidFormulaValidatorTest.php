<?php

namespace App\Tests\Constraints;

use App\Validator\IsValidFormula;
use App\Validator\IsValidFormulaValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class IsValidFormulaValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new IsValidFormulaValidator();
    }

    /**
     * @dataProvider validDataProvider
     */
    public function testValidData($input)
    {
        $this->validator->validate($input, new IsValidFormula());
        $this->assertNoViolation();
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testInvalidData($input)
    {
        $this->validator->validate($input, new IsValidFormula());

        $this->buildViolation('formula.invalid')
            ->assertRaised();
    }

    private function validDataProvider(): array
    {
        return [
            [
                'input' => '1+1',
            ],
            [
                'input' => '1-1',
            ],
            [
                'input' => '2*2',
            ],
            [
                'input' => '2/2',
            ],
            [
                'input' => '1*1+1',
            ],
            [
                'input' => '1/1+1',
            ],
            [
                'input' => '1.5+1.5',
            ],
        ];
    }

    private function invalidDataProvider(): array
    {
        return [
            [
                'input' => '1++1',
            ],
            [
                'input' => '1*+1',
            ],
            [
                'input' => '1-',
            ],
            [
                'input' => '/2',
            ],
            [
                'input' => '2*2.',
            ],
            [
                'input' => '2.*2',
            ],
            [
                'input' => '.2*2',
            ],
            [
                'input' => '2*.2',
            ],
        ];
    }
}

<?php

namespace App\Tests\Form\Type;

use App\DTO\CalculationDTO;
use App\Form\Type\CalculationDTOType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\PreloadedExtension;

class CalculationDTOTypeTest extends TypeTestCase
{
    protected function getExtensions()
    {
        $type = new CalculationDTOType();

        return [
            new PreloadedExtension([$type], []),
        ];
    }

    /**
     * @dataProvider validDataProvider
     */
    public function testSubmitValidData($input)
    {
        $dto = new CalculationDTO();
        $form = $this->factory->create(CalculationDTOType::class, $dto);

        $formData = [
            'input' => $input
        ];
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertSame($input, $dto->getInput());
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
}


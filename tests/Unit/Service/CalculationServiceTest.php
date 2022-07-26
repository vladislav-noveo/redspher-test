<?php

namespace App\Tests\Feature\Service;

use App\Service\CalculationService;
use App\Service\CalculationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalculationServiceTest extends KernelTestCase
{
    private CalculationService $service;

    public function setUp(): void
    {
        $this->service = static::getContainer()->get(CalculationServiceInterface::class);
    }

    /**
     * @dataProvider calculationDataProvider
     */
    public function testResults($problem, $solution)
    {
        $result = $this->service->calculate($problem);

        $this->assertEquals($solution, $result);
    }

    private function calculationDataProvider(): array
    {
        return [
            [
                'problem' => '2+2',
                'solution' => 4,
            ],
            [
                'problem' => '2-2',
                'solution' => 0,
            ],
            [
                'problem' => '2*2',
                'solution' => 4,
            ],
            [
                'problem' => '2/2',
                'solution' => 1,
            ],
            [
                'problem' => '2+2*2',
                'solution' => 6,
            ],
            [
                'problem' => '2+2/2',
                'solution' => 3,
            ],
            [
                'problem' => '2-2*2',
                'solution' => -2,
            ],
            [
                'problem' => '2-2/2',
                'solution' => 1,
            ],
            [
                'problem' => '2*2*2',
                'solution' => 8,
            ],
            [
                'problem' => '2*2/2',
                'solution' => 2,
            ],
            [
                'problem' => '2/2*2',
                'solution' => 2,
            ],
            [
                'problem' => '2/2/2',
                'solution' => 0.5,
            ],
            [
                'problem' => '2+3*4-2/5',
                'solution' => 13.6,
            ],
            [
                'problem' => '2-1*4/5+5/2',
                'solution' => 3.7,
            ],
        ];
    }
}

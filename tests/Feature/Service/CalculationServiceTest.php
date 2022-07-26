<?php

namespace App\Tests\Feature\Service;

use App\Service\CalculationService;
use App\Service\CalculationServiceInterface;
use App\Tests\AbstractWebTestCase;

class CalculationServiceTest extends AbstractWebTestCase
{
    private CalculationService $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->container->get(CalculationServiceInterface::class);
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
        ];
    }
}

<?php

namespace App\Tests\Feature\Controller;

use App\Tests\AbstractWebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CalculationControllerTest extends AbstractWebTestCase
{
    private string $pageUrl;
    private string $postUrl;

    public function setUp(): void
    {
        parent::setUp();

        $this->pageUrl = $this->urlGenerator->generate('calculator.page');
        $this->postUrl = $this->urlGenerator->generate('calculator.doCalc');
    }

    public function testPage()
    {
        $this->client->request('GET', $this->pageUrl);

        $this->assertResponseIsSuccessful();
    }

    /**
     * @dataProvider validDataProvider
     */
    public function testSubmitProblemSuccessful($input)
    {
        $this->client->request(
            'POST',
            $this->postUrl,
            ['input' => $input]
        );

        $this->assertResponseRedirects();
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testSubmitProblemValidationError($input)
    {
        $this->expectException(BadRequestHttpException::class);

        $this->client->request(
            'POST',
            $this->postUrl,
            ['input' => $input]
        );
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

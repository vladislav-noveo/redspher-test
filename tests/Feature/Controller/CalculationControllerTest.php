<?php

namespace App\Tests\Feature\Controller;

use App\Tests\AbstractWebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CalculationControllerTest extends AbstractWebTestCase
{
    private string $pageUrl;

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
}

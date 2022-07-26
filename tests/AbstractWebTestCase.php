<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

abstract class AbstractWebTestCase extends WebTestCase
{
    protected KernelBrowser $client;
    protected ContainerInterface $container;
    protected UrlGeneratorInterface $urlGenerator;

    protected function setUp(): void
    {
        static::ensureKernelShutdown(); // creating factories boots the kernel; shutdown before creating the client

        $this->client = static::createClient();
        $this->client->catchExceptions(false);

        $this->container = static::getContainer();
        $this->urlGenerator = $this->container->get(UrlGeneratorInterface::class);
    }
}

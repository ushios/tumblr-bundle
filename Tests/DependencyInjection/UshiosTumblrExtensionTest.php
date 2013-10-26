<?php

namespace Ushios\Bundle\TumblrBundle\Tests\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UshiosTumblrExtensionTest extends WebTestCase
{
    /**
     * service container.
     */
    protected $container;

    /**
     * Setup test.
     *  @return null
     */
    public function setUp()
    {
        $this->app = new \AppKernel('test', true);
        $this->app->boot();
        $this->container = $this->app->getContainer();

        parent::setUp();
    }

    /**
     * Test getting aws client.
     * @return null
     */
    public function testGetTumblrClient()
    {
        $tumblr = $this->container->get('ushios_tumblr_client.default');
        
        $this->assertInstanceOf('\Tumblr\API\Client', $tumblr);
    }
}

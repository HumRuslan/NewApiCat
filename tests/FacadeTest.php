<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use src\ApiFacade;
use src\Apis\ImagesApi;
use src\Clients\HttpClientInterface;

class FacadeTest extends TestCase
{
    /**
     * @test
     */
    public function we_can_call_facade()
    {
        $client = $this->createMock(HttpClientInterface::class);

        $facade = new ApiFacade($client);

        $this->assertInstanceOf(ImagesApi::class, $facade->images());
    }
    
    /**
     * @test
     */
    public function we_throw_exception()
    {
        $client = $this->createMock(HttpClientInterface::class);

        $facade = new ApiFacade($client);

        $this->expectException(\BadMethodCallException::class);

        $facade->categories();
    }
}

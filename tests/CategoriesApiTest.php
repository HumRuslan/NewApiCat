<?php


namespace tests;


use PHPUnit\Framework\TestCase;
use src\Apis\CategoriesApi;
use src\Clients\HttpClientInterface;
use src\Exceptions\ApiException;
use src\Models\Images\Category;

class CategoriesApiTest extends TestCase
{
    const CATEGORIES_RESPONSE = <<<'RESPONSE'
[{"id":5,"name":"boxes"},{"id":15,"name":"clothes"},{"id":1,"name":"hats"},{"id":14,"name":"sinks"},{"id":2,"name":"space"},{"id":4,"name":"sunglasses"},{"id":7,"name":"ties"}]
RESPONSE;

    /**
     * @test
     */

    public function we_can_perfom_a_list()
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects($this->once())->method('get')->willReturn(json_decode(self::CATEGORIES_RESPONSE, true));

        $api = new CategoriesApi($client);
        $result = $api->list();
        $this->assertIsArray($result);
        $this->assertInstanceOf(Category::class, $result[0]);
    }

    /**
     * @test
     */

    public function we_throw_valid_exception()
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willThrowException(
            $this->createMock(ApiException::class)
        );

        $api = new CategoriesApi($client);

        $this->expectException(ApiException::class);
        $api->list();
    }
}
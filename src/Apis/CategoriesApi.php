<?php


namespace src\Apis;

use src\Builders\Categories\ListResultBuilder;
use src\Clients\HttpClientInterface;

class CategoriesApi
{
    private HttpClientInterface $client;

    /**
     * CategoriesApi constructor.
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param int $limit
     * @param int $page
     * @param string $order
     * @return array
     */

    public function list(int $limit = 5, int $page = 10, $order = 'dsec'): array
    {
//        $uri = sprintf(
//            'https://api.thecatapi.com/v1/categories?limit%d&page=%d&order=%s',
//            $limit, $page, $order
//        );
        $uri = 'https://api.thecatapi.com/v1/categories';
        return  (new ListResultBuilder($this->client->get($uri)))->build();
    }
}
<?php


namespace src\Decorator;


use src\Clients\HttpClientInterface;

class MiddleDecorator  implements HttpClientInterface
{
    private HttpClientInterface $client;
    private LogDecorator $log;
    private CacheDecorator $cache;

    /**
     * MiddleDecorator constructor.
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->log = new LogDecorator();
        $this->cache = CacheDecorator::getInstance();
    }

    public function get(string $uri): ?array
    {
        $this->log->save('REQUEST', $uri);

        if ($response = $this->cache->get($uri)) {
            $this->log->save('CACHE', $uri, $response);
        } else {
            $response = $this->client->get($uri);
            $this->cache->set($uri, $response);
            $this->log->save('RESPONSE', $uri, $response);
        }
        return $response;
    }

    /**
     * @inheritDoc
     */
    public function post(string $uri, array $data = []): ?array
    {
        return $this->client->post($uri, $data);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $uri): ?array
    {
        return $this->client->post($uri);
    }

}
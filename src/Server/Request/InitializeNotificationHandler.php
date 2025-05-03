<?php

namespace OPGG\LaravelMcpServer\Server\Request;

use OPGG\LaravelMcpServer\Data\Requests\InitializeData;
use OPGG\LaravelMcpServer\Exceptions\JsonRpcErrorException;
use OPGG\LaravelMcpServer\Protocol\Handlers\NotificationHandler;
use OPGG\LaravelMcpServer\Server\MCPServer;

class InitializeNotificationHandler implements NotificationHandler
{
    private MCPServer $server;

    public function __construct(MCPServer $server)
    {
        $this->server = $server;
    }

    public function isHandle(string $method): bool
    {
        return $method === 'initialize' || $method === 'notifications/initialized';
    }

    /**
     * @throws JsonRpcErrorException
     */
    public function execute(array $params = null): array
    {
        $data = InitializeData::fromArray(data: $params);
        $result = $this->server->initialize(data: $data);

        return $result->toArray();
    }
}

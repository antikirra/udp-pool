<?php

declare(strict_types=1);

namespace Antikirra\UdpPool;

class UdpClientPool
{
    private array $clients = [];

    public function add(string $name, string $serverAddress, int $serverPort): void
    {
        if ($this->clients[$name] ?? false) {
            return;
        }

        $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

        if ($socket === false) {
            return;
        }

        $this->clients[$name] = [
            'socket' => $socket,
            'address' => $serverAddress,
            'port' => $serverPort,
        ];
    }

    public function send(string $name, string $message): void
    {
        if (!($this->clients[$name] ?? false)) {
            return;
        }

        $client = $this->clients[$name];
        socket_sendto($client['socket'], $message, strlen($message), 0, $client['address'], $client['port']);
    }

    public function remove(string $name): void
    {
        if (!($this->clients[$name] ?? false)) {
            return;
        }

        socket_close($this->clients[$name]['socket']);
        unset($this->clients[$name]);
    }

    public function __destruct()
    {
        if (empty($this->clients)) {
            return;
        }

        foreach ($this->clients as $name => $_) {
            $this->remove($name);
        }
    }
}

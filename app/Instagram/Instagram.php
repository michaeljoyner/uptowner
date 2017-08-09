<?php

namespace App\Instagram;


class Instagram
{
    protected $client;

    public function __construct(InstagramClient $client)
    {
        $this->client = $client;
    }

    public function recent()
    {
        return $this->client->fetch();
    }
}
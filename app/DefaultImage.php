<?php


namespace App;


class DefaultImage
{
    private $default_url;

    public function __construct($default_url = '/images/defaults/default.jpg')
    {
        $this->default_url = $default_url;
    }

    public function getUrl()
    {
        return $this->default_url;
    }

    public function __get($arg)
    {
        return null;
    }
}
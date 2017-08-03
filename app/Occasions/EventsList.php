<?php


namespace App\Occasions;


class EventsList
{
    public $featured;
    private $all;

    public function __construct($featured, $all)
    {
        $this->featured = $featured;
        $this->all = $all;
    }

    public function comingSoon()
    {
        return $this->all->take(3);
    }

    public function restOfEvents()
    {
        return $this->all->slice(3);
    }
}
<?php


namespace App;


trait HasPublishedScope
{
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
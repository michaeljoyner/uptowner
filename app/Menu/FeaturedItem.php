<?php

namespace App\Menu;

use Illuminate\Database\Eloquent\Model;

class FeaturedItem extends Model
{
    protected $table = 'featured_items';

    protected $fillable = ['menu_item_id'];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    public static function currentlyFeatured($amount = 4)
    {
        return static::latest()->get()->map->item()->filter(function($item) {
            return $item->published;
        })->take($amount);
    }

    public function item()
    {
        return $this->menuItem;
    }
}

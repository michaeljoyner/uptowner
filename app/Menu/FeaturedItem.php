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
}

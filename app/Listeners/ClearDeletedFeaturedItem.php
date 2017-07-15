<?php

namespace App\Listeners;

use App\Events\DeletingMenuItem;
use App\Menu\FeaturedItem;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClearDeletedFeaturedItem
{

    public function handle(DeletingMenuItem $event)
    {
        FeaturedItem::where('menu_item_id', $event->item->id)->firstOrNew([])->delete();
    }
}

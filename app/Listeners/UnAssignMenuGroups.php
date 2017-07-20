<?php

namespace App\Listeners;

use App\Events\DeletingMenuPage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UnAssignMenuGroups
{

    public function handle(DeletingMenuPage $event)
    {
        $event->page->releaseGroups();
    }
}

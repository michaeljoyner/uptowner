<?php

namespace App\Listeners;

use App\Events\DeletingMenuGroup;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GuardAgainstDeletingNonEmptyMenuGroup
{



    public function handle(DeletingMenuGroup $event)
    {
        if($event->group->items->count() > 0) {
            throw new \Exception('Cannot delete non empty menu group');
        }
    }
}

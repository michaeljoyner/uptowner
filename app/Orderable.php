<?php


namespace App;


trait Orderable
{
    //order must be an array where the index maps to position (zero-based)
    //and the value maps to model id
    public static function setOrder($order)
    {
        collect($order)->each(function($page_id, $position) {
            static::findOrFail($page_id)->update(['position' => $position]);
        });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('position')->get()->each(function($item) {
            if(is_null($item->position)) {
                $item->position = 9999999;
            }
        })->sortBy('position')->each(function($item) {
            if($item->position === 9999999) {
                $item->position = null;
            }
        })->values();
    }

    public function toOrderedListArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'position' => $this->position ?? 9999,
            'child' => $this->childList()
        ];
    }
}
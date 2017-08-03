<?php

namespace App\Menu;

use App\Events\DeletingMenuGroup;
use App\HandlesTranslations;
use App\GroupedTranslationAttributes;
use App\HasPublishedScope;
use App\Orderable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MenuGroup extends Model
{
    use HasTranslations, HandlesTranslations, HasPublishedScope, Orderable;

    protected $table = 'menu_groups';

    protected $fillable = ['name', 'description', 'published', 'position'];

    public $translatable = ['name', 'description'];

    protected $casts = ['published' => 'boolean'];

    public $events = [
        'deleting' => DeletingMenuGroup::class
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function publishedItems()
    {
        return $this->hasMany(MenuItem::class)->published();
    }

    public function addItem($attributes)
    {
        return tap($this->items()->create([]), function($item) use ($attributes) {
            $item->updateWithTranslations($attributes);
        });
    }

    public function page()
    {
        return $this->belongsTo(MenuPage::class, 'menu_page_id');
    }

    public function detachFromPage()
    {
        $this->menu_page_id = null;
        $this->position = null;
        return $this->save();
    }

    public function canBeDeleted()
    {
        return ! $this->items->count() > 0;
    }

    protected function childList()
    {
        return ['page' => $this->page->id, 'group' => $this->id];
    }

}

<?php

namespace App\Menu;

use App\Events\DeletingMenuPage;
use App\HandlesTranslations;
use App\HasPublishedScope;
use App\Orderable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MenuPage extends Model
{
    use HasTranslations, HandlesTranslations, HasPublishedScope, Orderable;

    protected $table = 'menu_pages';

    protected $fillable = ['name', 'published', 'position'];

    public $translatable = ['name'];

    protected $casts = ['published' => 'boolean'];

    public $events = [
        'deleting' => DeletingMenuPage::class
    ];



    public function groups()
    {
        return $this->hasMany(MenuGroup::class);
    }

    public function publishedGroups()
    {
        return $this->hasMany(MenuGroup::class)->published();
    }

    public function publishedItemImages()
    {
        return $this->publishedGroups->flatMap(function($group) {
            return $group->publishedItems;
        })->filter(function($item) {
            return $item->hasOwnImage();
        })->map(function($item) {
            return ['src' => $item->imageUrl('thumb'), 'alt' => $item->name];
        });
    }

    public function addGroup($group_id)
    {
        return $this->groups()->save(MenuGroup::findOrFail($group_id));
    }

    public function releaseGroups()
    {
        $this->groups->each->detachFromPage();
    }

    public function releaseGroup(MenuGroup $group)
    {
        $group->detachFromPage();
    }

    protected function childList()
    {
        return ['page' => $this->id, 'group' => null];
    }

    public function toJsonableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->getTranslation('name', 'en'),
            'zh_name' => $this->getTranslation('name', 'zh'),
            'group_names' => $this->groups->map->getTranslation('name', 'en')->all()
        ];
    }
}

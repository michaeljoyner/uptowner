<?php

namespace App\Menu;

use App\Events\DeletingMenuPage;
use App\HandlesTranslations;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MenuPage extends Model
{
    use HasTranslations, HandlesTranslations;

    protected $table = 'menu_pages';

    protected $fillable = ['name', 'published'];

    public $translatable = ['name'];

    protected $casts = ['published' => 'boolean'];

    public $events = [
        'deleting' => DeletingMenuPage::class
    ];

    public function groups()
    {
        return $this->hasMany(MenuGroup::class);
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
}

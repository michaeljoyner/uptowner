<?php

namespace App\Menu;

use App\HandlesTranslations;
use App\GroupedTranslationAttributes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MenuGroup extends Model
{
    use HasTranslations, HandlesTranslations;

    protected $table = 'menu_groups';

    protected $fillable = ['name', 'description'];

    public $translatable = ['name', 'description'];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
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
        return $this->save();
    }


}

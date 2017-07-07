<?php

namespace App\Menu;

use App\DefaultImage;
use App\HandlesTranslations;
use App\HasModelImage;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model implements HasMediaConversions
{
    use HasTranslations, HandlesTranslations, HasMediaTrait, HasModelImage;

    const DEFAULT_IMG_URL = '/images/defaults/menuitem.jpg';

    protected $table = 'menu_items';

    protected $casts = [
        'is_spicy' => 'boolean',
        'is_vegetarian' => 'boolean',
        'is_recommended' => 'boolean',
        'published' => 'boolean'
    ];

    protected $fillable = [
        'name',
        'description',
        'price',
        'is_vegetarian',
        'is_spicy',
        'is_recommended',
        'published'
    ];

    public $translatable = ['name', 'description'];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 400, 'h' => 300, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 800, 'h' => 600, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
    }

    public function presentAttributes()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'zh_name' => $this->getTranslation('name', 'zh'),
            'description' => $this->description,
            'zh_description' => $this->getTranslation('description', 'zh'),
            'price' => $this->price,
            'is_spicy' => $this->is_spicy,
            'is_vegetarian' => $this->is_vegetarian,
            'is_recommended' => $this->is_recommended,
            'published' => $this->published,
            'image' => $this->imageUrl('thumb')
        ];
    }

    public function featureParent()
    {
        return $this->hasOne(FeaturedItem::class, 'menu_item_id');
    }

    public function feature()
    {
        return $this->featureParent()->create([]);
    }

    public function demote()
    {
        return $this->featureParent->delete();
    }

    public function isFeatured()
    {
        return !! $this->featureParent;
    }


}

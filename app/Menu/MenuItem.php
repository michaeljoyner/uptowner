<?php

namespace App\Menu;

use App\DefaultImage;
use App\Events\DeletingMenuItem;
use App\HandlesTranslations;
use App\HasModelImage;
use App\HasPublishedScope;
use App\Orderable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model implements HasMedia
{
    use HasTranslations, HandlesTranslations, HasMediaTrait, HasModelImage, HasPublishedScope, Orderable;

    const DEFAULT_IMG_URL = '/images/defaults/default4x3.jpg';

    protected $table = 'menu_items';

    protected $casts = [
        'is_spicy'       => 'boolean',
        'is_vegetarian'  => 'boolean',
        'is_recommended' => 'boolean',
        'published'      => 'boolean'
    ];

    protected $fillable = [
        'name',
        'description',
        'price',
        'is_vegetarian',
        'is_spicy',
        'is_recommended',
        'published',
        'position'
    ];

    public $dispatchesEvents = [
        'deleting' => DeletingMenuItem::class
    ];

    public $translatable = ['name', 'description'];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 400, 300)
            ->keepOriginalImageFormat()
            ->optimize();

        $this->addMediaConversion('web')
            ->fit(Manipulations::FIT_CROP, 800, 600)
            ->keepOriginalImageFormat()
            ->optimize();

    }

    public function menuGroup()
    {
        return $this->belongsTo(MenuGroup::class, 'menu_group_id');
    }

    public function presentAttributes()
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'zh_name'        => $this->getTranslation('name', 'zh'),
            'description'    => $this->description,
            'zh_description' => $this->getTranslation('description', 'zh'),
            'price'          => $this->price,
            'is_spicy'       => $this->is_spicy,
            'is_vegetarian'  => $this->is_vegetarian,
            'is_recommended' => $this->is_recommended,
            'published'      => $this->published,
            'image'          => $this->imageUrl('thumb'),
            'image_id'       => $this->getImage()->id
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
        return !!$this->featureParent;
    }

    protected function childList()
    {
        return null;
    }


}

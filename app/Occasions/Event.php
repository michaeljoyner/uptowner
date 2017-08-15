<?php

namespace App\Occasions;

use App\HandlesTranslations;
use App\HasModelImage;
use App\HasPublishedScope;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\Translatable\HasTranslations;

class Event extends Model implements HasMediaConversions
{
    use HasTranslations, HandlesTranslations, HasModelImage, HasMediaTrait, HasPublishedScope, Sluggable;

    const DEFAULT_IMG_URL = '/images/defaults/default4x3.png';

    protected $table = 'events';

    protected $fillable = [
        'event_date',
        'time_of_day',
        'name',
        'description',
        'published',
        'featured',
        'long_description'
    ];

    protected $dates = ['event_date'];

    protected $casts = ['published' => 'boolean', 'featured' => 'boolean'];

    public $translatable = ['time_of_day', 'name', 'description', 'long_description'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 400, 'h' => 300, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 1500, 'h' => 500, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
    }

    public function scopeUpcoming($query)
    {
        return $query->orderBy('event_date')->where('event_date', '>=', Carbon::today());
    }

    public static function setFeatured(Event $event)
    {
        static::where('featured', 1)->get()->each(function ($ev) {
            $ev->update(['featured' => false]);
        });
        $event->update(['featured' => true]);
    }

    public static function featured()
    {
        $featured = static::published()->upcoming()->where('featured', 1)->first();

        if (!$featured) {
            $next_best = static::published()->upcoming()->get()->filter->hasOwnImage()->first();
        }

        return $featured ?: $next_best;
    }

    public static function upcomingList()
    {
        return new EventsList(static::featured(), static::published()->upcoming()->get());
    }

    public function toJsonableArray()
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'zh_name'        => $this->getTranslation('name', 'zh'),
            'description'    => $this->description,
            'zh_description' => $this->getTranslation('description', 'zh'),
            'long_description' => $this->long_description,
            'zh_long_description' => $this->getTranslation('long_description', 'zh'),
            'time_of_day'    => $this->time_of_day,
            'zh_time_of_day' => $this->getTranslation('time_of_day', 'zh'),
            'event_date'     => $this->event_date->format('Y-m-d'),
            'published'      => $this->published,
            'image'          => $this->imageUrl('thumb'),
            'image_id'       => $this->getImage()->id,
            'featured'       => $this->featured
        ];
    }
}

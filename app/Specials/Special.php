<?php

namespace App\Specials;

use App\HandlesTranslations;
use App\HasModelImage;
use App\HasPublishedScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Special extends Model implements HasMedia
{
    use HasTranslations, HandlesTranslations, InteractsWithMedia, HasModelImage, HasPublishedScope;

    const DEFAULT_IMG_URL = '/images/defaults/default2x1.jpg';

    protected $table = 'specials';

    protected $fillable = ['title', 'description', 'price', 'start_date', 'end_date', 'published'];

    public $translatable = ['title', 'description'];

    protected $dates = ['start_date', 'end_date'];

    protected $casts = ['published' => 'boolean'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
             ->fit(Manipulations::FIT_CROP, 400, 300)
             ->keepOriginalImageFormat()
             ->optimize();

        $this->addMediaConversion('web')
             ->fit(Manipulations::FIT_CROP, 800, 400)
             ->keepOriginalImageFormat()
             ->optimize();
    }

    public static function current()
    {
        return static::published()->orderBy('start_date')->get()->reject->isExpired();
    }

    public function isExpired()
    {
        return $this->end_date !== null && $this->end_date->lt(Carbon::today());
    }

    public function timeWindow()
    {
        $start = $this->start_date ? $this->start_date->format('jS M, Y') : null;
        $end = $this->end_date ? $this->end_date->format('jS M, Y') : null;
        $has_begun = is_null($this->start_date) || $this->start_date->lte(Carbon::today());

        if ($this->isExpired() || (!$this->published)) {
            return 'Sorry, this special is not currently valid';
        }

        if ($has_begun && is_null($end)) {
            return null;
        }

        if (!$has_begun) {
            $time_frame = 'Available from ' . $start;

            if ($end) {
                $time_frame .= ' until ' . $end;
            }

            return $time_frame;
        }

        return 'Available until ' . $end;
    }

    public function toJsonableArray()
    {
        return [
            'id'             => $this->id,
            'image'          => $this->imageUrl('web'),
            'title'          => $this->title,
            'zh_title'       => $this->getTranslation('title', 'zh'),
            'description'    => $this->description,
            'zh_description' => $this->getTranslation('description', 'zh'),
            'price'          => $this->price,
            'start_date'     => $this->start_date ? $this->start_date->format('Y-m-d') : null,
            'end_date'       => $this->end_date ? $this->end_date->format('Y-m-d') : null,
            'published'      => $this->published
        ];
    }
}

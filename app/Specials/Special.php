<?php

namespace App\Specials;

use App\HandlesTranslations;
use App\HasModelImage;
use App\HasPublishedScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\Translatable\HasTranslations;

class Special extends Model implements HasMediaConversions
{
    use HasTranslations, HandlesTranslations, HasMediaTrait, HasModelImage, HasPublishedScope;

    const DEFAULT_IMG_URL = '/images/defaults/default.jpg';

    protected $table = 'specials';

    protected $fillable = ['title', 'description', 'price', 'start_date', 'end_date', 'published'];

    public $translatable = ['title', 'description'];

    protected $dates = ['start_date', 'end_date'];

    protected $casts = ['published' => 'boolean'];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 400, 'h' => 300, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 800, 'h' => 400, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
    }

    public static function current()
    {
        return static::published()->orderBy('start_date')->get()->reject->isExpired();
    }

    public function isExpired()
    {
        return $this->end_date->lt(Carbon::today());
    }

    public function timeWindow()
    {
        if($this->start_date->gt(Carbon::today())) {
            return 'Available from ' . $this->start_date->format('jS M, Y') . ' until ' . $this->end_date->format('jS M, Y');
        }

        return 'Available until ' . $this->end_date->format('jS M, Y');
    }
}

<?php

namespace App\Specials;

use App\HandlesTranslations;
use App\HasModelImage;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\Translatable\HasTranslations;

class Special extends Model implements HasMediaConversions
{
    use HasTranslations, HandlesTranslations, HasMediaTrait, HasModelImage;

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
}

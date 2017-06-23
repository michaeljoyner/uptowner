<?php

namespace App\Occasions;

use App\HandlesTranslations;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Event extends Model
{
    use HasTranslations, HandlesTranslations;

    protected $table = 'events';

    protected $fillable = ['event_date', 'time_of_day', 'name', 'description', 'published'];

    protected $dates = ['event_date'];

    protected $casts = ['published' => 'boolean'];

    public $translatable = ['time_of_day', 'name', 'description'];



}

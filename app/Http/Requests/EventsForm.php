<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventsForm extends FormRequest
{
    protected $acceptedFields = [
        'event_date',
        'time_of_day',
        'zh_time_of_day',
        'name',
        'zh_name',
        'description',
        'zh_description',
        'long_description',
        'zh_long_description'
    ];

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'event_date' => 'required|date|after_or_equal:today',
            'name' => 'required_without:zh_name',
            'zh_name' => 'required_without:name'
        ];
    }

    public function sanitizedData()
    {
        return collect($this->only($this->acceptedFields))->flatMap(function($value, $key) {
            if(str_contains($key, '_date')) {
                return [$key => $this->trimDateString($value)];
            }
            if(str_contains($key, 'time_of_day')) {
                return [$key => $value ?? ''];
            }
            return [$key => $value];
        })->all();
    }

    protected function trimDateString($date_string)
    {
        if(strlen($date_string) > 10) {
            return substr($date_string, 0, 10);
        }

        return $date_string;
    }
}

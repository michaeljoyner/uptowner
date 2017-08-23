<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialsForm extends FormRequest
{
    protected $acceptedFields = [
        'title',
        'zh_title',
        'description',
        'zh_description',
        'price',
        'start_date',
        'end_date',
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
            'title' => 'required_without:zh_title',
            'zh_title' => 'required_without:title',
        ];
    }

    public function sanitizedData()
    {
        return collect($this->intersect($this->acceptedFields))->flatMap(function($value, $key) {
            if(str_contains($key, '_date')) {
                return [$key => $this->trimDateString($value)];
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

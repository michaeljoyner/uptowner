<?php


namespace App;


class GroupedTranslationAttributes
{
    public static function from($attributes)
    {
        return collect(static::groupedTranslations($attributes))
            ->reject(function ($value, $field) {
                return starts_with($field, 'zh_');
            })->toArray();
    }

    private static function groupedTranslations($attributes)
    {
        return array_merge($attributes, static::getTranslations($attributes));
    }

    protected static function getTranslations($data)
    {
        return collect($data)->filter(function ($value, $field) use ($data) {
            return starts_with($field, 'zh_');
        })->flatMap(function ($value, $field) use ($data) {
            $name = mb_substr($field, 3);

            return [$name => ['en' => $data[$name], 'zh' => $value]];
        })->toArray();
    }
}
<?php


namespace App;


trait HandlesTranslations
{

    public static function createWithTranslations($attributes)
    {
        collect((new static)->translatable)->each(function ($field) use (&$attributes) {
            static::insertMissingTranslations($attributes, $field, '', '');
        });

        return static::create(GroupedTranslationAttributes::from($attributes));
    }

    public function updateWithTranslations($attributes)
    {
        collect($this->translatable)->each(function ($field) use (&$attributes) {
            static::insertMissingTranslations(
                $attributes,
                $field,
                $this->getTranslation($field, 'en'),
                $this->getTranslation($field, 'zh')
            );
        });
        return $this->update(GroupedTranslationAttributes::from($attributes));
    }

    private static function insertMissingTranslations(&$attributes, $field, $value, $value_zh)
    {
        if (!array_key_exists($field, $attributes) && array_key_exists('zh_' . $field, $attributes)) {
            $attributes[$field] = $value;
        }
        if (!array_key_exists('zh_' . $field, $attributes) && array_key_exists($field, $attributes)) {
            $attributes['zh_' . $field] = $value_zh;
        }
    }
}
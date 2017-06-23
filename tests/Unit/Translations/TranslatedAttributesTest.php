<?php


namespace Tests\Unit\Translations;


use App\GroupedTranslationAttributes;
use Tests\TestCase;

class TranslatedAttributesTest extends TestCase
{
    /**
     *@test
     */
    public function it_can_group_the_translation_attributes_correctly()
    {
        $raw = [
            'non_translatable' => 7,
            'name' => 'English name',
            'zh_name' => '満版復',
            'description' => 'An english description',
            'zh_description' => '永門義会可際査別件村約候証民'
        ];

        $expected = [
            'non_translatable' => 7,
            'name' => ['en' => 'English name', 'zh' => '満版復'],
            'description' => ['en' => 'An english description', 'zh' => '永門義会可際査別件村約候証民']
        ];

        $this->assertEquals($expected, GroupedTranslationAttributes::from($raw));
    }
}
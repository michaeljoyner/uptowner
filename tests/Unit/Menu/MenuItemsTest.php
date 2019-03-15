<?php


namespace Tests\Unit\Menu;


use App\Menu\MenuItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuItemsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_menu_item_can_be_created_with_its_translations()
    {
        $data = [
            'name' => 'Eggs Benedict',
            'zh_name' => '満版復',
            'description' => 'Eggs, bacon, scones, a sauce',
            'zh_description' => '永門義会可際査別件村約候証民',
            'price' => 99,
            'is_spicy' => false,
            'is_vegetarian' => true,
            'is_recommended' => true
        ];

        $item = MenuItem::createWithTranslations($data);

        $this->assertInstanceOf(MenuItem::class, $item);
        $this->assertEquals('Eggs Benedict', $item->name);
        $this->assertEquals('満版復', $item->getTranslation('name', 'zh'));
        $this->assertEquals('Eggs, bacon, scones, a sauce', $item->description);
        $this->assertEquals('永門義会可際査別件村約候証民', $item->getTranslation('description', 'zh'));
        $this->assertEquals(99, $item->price);
        $this->assertFalse($item->is_spicy);
        $this->assertTrue($item->is_vegetarian);
        $this->assertTrue($item->is_recommended);
    }

    /**
     *@test
     */
    public function create_with_translations_will_add_empty_string_for_missing_translations()
    {
        $data = [
            'name' => 'Eggs Benedict',
            'zh_description' => '永門義会可際査別件村約候証民',
            'price' => 99,
            'is_spicy' => false,
            'is_vegetarian' => true,
            'is_recommended' => true
        ];

        $item = MenuItem::createWithTranslations($data)->fresh();
        $this->assertInstanceOf(MenuItem::class, $item);
        $this->assertEquals('Eggs Benedict', $item->name);
        $this->assertEquals('', $item->description);
        $this->assertEquals('Eggs Benedict', $item->getTranslation('name', 'zh'));
        $this->assertEquals('', $item->description);
        $this->assertEquals('永門義会可際査別件村約候証民', $item->getTranslation('description', 'zh'));
        $this->assertEquals(99, $item->price);
        $this->assertFalse($item->is_spicy);
        $this->assertTrue($item->is_vegetarian);
        $this->assertTrue($item->is_recommended);
    }

    /**
     *@test
     */
    public function update_with_translations_will_not_overwrite_missing_translations()
    {
        $item = factory(MenuItem::class)->create();
        $original_zh_name = $item->getTranslation('name', 'zh');
        $original_zh_description = $item->getTranslation('description', 'zh');

        $update_data = ['name' => 'eggs', 'description' => 'breakfast food'];

        $item->updateWithTranslations($update_data);

        $this->assertEquals($original_zh_name, $item->fresh()->getTranslation('name', 'zh'));
        $this->assertEquals($original_zh_description, $item->fresh()->getTranslation('description', 'zh'));
    }

    /**
     *@test
     */
    public function a_menu_item_can_present_its_attributes()
    {
        $menu_item = factory(MenuItem::class)->create([
            'name' => ['en' => 'TEST NAME', 'zh' => 'TEST ZH NAME'],
            'description' => ['en' => 'TEST DESCRIPTION', 'zh' => 'TEST ZH DESCRIPTION'],
            'price' => 99,
            'is_spicy' => false,
            'is_vegetarian' => true,
            'is_recommended' => true,
            'published' => false,
        ]);

        $expected_attributes = [
            'id' => $menu_item->id,
            'name' => 'TEST NAME',
            'zh_name' => 'TEST ZH NAME',
            'description' => 'TEST DESCRIPTION',
            'zh_description' => 'TEST ZH DESCRIPTION',
            'price' => 99,
            'is_spicy' => false,
            'is_vegetarian' => true,
            'is_recommended' => true,
            'published' => false,
            'image' => MenuItem::DEFAULT_IMG_URL,
            'image_id' => null
        ];

        $this->assertEquals($expected_attributes, $menu_item->presentAttributes());
    }
    

}
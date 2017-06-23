<?php

namespace Tests\Unit\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuGroupsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_menu_item_may_be_created_through_a_menu_group()
    {
        $group = factory(MenuGroup::class)->create();
        $menu_item = [
            'name' => 'Eggs Benedict',
            'zh_name' => '満版復',
            'description' => 'Eggs, bacon, scones, a sauce',
            'zh_description' => '永門義会可際査別件村約候証民',
            'price' => 99,
            'is_spicy' => false,
            'is_vegetarian' => true,
            'is_recommended' => true
        ];

        $item = $group->addItem($menu_item);

        $this->assertInstanceOf(MenuItem::class, $item);
        $this->assertEquals($group->id, $item->menu_group_id);
        $this->assertEquals('Eggs Benedict', $item->name);
        $this->assertEquals('満版復', $item->getTranslation('name', 'zh'));
        $this->assertEquals('Eggs, bacon, scones, a sauce', $item->description);
        $this->assertEquals('永門義会可際査別件村約候証民', $item->getTranslation('description', 'zh'));
        $this->assertEquals(99, $item->price);
        $this->assertFalse($item->is_spicy);
        $this->assertTrue($item->is_vegetarian);
        $this->assertTrue($item->is_recommended);
    }
}
<?php

namespace Tests\Unit\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use App\Menu\MenuPage;
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

    /**
     *@test
     */
    public function a_menu_group_can_detach_from_its_page()
    {
        $page = factory(MenuPage::class)->create();
        $group = factory(MenuGroup::class)->create(['menu_page_id' => $page->id]);

        $group->detachFromPage();

        $this->assertNull($group->fresh()->menu_page_id);
    }

    /**
     *@test
     */
    public function a_menu_group_has_a_published_scope()
    {
        factory(MenuGroup::class, 4)->create(['published' => true]);
        factory(MenuGroup::class, 2)->create(['published' => false]);

        $this->assertCount(4, MenuGroup::published()->get());
    }

    /**
     *@test
     */
    public function it_has_a_scoped_relationship_for_published_items()
    {
        $group = factory(MenuGroup::class)->create();
        factory(MenuItem::class, 3)->create(['published' => true, 'menu_group_id' => $group->id]);
        factory(MenuItem::class, 1)->create(['published' => false, 'menu_group_id' => $group->id]);

        $this->assertCount(3, $group->publishedItems);
    }

    /**
     *@test
     */
    public function a_menu_group_with_at_least_one_item_attached_can_not_be_deleted()
    {
        $group = factory(MenuGroup::class)->create();
        factory(MenuItem::class, 1)->create(['menu_group_id' => $group->id]);

        try {
            $group->delete();
            $this->fail('Expecting Exception to be thrown');
        } catch(\Exception $e) {
            $this->assertEquals('Cannot delete non empty menu group', $e->getMessage());
        }

        $this->assertNotNull(MenuGroup::find($group->id));
    }

    /**
     *@test
     */
    public function a_menu_group_knows_if_it_can_be_deleted()
    {
        $group = factory(MenuGroup::class)->create();
        $item = factory(MenuItem::class)->create(['menu_group_id' => $group->id]);

        $this->assertFalse($group->canBeDeleted());

        $item->delete();
        $this->assertCount(0, $group->fresh()->items);
        $this->assertTrue($group->fresh()->canBeDeleted());
    }
}
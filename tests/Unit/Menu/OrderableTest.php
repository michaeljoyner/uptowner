<?php


namespace Tests\Unit\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use App\Menu\MenuPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class OrderableTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_orderable_model_like_a_menu_page_can_be_queried_as_ordered()
    {
        $pageA = factory(MenuPage::class)->create(['position' => 2]);
        $pageB = factory(MenuPage::class)->create(['position' => 0]);
        $pageC = factory(MenuPage::class)->create(['position' => 1]);

        $ordered_pages = MenuPage::ordered();

        $this->assertEquals($pageB->id, $ordered_pages->first()->id);
        $this->assertEquals($pageA->id, $ordered_pages->last()->id);
        $this->assertEquals($pageC->id, $ordered_pages[1]->id);
    }

    /**
     * @test
     */
    public function a_null_position_is_ordered_after_any_numbered_position()
    {
        $pageA = factory(MenuPage::class)->create(['position' => 2]);
        $pageB = factory(MenuPage::class)->create(['position' => null]);
        $pageC = factory(MenuPage::class)->create(['position' => 10]);

        $ordered_pages = MenuPage::ordered();

        $this->assertEquals($pageA->id, $ordered_pages->first()->id);
        $this->assertEquals($pageB->id, $ordered_pages->last()->id);
        $this->assertEquals($pageC->id, $ordered_pages[1]->id);
    }

    /**
     * @test
     */
    public function an_orderable_item_can_be_represented_as_an_ordered_list_array()
    {
        $item = factory(MenuItem::class)->create(['position' => 3]);
        $group = factory(MenuGroup::class)->create(['position' => 5]);
        $page = factory(MenuPage::class)->create(['position' => 4]);

        $expected_item_array = [
            'id'       => $item->id,
            'name'     => $item->name,
            'position' => 3,
            'child'    => null
        ];

        $expected_group_array = [
            'id'       => $group->id,
            'name'     => $group->name,
            'position' => 5,
            'child'    => ['page' => $group->page->id, 'group' => $group->id]
        ];

        $expected_page_array = [
            'id'       => $page->id,
            'name'     => $page->name,
            'position' => 4,
            'child'    => ['page' => $page->id, 'group' => null]
        ];

        $this->assertEquals($expected_item_array, $item->toOrderedListArray());
        $this->assertEquals($expected_group_array, $group->toOrderedListArray());
        $this->assertEquals($expected_page_array, $page->toOrderedListArray());
    }
}
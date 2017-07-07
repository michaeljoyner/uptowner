<?php


namespace Tests\Unit\Menu;


use App\Menu\FeaturedItem;
use App\Menu\MenuItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FeaturedMenuItemsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_menu_item_can_be_featured()
    {
        $menu_item = factory(MenuItem::class)->create();

        $menu_item->feature();

        $this->assertContains($menu_item->id, FeaturedItem::all()->pluck('menu_item_id')->toArray());
    }

    /**
     *@test
     */
    public function a_menu_item_knows_it_is_featured()
    {
        $menu_item = factory(MenuItem::class)->create();
        $menu_item->feature();

        $this->assertTrue($menu_item->fresh()->isFeatured());
    }

    /**
     *@test
     */
    public function a_non_featured_item_is_not_featured()
    {
        $menu_item = factory(MenuItem::class)->create();

        $this->assertFalse($menu_item->fresh()->isFeatured());
    }

    /**
     *@test
     */
    public function a_menu_item_can_be_demoted_from_featured_status()
    {
        $menu_item = factory(MenuItem::class)->create();
        $menu_item->feature();

        $menu_item->demote();

        $this->assertFalse($menu_item->fresh()->isFeatured());
    }
}
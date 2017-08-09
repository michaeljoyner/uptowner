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

    /**
     *@test
     */
    public function published_featured_items_can_be_listed_as_menu_items()
    {
        $items = factory(MenuItem::class, 5)->create(['published' => true]);
        $items->each->feature();

        $favourites = FeaturedItem::currentlyFeatured();

        $favourites->each(function($item) {
            $this->assertInstanceOf(MenuItem::class, $item);
            $this->assertTrue($item->isFeatured());
            $this->assertTrue($item->published);
        });
    }

    /**
     *@test
     */
    public function unpublished_items_are_not_included_in_the_currently_featured_items()
    {
        $items = factory(MenuItem::class, 5)->create(['published' => false]);
        $items->each->feature();

        $favourites = FeaturedItem::currentlyFeatured();

        $this->assertCount(0, $favourites);
    }

    /**
     *@test
     */
    public function a_maximum_of_four_items_are_returned_by_currently_featured_by_default()
    {
        $items = factory(MenuItem::class, 5)->create(['published' => true]);
        $items->each->feature();

        $favourites = FeaturedItem::currentlyFeatured();

        $this->assertCount(4, $favourites);
        $favourites->each(function($item) {
            $this->assertInstanceOf(MenuItem::class, $item);
            $this->assertTrue($item->isFeatured());
            $this->assertTrue($item->published);
        });
    }

    /**
     *@test
     */
    public function an_amount_of_items_to_be_returned_by_currently_featured_can_be_specified()
    {
        $items = factory(MenuItem::class, 10)->create(['published' => true]);
        $items->each->feature();

        $favourites = FeaturedItem::currentlyFeatured(7);

        $this->assertCount(7, $favourites);
        $favourites->each(function($item) {
            $this->assertInstanceOf(MenuItem::class, $item);
            $this->assertTrue($item->isFeatured());
            $this->assertTrue($item->published);
        });
    }
}
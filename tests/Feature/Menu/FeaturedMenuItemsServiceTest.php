<?php


namespace Tests\Feature\Menu;


use App\Menu\FeaturedItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FeaturedMenuItemsServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function all_featured_items_can_be_fetched()
    {
        $this->disableExceptionHandling();
        $featured_items = factory(FeaturedItem::class, 10)->create();

        $response = $this->asLoggedInUser()->json('GET', '/admin/services/menu/featured');
        $response->assertStatus(200);

        $fetched_menu_items = $response->json();

        $this->assertEquals($featured_items->pluck('menu_item_id')->toArray(), collect($fetched_menu_items)->pluck('id')->toArray());
    }

    /**
     *@test
     */
    public function the_fetched_items_have_the_correctly_formatted_attributes()
    {
        $this->disableExceptionHandling();
        factory(FeaturedItem::class, 2)->create();

        $response = $this->asLoggedInUser()->json('GET', '/admin/services/menu/featured');
        $response->assertStatus(200);

        $fetched_menu_items = $response->json();

        $this->assertArrayHasKey('image', $fetched_menu_items[0]);
        $this->assertArrayHasKey('name', $fetched_menu_items[0]);
        $this->assertArrayHasKey('zh_name', $fetched_menu_items[0]);
        $this->assertArrayHasKey('price', $fetched_menu_items[0]);
    }
}
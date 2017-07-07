<?php


namespace Tests\Feature\Menu;


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
        $this->disableExceptionHandling();
        $menu_item = factory(MenuItem::class)->create();

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/featured', ['id' => $menu_item->id]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('featured_items', ['menu_item_id' => $menu_item->id]);
    }

    /**
     *@test
     */
    public function a_menu_item_can_be_de_featured()
    {
        $this->disableExceptionHandling();
        $menu_item = factory(MenuItem::class)->create();
        $menu_item->feature();

        $response = $this->asLoggedInUser()->json('delete', '/admin/menu/featured/' . $menu_item->id);
        $response->assertStatus(200);

        $this->assertDatabaseMissing('featured_items', ['menu_item_id' => $menu_item->id]);
    }
}
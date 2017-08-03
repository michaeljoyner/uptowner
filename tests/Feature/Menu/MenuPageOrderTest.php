<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuPageOrderTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function the_order_of_the_menu_pages_can_be_set()
    {
        $this->disableExceptionHandling();
        $pages = factory(MenuPage::class, 5)->create();
        $new_order = $pages->pluck('id')->shuffle()->values()->all();

        $response = $this->asLoggedInUser()->json('POST', '/admin/services/menu/pages/order', [
            'order' => $new_order
        ]);
        $response->assertStatus(200);

        collect($new_order)->each(function($page_id, $position) {
           $this->assertEquals($position, MenuPage::find($page_id)->position);
        });
    }
}
<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuItemOrderTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function the_menu_items_in_a_menu_group_can_be_ordered()
    {
        $this->disableExceptionHandling();
        $group = factory(MenuGroup::class)->create();
        $items = factory(MenuItem::class, 5)->create(['menu_group_id' => $group->id]);
        $new_order = $items->pluck('id')->shuffle()->values()->all();

        $response = $this->asLoggedInUser()
            ->json('POST', '/admin/services/menu/groups/' . $group->id . '/items/order', [
            'order' => $new_order
        ]);
        $response->assertStatus(200);

        collect($new_order)->each(function($item_id, $position) {
            $this->assertEquals($position, MenuItem::find($item_id)->position);
        });
    }
}
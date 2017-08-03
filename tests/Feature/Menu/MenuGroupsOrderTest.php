<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuGroupsOrderTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function menu_groups_belonging_to_a_page_can_be_ordered()
    {
        $this->disableExceptionHandling();
        $page = factory(MenuPage::class)->create();
        $groups = factory(MenuGroup::class, 5)->create(['menu_page_id' => $page->id]);
        $new_order = $groups->pluck('id')->shuffle()->values()->all();

        $response = $this->asLoggedInUser()
            ->json('POST', '/admin/services/menu/pages/' . $page->id .  '/groups/order', [
            'order' => $new_order
        ]);
        $response->assertStatus(200);

        collect($new_order)->each(function($group_id, $position) {
            $this->assertEquals($position, MenuGroup::find($group_id)->position);
        });
    }
}
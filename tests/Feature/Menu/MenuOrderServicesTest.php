<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use App\Menu\MenuPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\SetsUpOrderedMenu;
use Tests\TestCase;

class MenuOrderServicesTest extends TestCase
{
    use DatabaseMigrations, SetsUpOrderedMenu;

    /**
     *@test
     */
    public function the_menu_order_lists_can_be_fetched()
    {
        $this->disableExceptionHandling();
        $expected_lists = $this->setUpOrderedMenu();

        $response = $this->asLoggedInUser()->json('GET', '/admin/services/menu/order/lists');
        $response->assertStatus(200);

        $this->assertEquals($expected_lists, $response->decodeResponseJson());
    }

    /**
     *@test
     */
    public function all_null_positions_are_converted_to_9999_when_fetched()
    {
        $this->disableExceptionHandling();
        $page = factory(MenuPage::class)->create(['position' => null]);
        $group = factory(MenuGroup::class)->create(['position' => null, 'menu_page_id' => $page->id]);
        $item = factory(MenuItem::class)->create(['position' => null, 'menu_group_id' => $group->id]);

        $expected_lists = [
            [
                'parent' => ['page' => null, 'group' => null],
                'list' => [[
                    'id' => $page->id,
                    'name' => $page->name,
                    'position' => 9999,
                    'child' => ['page' => $page->id, 'group' => null]
                ]]
            ],
            [
                'parent' => ['page' => $page->id, 'group' => null],
                'list' => [[
                    'id' => $group->id,
                    'name' => $group->name,
                    'position' => 9999,
                    'child' => ['page' => $page->id, 'group' => $group->id]
                ]]
            ],
            [
                'parent' => ['page' => $page->id, 'group' => $group->id],
                'list' => [[
                    'id' => $item->id,
                    'name' => $item->name,
                    'position' => 9999,
                    'child' => null
                ]]
            ]
        ];

        $response = $this->asLoggedInUser()->json('GET', '/admin/services/menu/order/lists');
        $response->assertStatus(200);

        $this->assertEquals($expected_lists, $response->decodeResponseJson());
    }
}
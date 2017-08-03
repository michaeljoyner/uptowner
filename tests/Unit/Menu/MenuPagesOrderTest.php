<?php


namespace Tests\Unit\Menu;


use App\Menu\MenuPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuPagesOrderTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function menu_pages_can_be_assigned_a_position()
    {
        $page = factory(MenuPage::class)->create(['position' => 1]);

        $this->assertEquals(1, $page->position);
    }

    /**
     *@test
     */
    public function the_position_of_a_menu_page_can_be_updated()
    {
        $page = factory(MenuPage::class)->create(['position' => 1]);

        $page->update(['position' => 3]);

        $this->assertEquals(3, $page->fresh()->position);
    }

    /**
     *@test
     */
    public function the_order_of_menu_pages_can_be_set_by_passing_ordered_array_of_ids()
    {
        $pages = factory(MenuPage::class, 5)->create();
        $new_order = $pages->pluck('id')->shuffle()->values()->all();

        MenuPage::setOrder($new_order);

        collect($new_order)->each(function($page_id, $position) {
            $this->assertEquals($position, MenuPage::find($page_id)->position);
        });
    }
}
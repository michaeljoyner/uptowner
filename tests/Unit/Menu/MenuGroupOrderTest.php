<?php


namespace Tests\Unit\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuGroupOrderTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_menu_group_loses_its_position_when_it_is_removed_from_a_page()
    {
        $page = factory(MenuPage::class)->create();
        $groupA = factory(MenuGroup::class)->create(['menu_page_id' => $page->id, 'position' => 0]);
        $groupB = factory(MenuGroup::class)->create(['menu_page_id' => $page->id, 'position' => 1]);

        $this->assertNotNull($groupA->position);
        $this->assertNotNull($groupB->position);

        $groupA->detachFromPage();
        $this->assertNull($groupA->fresh()->position);

        $page->releaseGroup($groupB);
        $this->assertNull($groupB->fresh()->position);
    }
}
<?php


namespace Tests\Unit\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuPagesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_menu_page_can_un_assign_all_its_groups()
    {
        $page = factory(MenuPage::class)->create();
        $groups = factory(MenuGroup::class, 3)->create(['menu_page_id' => $page->id]);

        $page->releaseGroups();

        $groups->each(function($group) {
            $this->assertNull($group->fresh()->menu_page_id);
        });
    }

    /**
     *@test
     */
    public function a_menu_page_can_release_a_given_group()
    {
        $page = factory(MenuPage::class)->create();
        $group = factory(MenuGroup::class)->create(['menu_page_id' => $page->id]);

        $page->releaseGroup($group);

        $this->assertNotContains($group->id, $page->fresh()->groups->pluck('id'));
    }

    /**
     *@test
     */
    public function a_menu_page_can_add_a_menu_group_by_id()
    {
        $page = factory(MenuPage::class)->create();
        $group = factory(MenuGroup::class)->create(['menu_page_id' => null]);

        $page->addGroup($group->id);

        $this->assertContains($group->id, $page->fresh()->groups->pluck('id'));
    }
}
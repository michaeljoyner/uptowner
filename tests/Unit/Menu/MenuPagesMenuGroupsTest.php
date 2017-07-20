<?php


namespace Tests\Unit\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuPagesMenuGroupsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_menu_page_can_have_several_menu_groups()
    {
        $page = factory(MenuPage::class)->create();
        $groups = factory(MenuGroup::class, 3)->create(['menu_page_id' => $page->id]);

        $this->assertCount(3, $page->groups);
        $groups->each(function ($group) use ($page) {
            $this->assertContains($group->id, $page->groups->pluck('id'));
        });
    }

    /**
     *@test
     */
    public function a_menu_group_can_belong_to_a_menu_page()
    {
        $page = factory(MenuPage::class)->create();
        $group = factory(MenuGroup::class)->create(['menu_page_id' => $page->id]);

        $this->assertInstanceOf(MenuPage::class, $group->page);
        $this->assertEquals($page->id, $group->page->id);
    }

    /**
     *@test
     */
    public function deleting_a_menu_page_does_not_delete_its_group()
    {
        $page = factory(MenuPage::class)->create();
        $groups = factory(MenuGroup::class, 3)->create(['menu_page_id' => $page->id]);

        $page->delete();

        $groups->each(function($group) {
            $this->assertNotNull($group->fresh());
        });
    }

    /**
     *@test
     */
    public function deleting_a_menu_page_un_assigns_its_groups()
    {
        $page = factory(MenuPage::class)->create();
        $groups = factory(MenuGroup::class, 3)->create(['menu_page_id' => $page->id]);

        $page->delete();

        $groups->each(function($group) {
            $this->assertNull($group->fresh()->menu_page_id);
        });
    }
}
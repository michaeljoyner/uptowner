<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuPagesServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function the_list_of_menu_pages_can_be_fetched_in_the_appropriate_format()
    {
        $this->disableExceptionHandling();
        factory(MenuPage::class, 5)->create();

        $response = $this->asLoggedInUser()->json('GET', '/admin/services/menu/pages');
        $response->assertStatus(200);

        $fetched_pages = $response->decodeResponseJson();

        $this->assertCount(5, $fetched_pages);
        collect($fetched_pages)->each(function($page) {
            $this->assertArrayHasKey('id', $page);
            $this->assertArrayHasKey('name', $page);
            $this->assertArrayHasKey('zh_name', $page);
            $this->assertArrayHasKey('published', $page);
        });
    }

    /**
     *@test
     */
    public function the_menu_page_has_a_list_of_its_group_names()
    {
        $this->disableExceptionHandling();
        $page = factory(MenuPage::class)->create();
        factory(MenuGroup::class)->create([
            'name' => ['en' => 'TEST GROUP A', 'zh' => '満版復'],
            'menu_page_id' => $page->id
        ]);
        factory(MenuGroup::class)->create([
            'name' => ['en' => 'TEST GROUP B', 'zh' => '満版復'],
            'menu_page_id' => $page->id
        ]);

        $response = $this->asLoggedInUser()->json('GET', '/admin/services/menu/pages');
        $response->assertStatus(200);

        $fetched_pages = $response->decodeResponseJson();

        $this->assertCount(1, $fetched_pages);
        collect($fetched_pages)->each(function($page) {
            $this->assertArrayHasKey('id', $page);
            $this->assertArrayHasKey('name', $page);
            $this->assertArrayHasKey('zh_name', $page);
            $this->assertEquals(['TEST GROUP A', 'TEST GROUP B'], $page['group_names']);
        });
    }

    /**
     *@test
     */
    public function a_list_of_a_menu_pages_groups_can_be_fetched_in_the_appropriate_format()
    {
        $this->disableExceptionHandling();
        $page = factory(MenuPage::class)->create();
        $groups = factory(MenuGroup::class, 5)->create(['menu_page_id' => $page->id]);

        $response = $this->asLoggedInUser()->json('GET', '/admin/services/menu/pages/' . $page->id . '/groups');
        $response->assertStatus(200);

        $fetched_groups = $response->decodeResponseJson();

        $this->assertCount(5, $fetched_groups);
        collect($fetched_groups)->each(function($group) {
            $this->assertArrayHasKey('id', $group);
            $this->assertArrayHasKey('name', $group);
            $this->assertArrayHasKey('zh_name', $group);
            $this->assertArrayHasKey('description', $group);
            $this->assertArrayHasKey('zh_description', $group);
            $this->assertArrayHasKey('is_assigned', $group);
            $this->assertArrayHasKey('page_name', $group);
            $this->assertArrayHasKey('page_id', $group);
            $this->assertArrayHasKey('published', $group);
        });
    }
}
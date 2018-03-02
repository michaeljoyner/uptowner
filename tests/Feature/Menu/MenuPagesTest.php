<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuPagesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_menu_page_can_be_created()
    {
        $this->disableExceptionHandling();
        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/pages', [
            'name'    => 'Burgers',
            'zh_name' => '満版復'
        ]);

        $response->assertStatus(201);

        $this->assertTranslatableTableHas('menu_pages', [
            'name'    => 'Burgers',
            'zh_name' => '満版復'
        ]);
    }

    /**
     * @test
     */
    public function a_menu_page_can_be_edited()
    {
        $this->disableExceptionHandling();
        $page = factory(MenuPage::class)->create([
            'name' => ['en' => 'TEST NAME', 'zh' => 'TEST ZH NAME']
        ]);

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/pages/' . $page->id, [
            'name'    => 'Burgers',
            'zh_name' => '満版復'
        ]);

        $response->assertStatus(200);

        $this->assertTranslatableTableHas('menu_pages', [
            'name'    => 'Burgers',
            'zh_name' => '満版復'
        ]);
    }

    /**
     * @test
     */
    public function updating_a_menu_page_returns_the_page_data_in_correctly_formatted_json()
    {
        $this->disableExceptionHandling();
        $page = factory(MenuPage::class)->create([
            'name' => ['en' => 'TEST NAME', 'zh' => 'TEST ZH NAME']
        ]);

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/pages/' . $page->id, [
            'name'    => 'Burgers',
            'zh_name' => '満版復'
        ]);

        $response->assertStatus(200);
        $response_data = $response->decodeResponseJson();

        $this->assertEquals($response_data, $page->fresh()->toJsonableArray());
    }

    /**
     * @test
     */
    public function a_menu_page_can_be_deleted()
    {
        $this->disableExceptionHandling();
        $page = factory(MenuPage::class)->create();

        $response = $this->asLoggedInUser()->json('DELETE', '/admin/menu/pages/' . $page->id);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('menu_pages', [
            'id' => $page->id
        ]);
    }

    /**
     * @test
     */
    public function a_menu_group_can_be_added_to_a_menu_page()
    {
        $this->disableExceptionHandling();
        $page = factory(MenuPage::class)->create();
        $group = factory(MenuGroup::class)->create(['menu_page_id' => null]);

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/pages/' . $page->id . '/groups', [
            'group_id' => $group->id
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('menu_groups', [
            'id'           => $group->id,
            'menu_page_id' => $page->id
        ]);
    }

    /**
     * @test
     */
    public function a_menu_group_can_be_removed_from_a_menu_page()
    {
        $this->disableExceptionHandling();
        $page = factory(MenuPage::class)->create();
        $group = factory(MenuGroup::class)->create(['menu_page_id' => $page->id]);

        $response = $this
            ->asLoggedInUser()
            ->json('DELETE', '/admin/menu/pages/' . $page->id . '/groups/' . $group->id);
        $response->assertStatus(200);

        $this->assertDatabaseHas('menu_groups', [
            'id'           => $group->id,
            'menu_page_id' => null
        ]);
    }
}
<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuGroupsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_menu_group_can_be_created()
    {
        $this->disableExceptionHandling();
        $menu_group = [
            'name' => 'Breakfasts',
            'zh_name' => '満版復',
            'description' => 'Things we eat in the morning',
            'zh_description' => '永門義会可際査別件村約候証民'
        ];

        $response = $this->asLoggedInUser()->post('/admin/menu/groups', $menu_group);

        $response->assertStatus(201);

        $this->assertTranslatableTableHas('menu_groups', $menu_group);
    }

    /**
     *@test
     */
    public function a_menu_group_can_be_edited()
    {
        $menu_group = factory(MenuGroup::class)->create();
        $edited_data = [
            'name' => 'Breakfasts',
            'zh_name' => '満版復',
            'description' => 'Things we eat in the morning',
            'zh_description' => '永門義会可際査別件村約候証民'
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/groups/' . $menu_group->id, $edited_data);
        $response->assertStatus(200);
        $response->assertSessionMissing('errors');

        $this->assertTranslatableTableHas('menu_groups', array_merge(['id' => $menu_group->id], $edited_data));
    }

    /**
     *@test
     */
    public function updating_a_menu_group_returns_the_proper_presentation_of_the_updated_model()
    {
        $menu_group = factory(MenuGroup::class)->create();
        $edited_data = [
            'name' => 'Breakfasts',
            'zh_name' => '満版復',
            'description' => 'Things we eat in the morning',
            'zh_description' => '永門義会可際査別件村約候証民'
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/groups/' . $menu_group->id, $edited_data);
        $response->assertStatus(200);
        $returned_group_data = $response->decodeResponseJson();

        $this->assertArrayHasKey('id', $returned_group_data);
        $this->assertArrayHasKey('name', $returned_group_data);
        $this->assertArrayHasKey('zh_name', $returned_group_data);
        $this->assertArrayHasKey('description', $returned_group_data);
        $this->assertArrayHasKey('zh_description', $returned_group_data);
    }

    /**
     *@test
     */
    public function an_empty_menu_group_can_be_deleted()
    {
        $group = factory(MenuGroup::class)->create();

        $response = $this->asLoggedInUser()->json('DELETE', '/admin/menu/groups/' . $group->id);
        $response->assertStatus(200);

        $this->assertDatabaseMissing('menu_groups', ['id' => $group->id]);
    }

    /**
     *@test
     */
    public function an_non_empty_menu_group_can_be_deleted()
    {
        $group = factory(MenuGroup::class)->create();
        factory(MenuItem::class)->create(['menu_group_id' => $group->id]);

        $response = $this->asLoggedInUser()->json('DELETE', '/admin/menu/groups/' . $group->id);
        $response->assertStatus(500);

        $this->assertDatabaseHas('menu_groups', ['id' => $group->id]);
    }


}
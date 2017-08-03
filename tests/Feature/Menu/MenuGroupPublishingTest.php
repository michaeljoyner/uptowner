<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuGroup;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuGroupPublishingTest extends TestCase
{
    use DatabaseMigrations;
    /**
     *@test
     */
    public function a_menu_group_may_be_published()
    {
        $group = factory(MenuGroup::class)->create(['published' => false]);

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/groups/' . $group->id . '/publish', [
            'publish' => true
        ]);
        $response->assertStatus(200);
        $response->assertJson(['new_status' => true]);

        $this->assertDatabaseHas('menu_groups', ['id' => $group->id, 'published' => true]);
    }

    /**
     *@test
     */
    public function a_menu_group_may_be_un_published()
    {
        $group = factory(MenuGroup::class)->create(['published' => true]);

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/groups/' . $group->id . '/publish', [
            'publish' => false
        ]);
        $response->assertStatus(200);
        $response->assertJson(['new_status' => false]);

        $this->assertDatabaseHas('menu_groups', ['id' => $group->id, 'published' => false]);
    }
}
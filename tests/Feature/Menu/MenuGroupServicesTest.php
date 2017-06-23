<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuGroup;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuGroupServicesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function all_menu_groups_may_be_fetched()
    {
        $this->disableExceptionHandling();
        foreach (range(1,5) as $index) {
            factory(MenuGroup::class)->create(['name' => 'Group ' . $index]);
        }

        $response = $this->asLoggedInUser()->json('GET', '/admin/services/menu/groups');
        $response->assertStatus(200);

        $result = $response->decodeResponseJson();

        $this->assertCount(5, $result);
        foreach (range(1,5) as $index) {
            $this->assertContains('Group ' . $index, collect($result)->pluck('name')->toArray());
        }
    }
}
<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuGroup;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuGroupServicesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function all_menu_groups_may_be_fetched_in_the_correct_format()
    {
        $this->disableExceptionHandling();
        foreach (range(1, 5) as $index) {
            factory(MenuGroup::class)->create(['name' => ['en' => 'Group ' . $index, 'zh' => '満版復']]);
        }

        $response = $this->asLoggedInUser()->json('GET', '/admin/services/menu/groups');
        $response->assertStatus(200);

        $fetched_groups = $response->decodeResponseJson();

        $this->assertCount(5, $fetched_groups);
        foreach (range(1, 5) as $index) {
            $this->assertContains('Group ' . $index, collect($fetched_groups)->pluck('name')->toArray());
        }

        collect($fetched_groups)->each(function ($group) {
            $this->assertArrayHasKey('id', $group);
            $this->assertArrayHasKey('name', $group);
            $this->assertArrayHasKey('zh_name', $group);
            $this->assertArrayHasKey('description', $group);
            $this->assertArrayHasKey('zh_description', $group);
            $this->assertArrayHasKey('is_assigned', $group);
            $this->assertArrayHasKey('page_name', $group);
            $this->assertArrayHasKey('page_id', $group);
            $this->assertArrayHasKey('published', $group);
            $this->assertArrayHasKey('can_delete', $group);
        });
    }
}
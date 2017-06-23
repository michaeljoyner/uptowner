<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class MenuItemsServicesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function all_menu_items_in_a_group_may_be_fetched()
    {
        $this->disableExceptionHandling();
        $group = factory(MenuGroup::class)->create();
        foreach (range(1,5) as $index) {
            factory(MenuItem::class)->create(['name' => 'Item ' . $index, 'menu_group_id' => $group->id]);
        }
        factory(MenuItem::class, 3)->create();

        $response = $this->asLoggedInUser()
            ->json('GET', '/admin/services/menu/groups/' . $group->id . '/items');
        $response->assertStatus(200);

        $result = $response->decodeResponseJson();

        $this->assertCount(5, $result);
        foreach (range(1, 5) as $index) {
            $this->assertContains('Item ' . $index, collect($result)->pluck('name')->toArray());
        }
    }

    /**
     *@test
     */
    public function a_menu_items_image_sources_are_returned_with_the_item_data()
    {
        $item = factory(MenuItem::class)->create();
        $item->setImage(UploadedFile::fake()->image('testpic.jpg'));
        $thumb_src = $item->fresh()->imageUrl('thumb');
        $web_src = $item->fresh()->imageUrl('web');
        $image_src = $item->fresh()->imageUrl();

        $response = $this->asLoggedInUser()
            ->json('GET', '/admin/services/menu/groups/' . $item->menu_group_id . '/items');
        $response->assertStatus(200);

        $result = $response->decodeResponseJson();
        $this->assertCount(1, $result);
        $this->assertEquals($thumb_src, $result[0]['thumb_src']);
        $this->assertEquals($web_src, $result[0]['web_src']);
        $this->assertEquals($image_src, $result[0]['image_src']);

    }
}
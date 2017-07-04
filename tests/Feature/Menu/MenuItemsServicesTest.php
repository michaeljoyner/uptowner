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
            factory(MenuItem::class)->create([
                'name' => ['en' => 'Item ' . $index, 'zh' => '満版復'],
                'description' => ['en' => 'TEST DESCRIPTION', 'zh' => '永門義会可際査別件村約候証民'],
                'price' => 100,
                'is_spicy' => true,
                'is_vegetarian' => true,
                'is_recommended' => true,
                'published' => true,
                'menu_group_id' => $group->id
            ]);
        }
        factory(MenuItem::class, 3)->create();

        $response = $this->asLoggedInUser()
            ->json('GET', '/admin/services/menu/groups/' . $group->id . '/items');
        $response->assertStatus(200);

        $fetched_items = $response->decodeResponseJson();

        $this->assertCount(5, $fetched_items);
        foreach (range(1, 5) as $index) {
            $this->assertContains('Item ' . $index, collect($fetched_items)->pluck('name')->toArray());
        }

        collect($fetched_items)->each(function($item) {
            $this->assertArrayHasKey('image', $item);
            $this->assertEquals('満版復', $item['zh_name']);
            $this->assertEquals('TEST DESCRIPTION', $item['description']);
            $this->assertEquals('永門義会可際査別件村約候証民', $item['zh_description']);
            $this->assertEquals(100, $item['price']);
            $this->assertTrue($item['is_spicy']);
            $this->assertTrue($item['is_vegetarian']);
            $this->assertTrue($item['is_recommended']);
            $this->assertTrue($item['published']);
        });
    }

    /**
     *@test
     */
    public function a_menu_items_thumbnail_image_source_is_returned_with_the_item_data()
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
        $this->assertEquals($thumb_src, $result[0]['image']);
    }
}
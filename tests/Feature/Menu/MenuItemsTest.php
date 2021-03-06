<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuItemsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_menu_item_can_be_created()
    {
        $this->disableExceptionHandling();
        $group = factory(MenuGroup::class)->create();
        $menu_item = [
            'name' => 'Eggs Benedict',
            'zh_name' => '満版復',
            'description' => 'Eggs, bacon, scones, a sauce',
            'zh_description' => '永門義会可際査別件村約候証民',
            'price' => 99,
            'is_spicy' => false,
            'is_vegetarian' => true,
            'is_recommended' => true

        ];
        $response = $this->asLoggedInUser()->post('/admin/menu/groups/' . $group->id  . '/items', $menu_item);
        $response->assertStatus(201);

        $this->assertTranslatableTableHas('menu_items', array_merge(['menu_group_id'=> $group->id], $menu_item));
    }

    /**
     *@test
     */
    public function a_menu_item_can_be_created_with_missing_attributes()
    {
        $this->disableExceptionHandling();
        $group = factory(MenuGroup::class)->create();
        $menu_item = [
            'name' => 'Eggs Benedict',
            'zh_description' => '永門義会可際査別件村約候証民',
            'price' => 99,
        ];
        $response = $this->asLoggedInUser()->post('/admin/menu/groups/' . $group->id  . '/items', $menu_item);
        $response->assertStatus(201);

        $this->assertDatabaseHas('menu_items', [
            'menu_group_id' => $group->id,
            'name' => json_encode(['en' => 'Eggs Benedict', 'zh' => '']),
            'description' => json_encode(['zh' => '永門義会可際査別件村約候証民']),
            'price' => 99,
            'is_spicy' => false,
            'is_vegetarian' => false,
            'is_recommended' => false
        ]);

    }

    /**
     *@test
     */
    public function a_menu_item_requires_at_least_a_name_in_any_language()
    {
        $group = factory(MenuGroup::class)->create();
        $menu_item = [
            'description' => 'Eggs Benedict',
            'zh_description' => '永門義会可際査別件村約候証民',
            'price' => 99,
        ];
        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/groups/' . $group->id  . '/items', $menu_item);
        $response->assertStatus(422);
        $response->assertJsonStructure([ 'errors' => ['name', 'zh_name']]);
    }

    /**
     *@test
     */
    public function a_menu_item_may_be_edited()
    {
        $this->disableExceptionHandling();
        $item = factory(MenuItem::class)->create();
        $update_data = [
            'name' => 'Eggs Benedict',
            'zh_name' => '満版復',
            'description' => 'Eggs, bacon, scones, a sauce',
            'zh_description' => '永門義会可際査別件村約候証民',
            'price' => 99,
            'is_spicy' => false,
            'is_vegetarian' => true,
            'is_recommended' => true
        ];

        $response = $this->asLoggedInUser()->post('/admin/menu/items/' . $item->id, $update_data);
        $response->assertStatus(200);
        $response->assertSessionMissing('errors');

        $this->assertTranslatableTableHas('menu_items', array_merge([
            'id' => $item->id,
            'menu_group_id' => $item->menu_group_id
        ], $update_data));
    }

    /**
     *@test
     */
    public function editing_a_menu_item_will_return_new_model_correctly_formatted()
    {
        $this->disableExceptionHandling();
        $item = factory(MenuItem::class)->create();
        $update_data = [
            'name' => 'Eggs Benedict',
            'zh_name' => '満版復',
            'description' => 'Eggs, bacon, scones, a sauce',
            'zh_description' => '永門義会可際査別件村約候証民',
            'price' => 99,
            'is_spicy' => false,
            'is_vegetarian' => true,
            'is_recommended' => true
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/items/' . $item->id, $update_data);
        $response->assertStatus(200);
        $response->assertSessionMissing('errors');

        $returned_item = $response->json();

        $this->assertEquals('Eggs Benedict', $returned_item['name']);
        $this->assertEquals('満版復', $returned_item['zh_name']);
        $this->assertEquals('Eggs, bacon, scones, a sauce', $returned_item['description']);
        $this->assertEquals('永門義会可際査別件村約候証民', $returned_item['zh_description']);
        $this->assertEquals(99, $returned_item['price']);
        $this->assertTrue($returned_item['is_vegetarian']);
        $this->assertTrue($returned_item['is_recommended']);
        $this->assertFalse($returned_item['is_spicy']);
        $this->assertFalse($returned_item['published']);
        
    }

    /**
     *@test
     */
    public function a_menu_item_can_be_partially_updated_without_overwriting_existing_data_not_in_update()
    {
        $this->disableExceptionHandling();
        $item = factory(MenuItem::class)->create();
        $update_data = [
            'zh_name' => '満版復',
            'zh_description' => '永門義会可際査別件村約候証民',
        ];

        $expected_attributes = [
            'id' => $item->id,
            'menu_group_id' => $item->menu_group_id,
            'name' => $item->name,
            'zh_name' => '満版復',
            'description' => $item->description,
            'zh_description' => '永門義会可際査別件村約候証民',
            'price' => $item->price,
            'is_spicy' => $item->is_spicy,
            'is_vegetarian' => $item->is_vegetarian,
            'is_recommended' => $item->is_recommended
        ];

        $response = $this->asLoggedInUser()->post('/admin/menu/items/' . $item->id, $update_data);
        $response->assertStatus(200);
        $response->assertSessionMissing('errors');

        $this->assertTranslatableTableHas('menu_items', $expected_attributes);
    }

    /**
     *@test
     */
    public function an_empty_string_in_request_will_overwrite_existing_value()
    {
        $this->disableExceptionHandling();
        $item = factory(MenuItem::class)->create();
        $update_data = [
            'zh_name' => '満版復',
            'zh_description' => '',
        ];

        $expected_attributes = [
            'id' => $item->id,
            'menu_group_id' => $item->menu_group_id,
            'name' => $item->name,
            'zh_name' => '満版復',
            'description' => $item->description,
            'zh_description' => null,
            'price' => $item->price,
            'is_spicy' => $item->is_spicy,
            'is_vegetarian' => $item->is_vegetarian,
            'is_recommended' => $item->is_recommended
        ];

        $response = $this->asLoggedInUser()->post('/admin/menu/items/' . $item->id, $update_data);
        $response->assertStatus(200);
        $response->assertSessionMissing('errors');

        $this->assertTranslatableTableHas('menu_items', $expected_attributes);
    }

    /**
     *@test
     */
    public function a_menu_item_may_be_deleted()
    {
        $item = factory(MenuItem::class)->create();

        $response = $this->asLoggedInUser()->delete('/admin/menu/items/' . $item->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('menu_items', ['id' => $item->id]);
    }
}
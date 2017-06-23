<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuItemTogglesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_menu_item_may_be_published()
    {
        $this->disableExceptionHandling();
        $item = factory(MenuItem::class)->create(['published' => false]);

        $expected_table_data = [
            'name'           => $item->name,
            'zh_name'        => $item->getTranslation('name', 'zh'),
            'description'    => $item->description,
            'zh_description' => $item->getTranslation('description', 'zh'),
            'price'          => $item->price,
            'is_spicy'       => $item->is_spicy,
            'is_vegetarian'  => $item->is_vegetarian,
            'is_recommended' => $item->is_recommended,
            'published'      => true
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/items/' . $item->id . '/publish',
            ['published' => true]);
        $response->assertStatus(200);
        $this->assertEquals(['new_status' => true], $response->decodeResponseJson());

        $this->assertTranslatableTableHas('menu_items', $expected_table_data);
    }

    /**
     *@test
     */
    public function a_menu_item_may_be_unpublished()
    {
        $this->disableExceptionHandling();
        $item = factory(MenuItem::class)->create(['published' => true]);

        $expected_table_data = [
            'name'           => $item->name,
            'zh_name'        => $item->getTranslation('name', 'zh'),
            'description'    => $item->description,
            'zh_description' => $item->getTranslation('description', 'zh'),
            'price'          => $item->price,
            'is_spicy'       => $item->is_spicy,
            'is_vegetarian'  => $item->is_vegetarian,
            'is_recommended' => $item->is_recommended,
            'published'      => false
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/items/' . $item->id . '/publish',
            ['published' => false]);
        $response->assertStatus(200);
        $this->assertEquals(['new_status' => false], $response->decodeResponseJson());

        $this->assertTranslatableTableHas('menu_items', $expected_table_data);
    }

    /**
     *@test
     */
    public function a_menu_items_is_spicy_attribute_can_be_updated()
    {
        $this->disableExceptionHandling();
        $item = factory(MenuItem::class)->create(['is_spicy' => true]);

        $expected_table_data = [
            'name'           => $item->name,
            'zh_name'        => $item->getTranslation('name', 'zh'),
            'description'    => $item->description,
            'zh_description' => $item->getTranslation('description', 'zh'),
            'price'          => $item->price,
            'is_spicy'       => false,
            'is_vegetarian'  => $item->is_vegetarian,
            'is_recommended' => $item->is_recommended,
            'published'      => $item->published
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/items/' . $item->id . '/spicy',
            ['is_spicy' => false]);
        $response->assertStatus(200);
        $this->assertEquals(['new_status' => false], $response->decodeResponseJson());

        $this->assertTranslatableTableHas('menu_items', $expected_table_data);
    }

    /**
     *@test
     */
    public function a_menu_items_is_vegetarian_attribute_may_be_updated()
    {
        $this->disableExceptionHandling();
        $item = factory(MenuItem::class)->create(['is_vegetarian' => false]);

        $expected_table_data = [
            'name'           => $item->name,
            'zh_name'        => $item->getTranslation('name', 'zh'),
            'description'    => $item->description,
            'zh_description' => $item->getTranslation('description', 'zh'),
            'price'          => $item->price,
            'is_spicy'       => $item->is_spicy,
            'is_vegetarian'  => true,
            'is_recommended' => $item->is_recommended,
            'published'      => $item->published
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/items/' . $item->id . '/vegetarian',
            ['is_vegetarian' => true]);
        $response->assertStatus(200);
        $this->assertEquals(['new_status' => true], $response->decodeResponseJson());

        $this->assertTranslatableTableHas('menu_items', $expected_table_data);
    }

    /**
     *@test
     */
    public function a_menu_items_recommended_attribute_may_be_updated()
    {
        $this->disableExceptionHandling();
        $item = factory(MenuItem::class)->create(['is_recommended' => false]);

        $expected_table_data = [
            'name'           => $item->name,
            'zh_name'        => $item->getTranslation('name', 'zh'),
            'description'    => $item->description,
            'zh_description' => $item->getTranslation('description', 'zh'),
            'price'          => $item->price,
            'is_spicy'       => $item->is_spicy,
            'is_recommended'  => true,
            'is_vegetarian' => $item->is_vegetarian,
            'published'      => $item->published
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/items/' . $item->id . '/recommended',
            ['is_recommended' => true]);
        $response->assertStatus(200);
        $this->assertEquals(['new_status' => true], $response->decodeResponseJson());

        $this->assertTranslatableTableHas('menu_items', $expected_table_data);
    }
}
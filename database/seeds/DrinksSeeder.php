<?php

use Illuminate\Database\Seeder;

class DrinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $drinks = factory(\App\Menu\MenuPage::class)->create([
            'name' => ['en' => 'Drinks', 'zh' => '満版復'],
            'published' => true
        ]);







        $beers = factory(\App\Menu\MenuGroup::class)->create([
            'menu_page_id' => $drinks->id,
            'name' => ['en' => 'Beer and Wine', 'zh' => '満版復'],
            'description' => ['en' => 'All things fine', 'zh' => '永門義会可際査別件村約候証民'],
            'published' => true
        ]);

        $cocktails = factory(\App\Menu\MenuGroup::class)->create([
            'menu_page_id' => $drinks->id,
            'name' => ['en' => 'Cocktails', 'zh' => '満版復'],
            'description' => ['en' => 'For the good times', 'zh' => '永門義会可際査別件村約候証民'],
            'published' => true
        ]);

        $soft_drinks = factory(\App\Menu\MenuGroup::class)->create([
            'menu_page_id' => $drinks->id,
            'name' => ['en' => 'Soft drinks', 'zh' => '満版復'],
            'description' => ['en' => 'For the hard times', 'zh' => '永門義会可際査別件村約候証民'],
            'published' => true
        ]);







        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $soft_drinks->id,
            'name'           => ['en' => 'Soda', 'zh' => '満版復'],
            'description'    => ['en' => 'Choose from Coke, Sprite, Fanta, Mountain Dew', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 100,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $soft_drinks->id,
            'name'           => ['en' => 'Fruit Juice', 'zh' => '満版復'],
            'description'    => ['en' => 'Choose from Apple, Pineapple, Mango, Watermelon', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 120,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $soft_drinks->id,
            'name'           => ['en' => 'Milkshakes', 'zh' => '満版復'],
            'description'    => ['en' => 'Choose from Vanilla, Chocolate or Strawberry', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 150,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $beers->id,
            'name'           => ['en' => 'Draft Beer', 'zh' => '満版復'],
            'description'    => ['en' => 'House beer on tap', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 120,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $beers->id,
            'name'           => ['en' => 'Taiwan Classic Beer', 'zh' => '満版復'],
            'description'    => ['en' => 'Classic Taiwan Beer', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 80,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $beers->id,
            'name'           => ['en' => 'Taiwan Gold Medal Beer', 'zh' => '満版復'],
            'description'    => ['en' => 'Classic Gold Medal Beer', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 100,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $beers->id,
            'name'           => ['en' => 'White wine', 'zh' => '満版復'],
            'description'    => ['en' => 'Dry white wine', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 80,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $beers->id,
            'name'           => ['en' => 'Red wine', 'zh' => '満版復'],
            'description'    => ['en' => 'House red wine', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 80,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $cocktails->id,
            'name'           => ['en' => 'Mojito', 'zh' => '満版復'],
            'description'    => ['en' => 'Rum, Mint, Joy, Summer', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 180,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $cocktails->id,
            'name'           => ['en' => 'Daquari', 'zh' => '満版復'],
            'description'    => ['en' => 'Vodka, No Idea, Mint, Joy, Summer', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 185,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $cocktails->id,
            'name'           => ['en' => 'Bloody Mary', 'zh' => '満版復'],
            'description'    => ['en' => 'Rum, Tears, Joyless, Winter', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 190,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);
    }
}

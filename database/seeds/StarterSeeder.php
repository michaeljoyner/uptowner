<?php

use Illuminate\Database\Seeder;

class StarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appetizers = factory(\App\Menu\MenuPage::class)->create([
            'name' => ['en' => 'Appetizers', 'zh' => '満版復'],
            'published' => true
        ]);
        $soups = factory(\App\Menu\MenuGroup::class)->create([
            'menu_page_id' => $appetizers->id,
            'name' => ['en' => 'Soups', 'zh' => '満版復'],
            'description' => ['en' => 'Good old fashioned soup', 'zh' => '永門義会可際査別件村約候証民'],
            'published' => true
        ]);

        $salads = factory(\App\Menu\MenuGroup::class)->create([
            'menu_page_id' => $appetizers->id,
            'name' => ['en' => 'Salads', 'zh' => '満版復'],
            'description' => ['en' => 'Fresh from the earth', 'zh' => '永門義会可際査別件村約候証民'],
            'published' => true
        ]);

        $snacks = factory(\App\Menu\MenuGroup::class)->create([
            'menu_page_id' => $appetizers->id,
            'name' => ['en' => 'Starters', 'zh' => '満版復'],
            'description' => ['en' => 'Whet the appetite with these winners', 'zh' => '永門義会可際査別件村約候証民'],
            'published' => true
        ]);
        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $soups->id,
            'name'           => ['en' => 'Soup of the Day - Cup', 'zh' => '満版復'],
            'description'    => ['en' => 'Homemade daily soup', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 90,
            'is_spicy'       => false,
            'is_vegetarian'  => true,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $soups->id,
            'name'           => ['en' => 'Soup of the Day - Bowl', 'zh' => '満版復'],
            'description'    => ['en' => 'Homemade daily soup', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 140,
            'is_spicy'       => false,
            'is_vegetarian'  => true,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $soups->id,
            'name'           => ['en' => 'Uptowner Chili (Cup)', 'zh' => '満版復'],
            'description'    => ['en' => 'Sour Cream, Cheddar, Onion', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 110,
            'is_spicy'       => false,
            'is_vegetarian'  => true,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $soups->id,
            'name'           => ['en' => 'Uptowner Chili (Bowl)', 'zh' => '満版復'],
            'description'    => ['en' => 'Sour Cream, Cheddar, Onion', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 160,
            'is_spicy'       => false,
            'is_vegetarian'  => true,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $salads->id,
            'name'           => ['en' => 'Caesar Salad', 'zh' => '満版復'],
            'description'    => ['en' => 'Romain, Parmesan, Bacon, Croutons, Tossed in Caesar', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 160,
            'is_spicy'       => false,
            'is_vegetarian'  => true,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $salads->id,
            'name'           => ['en' => 'Caesar Salad with Grilled Chicken', 'zh' => '満版復'],
            'description'    => ['en' => 'Classic Caesar with tender grilled chicken', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 225,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $salads->id,
            'name'           => ['en' => 'Caesar Salad with Smoked Salmon', 'zh' => '満版復'],
            'description'    => ['en' => 'Classic Caesar with Smoked Salmon', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 270,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $salads->id,
            'name'           => ['en' => 'Greek Salad', 'zh' => '満版復'],
            'description'    => ['en' => 'Mixed Greens, Cucumber, Green Peppers, Tomato, Olives, Feta, Tossed in Red Wine Vinaigrette', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 170,
            'is_spicy'       => false,
            'is_vegetarian'  => true,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $salads->id,
            'name'           => ['en' => 'Greek Salad with Grilled Chicken', 'zh' => '満版復'],
            'description'    => ['en' => 'Add Grilled Chicken to your Greek Salad', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 235,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $salads->id,
            'name'           => ['en' => 'Greek Salad with Smoked Salmon', 'zh' => '満版復'],
            'description'    => ['en' => 'Add Smoked Salmon to your Greek Salad', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 280,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $salads->id,
            'name'           => ['en' => 'Chef Salad', 'zh' => '満版復'],
            'description'    => ['en' => 'Mixed Greens, Ham, Turkey, Hard Boiled Egg, Tomato, Cheddar, Choice of Dressing', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 220,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $salads->id,
            'name'           => ['en' => 'Garden Salad', 'zh' => '満版復'],
            'description'    => ['en' => 'Mixed Greens, Cucumber, Tomato, Carrot, Onions, Green Peppers, Choice of Dressing', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 140,
            'is_spicy'       => false,
            'is_vegetarian'  => true,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $salads->id,
            'name'           => ['en' => 'Cobb Salad', 'zh' => '満版復'],
            'description'    => ['en' => 'Romaine, Chicken Breast, Bacon, Tomato, Hard Boiled Egg, Blue Cheese, Choice of Dressing', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 230,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $snacks->id,
            'name'           => ['en' => 'French Fries', 'zh' => '満版復'],
            'description'    => ['en' => 'Homemade French Fries and Ranch', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 90,
            'is_spicy'       => false,
            'is_vegetarian'  => true,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $snacks->id,
            'name'           => ['en' => 'Chips and Salsa', 'zh' => '満版復'],
            'description'    => ['en' => 'Tortilla Chips and Salsa dip', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 70,
            'is_spicy'       => false,
            'is_vegetarian'  => true,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $snacks->id,
            'name'           => ['en' => 'Chicken Strips', 'zh' => '満版復'],
            'description'    => ['en' => '4 Pieces of Chicken Tenders, French Fries, Served with Ranch, Honey Mustard, BBQ or Chipotle Mayo', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 170,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $snacks->id,
            'name'           => ['en' => 'Deep Fried Cheese Sticks', 'zh' => '満版復'],
            'description'    => ['en' => 'Deep Fried Cheese Sticks Served with Mariana, Ranch, Honey Mustard, BBQ or Chipotle Mayo', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 150,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);
    }
}

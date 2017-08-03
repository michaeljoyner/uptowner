<?php

use Illuminate\Database\Seeder;

class BreakfastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $breakfasts = factory(\App\Menu\MenuPage::class)->create([
            'name' => ['en' => 'Breakfasts', 'zh' => '満版復'],
            'published' => true
        ]);
        $omelettes = factory(\App\Menu\MenuGroup::class)->create([
            'menu_page_id' => $breakfasts->id,
            'name' => ['en' => 'Omelettes', 'zh' => '満版復'],
            'description' => ['en' => 'messy eggs and some cheese', 'zh' => '永門義会可際査別件村約候証民'],
            'published' => true
        ]);

        $bennies = factory(\App\Menu\MenuGroup::class)->create([
            'menu_page_id' => $breakfasts->id,
            'name' => ['en' => 'Eggs Benedict', 'zh' => '満版復'],
            'description' => ['en' => 'Soft eggs on scones with sauce', 'zh' => '永門義会可際査別件村約候証民'],
            'published' => true
        ]);

        $combos = factory(\App\Menu\MenuGroup::class)->create([
            'menu_page_id' => $breakfasts->id,
            'name' => ['en' => 'Breakfast Combos', 'zh' => '満版復'],
            'description' => ['en' => 'Combo of classic breakfast food', 'zh' => '永門義会可際査別件村約候証民'],
            'published' => true
        ]);

        $signature = factory(\App\Menu\MenuGroup::class)->create([
            'menu_page_id' => $breakfasts->id,
            'name' => ['en' => 'Signature Breakfasts', 'zh' => '満版復'],
            'description' => ['en' => 'The breakfasts that made us famous', 'zh' => '永門義会可際査別件村約候証民'],
            'published' => true
        ]);
        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $omelettes->id,
            'name'           => ['en' => 'Denver', 'zh' => '満版復'],
            'description'    => ['en' => 'Ham, Onion, Green Peppers, Cheddar', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 270,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $omelettes->id,
            'name'           => ['en' => 'Mighty Meat', 'zh' => '満版復'],
            'description'    => ['en' => 'Sausage, Bacon, Ham, Cheddar', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 2785,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $omelettes->id,
            'name'           => ['en' => 'Veggie', 'zh' => '満版復'],
            'description'    => ['en' => 'Onion, Green Peppers, Mushroom, Tomato, Cheddar', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 265,
            'is_spicy'       => false,
            'is_vegetarian'  => true,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $omelettes->id,
            'name'           => ['en' => 'St. Paul', 'zh' => '満版復'],
            'description'    => ['en' => 'Sausage, Mushroom, Tomato, Cheddar', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 285,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $omelettes->id,
            'name'           => ['en' => 'Mediterranean', 'zh' => '満版復'],
            'description'    => ['en' => 'Spinach, Feta, Tomato', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 265,
            'is_spicy'       => false,
            'is_vegetarian'  => true,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $omelettes->id,
            'name'           => ['en' => 'Mexican', 'zh' => '満版復'],
            'description'    => ['en' => 'Tomato, Onion, Pickled Jalapeno, Pepper Jack, Cajun Spice', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 260,
            'is_spicy'       => true,
            'is_vegetarian'  => true,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $omelettes->id,
            'name'           => ['en' => 'Smoked Salmon', 'zh' => '満版復'],
            'description'    => ['en' => 'Cream Cheese, Caper, Red Onion', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 320,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $bennies->id,
            'name'           => ['en' => 'Uptowner Benny', 'zh' => '満版復'],
            'description'    => ['en' => '2 Poached Eggs, Sausage, Tomato, Creole Hollandaise', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 280,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $bennies->id,
            'name'           => ['en' => 'Florentine Benny', 'zh' => '満版復'],
            'description'    => ['en' => '2 Poached Eggs, Spinach, Tomato, Traditional Hollandaise', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 260,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $bennies->id,
            'name'           => ['en' => 'Traditional Benny', 'zh' => '満版復'],
            'description'    => ['en' => '2 Poached Eggs, Ham, Traditional Hollandaise', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 260,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $bennies->id,
            'name'           => ['en' => 'Pomodoro Benny', 'zh' => '満版復'],
            'description'    => ['en' => '2 Poached Eggs, Tomato, Mozzarella, Basil Hollandaise', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 280,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $bennies->id,
            'name'           => ['en' => 'B.C. Benny', 'zh' => '満版復'],
            'description'    => ['en' => '2 Poached Eggs, Smoked Salmon, Grilled Onion, Dill Hollandaise', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 310,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $bennies->id,
            'name'           => ['en' => 'German Benny', 'zh' => '満版復'],
            'description'    => ['en' => '2 Poached Eggs, Sauerkraut, Peppered Beef, Mustard Hollandaise', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 280,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $combos->id,
            'name'           => ['en' => 'Combo #1', 'zh' => '満版復'],
            'description'    => ['en' => '2 Eggs, Meat, Toast', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 170,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $combos->id,
            'name'           => ['en' => 'Combo #2', 'zh' => '満版復'],
            'description'    => ['en' => '2 Eggs, Hashbrowns, Toast', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 170,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $combos->id,
            'name'           => ['en' => 'Combo #3', 'zh' => '満版復'],
            'description'    => ['en' => '2 Eggs, Hashbrowns, Meat & Toast', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 225,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $combos->id,
            'name'           => ['en' => 'Combo #4', 'zh' => '満版復'],
            'description'    => ['en' => '2 Eggs, Meat & Pancakes (sub French Toast or Waffles)', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 250,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $combos->id,
            'name'           => ['en' => 'Combo #5', 'zh' => '満版復'],
            'description'    => ['en' => '2 Eggs, Meat, Hashbrowns & Pancakes (sub French Toast or Waffles)', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 285,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $signature->id,
            'name'           => ['en' => 'Tex Mex Wrap', 'zh' => '満版復'],
            'description'    => ['en' => 'Crisp Hashbrowns, 2 Scrambled Eggs, Sausage, Pepper Jack, Sour Cream, Onion, Flour Tortilla, Salsa', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 295,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $signature->id,
            'name'           => ['en' => 'The Cajun', 'zh' => '満版復'],
            'description'    => ['en' => 'Crisp Hashbrowns, Green Pepper, Onion, Mushroom, Cheddar, 2 Over Easy Eggs, Creole Hollandaise, Cajun Spice, Served with Whole Wheat or White Toast', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 290,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $signature->id,
            'name'           => ['en' => 'The Farmer', 'zh' => '満版復'],
            'description'    => ['en' => 'Crisp Hashbrowns, Onion, Cheddar, 2 Scrambled Eggs, Sausage Patty, Bacon, Served with Whole Wheat or White Toast', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 290,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $signature->id,
            'name'           => ['en' => 'The Memphis', 'zh' => '満版復'],
            'description'    => ['en' => 'Crisp Hashbrowns, 2 Over Easy Eggs, Grilled Tomato, Mushroom, BBQ Pit Beans, BBQ Sauce, Served with Whole Wheat or White Toast', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 275,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => true,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $signature->id,
            'name'           => ['en' => 'Veggie Scramble', 'zh' => '満版復'],
            'description'    => ['en' => '4Egg Whites Scrambled with Spinach, Onion, Broccoli, Mushroom, Tomato, Green Pepper, Light Cheddar, Served with Fruit Cup and  Whole Wheat or White Toast', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 285,
            'is_spicy'       => false,
            'is_vegetarian'  => true,
            'is_recommended' => true,
            'published'      => true
        ]);
    }
}

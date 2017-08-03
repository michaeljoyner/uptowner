<?php

use Illuminate\Database\Seeder;

class LunchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lunch = factory(\App\Menu\MenuPage::class)->create([
            'name' => ['en' => 'Burgers & Sandwiches', 'zh' => '満版復'],
            'published' => true
        ]);

        $burgers = factory(\App\Menu\MenuGroup::class)->create([
            'menu_page_id' => $lunch->id,
            'name' => ['en' => 'Burgers', 'zh' => '満版復'],
            'description' => ['en' => 'The best diner burgers in town', 'zh' => '永門義会可際査別件村約候証民'],
            'published' => true
        ]);

        $sandwiches = factory(\App\Menu\MenuGroup::class)->create([
            'menu_page_id' => $lunch->id,
            'name' => ['en' => 'Sandwiches', 'zh' => '満版復'],
            'description' => ['en' => 'A lunch staple done right', 'zh' => '永門義会可際査別件村約候証民'],
            'published' => true
        ]);
        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $sandwiches->id,
            'name'           => ['en' => 'BLT', 'zh' => '満版復'],
            'description'    => ['en' => 'Bacon, Lettuce, Tomato, Chipotle Mayo', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 210,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $sandwiches->id,
            'name'           => ['en' => 'BLT with Cheddar', 'zh' => '満版復'],
            'description'    => ['en' => 'Bacon, Lettuce, Tomato, Cheddar, Chipotle Mayo', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 240,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $sandwiches->id,
            'name'           => ['en' => 'Reuben', 'zh' => '満版復'],
            'description'    => ['en' => 'Peppered Beef, Sauerkraut, Swiss Cheese, 1000 Island Dressing on Grilled Bread', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 260,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $sandwiches->id,
            'name'           => ['en' => 'Rachel', 'zh' => '満版復'],
            'description'    => ['en' => 'Turkey, Sauerkraut, Swiss Cheese, 1000 Island Dressing on Grilled Bread', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 260,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $sandwiches->id,
            'name'           => ['en' => 'Rafael', 'zh' => '満版復'],
            'description'    => ['en' => 'Veggie Patty, Sauerkraut, Swiss Cheese, 1000 Island Dressing on Grilled Bread', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 260,
            'is_spicy'       => false,
            'is_vegetarian'  => true,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $sandwiches->id,
            'name'           => ['en' => 'Cordon Bleu', 'zh' => '満版復'],
            'description'    => ['en' => 'Chicken, Ham, Mushroom, Swiss Cheese on Grilled Bread', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 265,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $sandwiches->id,
            'name'           => ['en' => 'Chicago Club', 'zh' => '満版復'],
            'description'    => ['en' => 'Turkey, Ham, Bacon,  Cheddar, Lettuce, Tomato, Swiss Cheese, Chipotle Mayo', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 280,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $sandwiches->id,
            'name'           => ['en' => 'Three Cheese Melt', 'zh' => '満版復'],
            'description'    => ['en' => 'Cheddar, Pepper Jack, Swiss Cheese', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 250,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $sandwiches->id,
            'name'           => ['en' => 'Three Cheese Melt with Ham or Bacon', 'zh' => '満版復'],
            'description'    => ['en' => 'Cheddar, Pepper Jack, Swiss Cheese, Ham or Bacon', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 280,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $sandwiches->id,
            'name'           => ['en' => 'Three Cheese Melt with Grilled Tomato or Onion', 'zh' => '満版復'],
            'description'    => ['en' => 'Cheddar, Pepper Jack, Swiss Cheese, Grilled Tomato or Onion', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 275,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $sandwiches->id,
            'name'           => ['en' => 'Tuna Melt', 'zh' => '満版復'],
            'description'    => ['en' => 'Mayonnaise, Onion, Celery, Pepper Jack', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 255,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $sandwiches->id,
            'name'           => ['en' => 'Chicken Strip Melt', 'zh' => '満版復'],
            'description'    => ['en' => 'Swiss Cheese, Bacon, Served with Ranch Dressing', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 275,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $sandwiches->id,
            'name'           => ['en' => 'Buffalo Chicken Strip', 'zh' => '満版復'],
            'description'    => ['en' => 'Chipotle Mayo, Franks Red Hot, Pepper Jack Cheese, Grilled Onion, Lettuce', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 280,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $burgers->id,
            'name'           => ['en' => 'Basic Burger', 'zh' => '満版復'],
            'description'    => ['en' => 'Beef Patty, Lettuce, Tomato, Chipotle Mayo', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 240,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $burgers->id,
            'name'           => ['en' => 'Cheddar Burger', 'zh' => '満版復'],
            'description'    => ['en' => 'Beef Patty, Cheddar, Lettuce, Tomato, Chipotle Mayo', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 240,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $burgers->id,
            'name'           => ['en' => 'Huamei Double', 'zh' => '満版復'],
            'description'    => ['en' => '2 Patties, Double Cheddar, Double Bacon', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 280,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $burgers->id,
            'name'           => ['en' => 'Mushroom and Swiss Burger', 'zh' => '満版復'],
            'description'    => ['en' => 'Beef Patty, Mushroom, Swiss Cheese, Lettuce, Tomato, Chipotle Mayo', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 280,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $burgers->id,
            'name'           => ['en' => 'Blue Cheese and Bacon Burger', 'zh' => '満版復'],
            'description'    => ['en' => 'Beef Patty, Blue Cheese, Bacon, Lettuce, Tomato, Chipotle Mayo', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 285,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $burgers->id,
            'name'           => ['en' => 'BBQ Bacon Cheese Burger', 'zh' => '満版復'],
            'description'    => ['en' => 'Beef Patty, Bacon, Cheddar, BBQ Sauce, Lettuce, Tomato, Chipotle Mayo', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 285,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $burgers->id,
            'name'           => ['en' => 'The Don Dada', 'zh' => '満版復'],
            'description'    => ['en' => 'Mushroom, Onion, Bacon, Pepper Jack, Pickled Jalapeno, BBQ Sauce', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 310,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $burgers->id,
            'name'           => ['en' => 'Garden Burger', 'zh' => '満版復'],
            'description'    => ['en' => 'Homemade Veggie Patty with Cucumber added on top', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 250,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);

        factory(\App\Menu\MenuItem::class)->create([
            'menu_group_id' => $burgers->id,
            'name'           => ['en' => 'The Hypocrite', 'zh' => '満版復'],
            'description'    => ['en' => 'Veggie Burger with Bacon and Cheddar Cheese', 'zh' => '永門義会可際査別件村約候証民'],
            'price'          => 280,
            'is_spicy'       => false,
            'is_vegetarian'  => false,
            'is_recommended' => false,
            'published'      => true
        ]);
    }
}

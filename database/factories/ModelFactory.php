<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => 'password',
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Menu\MenuPage::class, function (Faker\Generator $faker) {
//    $zh_faker = Faker\Factory::create('zh_TW');

    return [
        'name'      => ['en' => $faker->name, 'zh' => 'zh'],
        'published' => false
    ];
});

$factory->define(App\Menu\MenuGroup::class, function (Faker\Generator $faker) {
//    $zh_faker = Faker\Factory::create('zh_TW');

    return [
        'menu_page_id' => function() {
            return factory(\App\Menu\MenuPage::class)->create()->id;
        },
        'name'        => ['en' => $faker->name, 'zh' => 'zh'],
        'description' => ['en' => $faker->sentence, 'zh' => 'zh']
    ];
});

$factory->define(App\Menu\MenuItem::class, function (Faker\Generator $faker) {
//    $zh_faker = Faker\Factory::create('zh_TW');

    return [
        'menu_group_id'  => function () {
            return factory(\App\Menu\MenuGroup::class)->create()->id;
        },
        'name'           => ['en' => $faker->name, 'zh' => 'zh'],
        'description'    => ['en' => $faker->sentence, 'zh' => 'zh'],
        'price'          => $faker->numberBetween(100, 400),
        'is_spicy'       => false,
        'is_vegetarian'  => false,
        'is_recommended' => false,
        'published'      => false
    ];
});

$factory->define(App\Specials\Special::class, function (Faker\Generator $faker) {
//    $zh_faker = Faker\Factory::create('zh_TW');

    return [
        'title'       => ['en' => $faker->sentence, 'zh' => 'zh'],
        'description' => ['en' => $faker->sentence, 'zh' => 'zh'],
        'price'       => $faker->numberBetween(100, 400),
        'start_date'  => \Carbon\Carbon::now(),
        'end_date'    => \Carbon\Carbon::parse('+7 days')
    ];
});

$factory->define(App\Occasions\Event::class, function (Faker\Generator $faker) {
//    $zh_faker = Faker\Factory::create('zh_TW');

    return [
        'event_date'  => \Carbon\Carbon::parse('+' . $faker->numberBetween(1, 10) . ' days'),
        'name'        => ['en' => $faker->sentence, 'zh' => 'zh'],
        'description' => ['en' => $faker->sentences(2, true), 'zh' => 'zh'],
        'long_description' => ['en' => $faker->sentences(5, true), 'zh' => 'zh'],
        'time_of_day' => ['en' => $faker->sentence, 'zh' => 'zh'],
        'published'   => false
    ];
});

$factory->define(App\Menu\FeaturedItem::class, function (Faker\Generator $faker) {

    return [
        'menu_item_id' => function () {
            return factory(\App\Menu\MenuItem::class)->create()->id;
        }
    ];
});
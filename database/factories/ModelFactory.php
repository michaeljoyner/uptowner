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

$factory->define(App\Menu\MenuGroup::class, function (Faker\Generator $faker) {
    $zh_faker = Faker\Factory::create('zh_TW');

    return [
        'name'        => ['en' => $faker->name, 'zh' => $zh_faker->name],
        'description' => ['en' => $faker->sentence, 'zh' => $zh_faker->realText(10)]
    ];
});

$factory->define(App\Menu\MenuItem::class, function (Faker\Generator $faker) {
    $zh_faker = Faker\Factory::create('zh_TW');

    return [
        'menu_group_id'  => function () {
            return factory(\App\Menu\MenuGroup::class)->create()->id;
        },
        'name'           => ['en' => $faker->name, 'zh' => $zh_faker->name],
        'description'    => ['en' => $faker->sentence, 'zh' => $zh_faker->realText(10)],
        'price'          => $faker->numberBetween(100, 400),
        'is_spicy'       => false,
        'is_vegetarian'  => false,
        'is_recommended' => false,
        'published'      => false
    ];
});

$factory->define(App\Specials\Special::class, function (Faker\Generator $faker) {
    $zh_faker = Faker\Factory::create('zh_TW');

    return [
        'title'           => ['en' => $faker->sentence, 'zh' => $zh_faker->realText(12)],
        'description'    => ['en' => $faker->sentence, 'zh' => $zh_faker->realText(20)],
        'price'          => $faker->numberBetween(100, 400),
        'start_date' => \Carbon\Carbon::now(),
        'end_date'      => \Carbon\Carbon::parse('+7 days')
    ];
});

$factory->define(App\Occasions\Event::class, function (Faker\Generator $faker) {
    $zh_faker = Faker\Factory::create('zh_TW');

    return [
        'event_date'  => \Carbon\Carbon::parse('+' . $faker->numberBetween(1, 10) . ' days'),
        'name'        => ['en' => $faker->sentence, 'zh' => $zh_faker->realText(10)],
        'description' => ['en' => $faker->sentences(2, true), 'zh' => $zh_faker->realText(20)],
        'time_of_day' => ['en' => $faker->sentence, 'zh' => $zh_faker->realText(12)],
        'published'   => false
    ];
});

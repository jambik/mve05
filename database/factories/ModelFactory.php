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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'api_token' => str_random(60),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Page::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'text' => $faker->paragraph(3),
        'title' => $faker->sentence(2),
        'keywords' => implode(', ', $faker->words(4)),
        'description' => $faker->sentence(),
    ];
});

$factory->define(App\News::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(2),
        'text' => $faker->paragraph(3),
        'published_at' => $faker->dateTimeThisMonth(),
        'image' => $faker->image(storage_path('images').DIRECTORY_SEPARATOR.'news', 640, 480, null, false, false),
    ];
});

$factory->define(App\Azs::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->paragraph(3),
        'location' => $faker->city,
        'address' => $faker->address,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
    ];
});
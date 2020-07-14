<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use App\Profile;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [

    ];
});

// Model Factory Callbacks
$factory->afterCreating(App\Author::class, function ($author, $faker) {
    $author->profile()->save(factory(App\Profile::class)->make());
});

$factory->afterMaking(App\Author::class, function ($author, $faker) {
    $author->profile()->save(factory(App\Profile::class)->make());
});

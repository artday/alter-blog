<?php

use App\Models\BlogPost;
use Faker\Generator as Faker;

$factory->define(BlogPost::class, function (Faker $faker) {

    $title = $faker->sentence(rand(3, 6), true);
    $text = $faker->realText(rand(1500, 5000));
    $isPublished = rand(1, 5) > 1;
    $createdAt = $faker->dateTimeBetween('-3 months', '-2 months');
    $data = [
        'user_id' => (rand(1, 5) == 5) ? 1 : rand(2, 5),
        'category_id' => rand(1, 20),
        'title' => $title,
        'slug' => str_slug($title),
        'excerpt' => $faker->text(rand(50, 100)),
        'content_raw' => $text,
        'content_html' => $text,
        'is_published' => $isPublished,
        'published_at' => $isPublished ? $faker->dateTimeBetween('-2 months', '-5 days') : null,
        'created_at' => $createdAt,
        'updated_at' => $createdAt
    ];
    return $data;
});

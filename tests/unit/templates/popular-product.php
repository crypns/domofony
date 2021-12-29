<?php
return [
        'name' => $faker->word . $index,
        'product_code' => $faker->word,
        'description' => $faker->text($maxNbChars = 200),
        'image' => $faker->imageUrl($width=800, $height=800, 'cats'),
        'product_link' => $faker->url,
        'created_at' => $faker->date($format = 'Y-m-d', $max = 'now') . ' ' . $faker->time($format = 'H:i:s', $max = 'now'),
        'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now') . ' ' . $faker->time($format = 'H:i:s', $max = 'now'),
];
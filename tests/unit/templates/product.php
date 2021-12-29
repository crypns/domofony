<?php
return [
        'name' => $faker->word . $index,
        'category_id' => $faker->numberBetween(1, 10),
        'image' => $faker->imageUrl($width=800, $height=800, 'cats'),
        'created_at' => $faker->date($format = 'Y-m-d', $max = 'now') . ' ' . $faker->time($format = 'H:i:s', $max = 'now'),
        'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now') . ' ' . $faker->time($format = 'H:i:s', $max = 'now'),
];
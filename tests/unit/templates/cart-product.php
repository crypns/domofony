<?php
return [
        'cart_id' => $faker->numberBetween(1, 10),
        'product_id' => $faker->numberBetween(1, 10),
        'count' => $faker->numberBetween($min = 1, $max = 100),
        'created_at' => $faker->date($format = 'Y-m-d', $max = 'now') . ' ' . $faker->time($format = 'H:i:s', $max = 'now'),
        'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now') . ' ' . $faker->time($format = 'H:i:s', $max = 'now'),
];
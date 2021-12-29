<?php
return [
        'full_name' => $faker->word . $index,
        'phone_number' => $faker->phoneNumber,
        'email' => $faker->email,
        'address' => $faker->address,
        'delivery' => $faker->numberBetween($min = 0, $max = 1),
        'general_cost' => $faker->numberBetween($min = 200, $max = 10000),
        'general_count' => $faker->numberBetween($min = 1, $max = 100),
        'status_order' => 'New',
        'created_at' => $faker->date($format = 'Y-m-d', $max = 'now') . ' ' . $faker->time($format = 'H:i:s', $max = 'now'),
        'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now') . ' ' . $faker->time($format = 'H:i:s', $max = 'now'),
];
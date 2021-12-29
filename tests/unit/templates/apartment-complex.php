<?php
return [
        'name' => $faker->text($maxNbChars = 15)    . $index,
        'address' => $faker->address,
        'description' => $faker->text($maxNbChars = 200) ,
        'created_at' => $faker->date($format = 'Y-m-d', $max = 'now') . ' ' . $faker->time($format = 'H:i:s', $max = 'now'),
        'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now') . ' ' . $faker->time($format = 'H:i:s', $max = 'now'),
];
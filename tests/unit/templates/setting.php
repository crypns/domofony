<?php
return [
        'number_phone_1' => $faker->phoneNumber,
        'number_phone_2' => $faker->phoneNumber,
        'address' => $faker->address,
        'email' => $faker->email,
        'bot_token' => null,
        'chat_id' => $faker->numberBetween(1, 10),
        'public_key' => null,
        'private_key' => null,
        'youtube_link' => null,
        'facebook_link' => null,
        'instagram_link' => null,
        'created_at' => $faker->date($format = 'Y-m-d', $max = 'now') . ' ' . $faker->time($format = 'H:i:s', $max = 'now'),
        'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now') . ' ' . $faker->time($format = 'H:i:s', $max = 'now'),
];
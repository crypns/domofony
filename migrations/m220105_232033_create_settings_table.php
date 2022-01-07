<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%settings}}`.
 */
class m220105_232033_create_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $timestampColumns = require __DIR__ . DIRECTORY_SEPARATOR . '_migration_timestamp_columns.php';

        $this->createTable('{{%settings}}', array_merge([
            'id' => $this->primaryKey(),
            'number_phone_1' => $this->string()->defaultValue(null)->comment('Номер телефона 1'),
            'number_phone_2' => $this->string()->defaultValue(null)->comment('Номер телефона 2'),
            'address' => $this->string()->defaultValue(null)->comment('Адрес'),
            'email' => $this->string()->defaultValue(null)->comment('Почта'),
            'bot_token' => $this->string()->defaultValue(null)->comment('Telegram token bot'),
            'chat_id' => $this->string()->defaultValue(null)->comment('Telegram chat id'),
            'public_key' => $this->string()->defaultValue(null)->comment('Public key liqpay'),
            'private_key' => $this->string()->defaultValue(null)->comment('Private key liqpay'),
            'youtube_link' => $this->string()->defaultValue(null)->comment('Youtube link'),
            'facebook_link' => $this->string()->defaultValue(null)->comment('Facebook link'),
            'instagram_link' => $this->string()->defaultValue(null)->comment('Instagram link'),
        ],$timestampColumns));

        $this->insert('settings', [
            'number_phone_1' => '+38 044 344 65 14',
            'number_phone_2' => '+38 067 829 60 20',
            'address' => '04209 Київ, вул. Героїв Дніпра, 18',
            'email' => 'info@domofony.ua',
            'bot_token' => '5040707194:AAFhxoJaIu3syh6__OmLmghaM3gdzjIeeaw',
            'chat_id' => '469111794',
            'public_key' => 'sandbox_i92749472824',
            'private_key' => 'sandbox_vly1EuFgkoSewqeATw4pl9fNtWZOJpCIqAIaHD8M',
            'youtube_link' => 'https://www.youtube.com/user/domofonycomua',
            'facebook_link' => 'https://www.facebook.com/domofony.com.ua',
            'instagram_link' => 'https://www.instagram.com/domofony.com.ua/',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('settings', ['id' => 1]);
        $this->dropTable('{{%settings}}');
    }
}

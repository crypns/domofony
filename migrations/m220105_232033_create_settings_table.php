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
            'number_phone_1' => $this->string()->defaultValue('+38 044 344 65 14')->comment('Номер телефона 1'),
            'number_phone_2' => $this->string()->defaultValue('+38 067 829 60 20')->comment('Номер телефона 2'),
            'address' => $this->string()->defaultValue('04209 Київ, вул. Героїв Дніпра, 18')->comment('Адрес'),
            'email' => $this->string()->defaultValue('info@domofony.ua')->comment('Почта'),
            'bot_token' => $this->string()->defaultValue('5040707194:AAFhxoJaIu3syh6__OmLmghaM3gdzjIeeaw')->comment('Telegram token bot'),
            'chat_id' => $this->string()->defaultValue('469111794')->comment('Telegram chat id'),
            'public_key' => $this->string()->defaultValue('sandbox_i92749472824')->comment('Public key liqpay'),
            'private_key' => $this->string()->defaultValue('sandbox_vly1EuFgkoSewqeATw4pl9fNtWZOJpCIqAIaHD8M')->comment('Private key liqpay'),
            'youtube_link' => $this->string()->defaultValue('https://www.youtube.com/user/domofonycomua')->comment('Youtube link'),
            'facebook_link' => $this->string()->defaultValue('https://www.facebook.com/domofony.com.ua')->comment('Facebook link'),
            'instagram_link' => $this->string()->defaultValue('https://www.instagram.com/domofony.com.ua/')->comment('Instagram link'),
        ],$timestampColumns));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}

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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}

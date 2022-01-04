<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%youtube_sliders}}`.
 */
class m211213_120408_create_youtube_sliders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $timestampColumns = require __DIR__ . DIRECTORY_SEPARATOR . '_migration_timestamp_columns.php';

        $this->createTable('{{%youtube_sliders}}', array_merge([
            'id' => $this->primaryKey(),
            'name' => $this->string()->defaultValue(null)->comment('Название видео'),
            'youtube_link' => $this->string()->notNull()->comment('Ссылка на видео ютуб'),
        ],$timestampColumns));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%youtube_sliders}}');
    }
}

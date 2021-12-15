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
        $this->createTable('{{%youtube_sliders}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->defaultValue(null)->comment('Название видео'),
            'youtube_link' => $this->string()->notNull()->comment('Ссылка на видео ютуб'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%youtube_sliders}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apartment_complexes}}`.
 */
class m211213_120654_create_apartment_complexes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $timestampColumns = require __DIR__ . DIRECTORY_SEPARATOR . '_migration_timestamp_columns.php';

        $this->createTable('{{%apartment_complexes}}', array_merge([
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->comment('Название ЖК'),
            'address' => $this->string()->notNull()->comment('Адрес ЖК'),
            'description' => $this->string(1000)->notNull()->comment('Описание ЖК'),
        ], $timestampColumns));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apartment_complexes}}');
    }
}

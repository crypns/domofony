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
        $this->createTable('{{%apartment_complexes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->comment('Название ЖК'),
            'address' => $this->string()->notNull()->comment('Адрес ЖК'),
            'description' => $this->string()->notNull()->comment('Описание ЖК'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apartment_complexes}}');
    }
}

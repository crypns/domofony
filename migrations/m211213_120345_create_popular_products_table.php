<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%popular_products}}`.
 */
class m211213_120345_create_popular_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $timestampColumns = require __DIR__ . DIRECTORY_SEPARATOR . '_migration_timestamp_columns.php';

        $this->createTable('{{%popular_products}}', array_merge([
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название товара'),
            'product_code' => $this->string()->notNull()->comment('Код товара'),
            'description' => $this->string()->notNull()->comment('Описание товара'),
            'image' => $this->string()->notNull()->comment('Изображение товара'),
            'product_link' => $this->string()->comment('Ссылка на продукт'),
        ], $timestampColumns));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%popular_products}}');
    }
}

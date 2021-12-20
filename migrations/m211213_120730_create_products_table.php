<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m211213_120730_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $timestampColumns = require __DIR__ . DIRECTORY_SEPARATOR . '_migration_timestamp_columns.php';

        $this->createTable('{{%products}}', array_merge([
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название продукта'),
            'category_id' => $this->integer()->notNull()->comment('Название категории'),
            'image' => $this->string()->notNull()->comment('Изображение'),
        ], $timestampColumns));
        $this->addForeignKey(
            'FK-products_category_id-categories_id',
            'products',
            'category_id',
            'categories',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-products_category_id-categories_id',
            'products'
        );
        $this->dropTable('{{%products}}');
    }
}

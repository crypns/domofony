<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart_products}}`.
 */
class m211213_120937_create_cart_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $timestampColumns = require __DIR__ . DIRECTORY_SEPARATOR . '_migration_timestamp_columns.php';

        $this->createTable('{{%cart_products}}', array_merge([
            'id' => $this->primaryKey(),
            'cart_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull()->comment('Название товара'),
            'count' => $this->integer()->notNull()->comment('Количество товара'),
        ], $timestampColumns));
        $this->addForeignKey(
            'FK-cart_products_cart_id-carts_id',
            'cart_products',
            'cart_id',
            'carts',
            'id'
        );
        $this->addForeignKey(
            'FK-cart_products_product_id-complex_products_id',
            'cart_products',
            'product_id',
            'complex_products',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-cart_products_cart_id-carts_id',
            'cart_products'
        );
        $this->dropForeignKey(
            'FK-cart_products_product_id-complex_products_id',
            'cart_products'
        );
        $this->dropTable('{{%cart_products}}');
    }
}

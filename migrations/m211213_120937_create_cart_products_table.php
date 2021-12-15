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
        $this->createTable('{{%cart_products}}', [
            'id' => $this->primaryKey(),
            'cart_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull()->comment('Название товара'),
            'count' => $this->integer()->notNull()->comment('Количество товара'),
        ]);
        $this->addForeignKey(
            'FK-cart_products_cart_id-carts_id',
            'cart_products',
            'cart_id',
            'carts',
            'id'
        );
        $this->addForeignKey(
            'FK-cart_products_product_id-products_id',
            'cart_products',
            'product_id',
            'products',
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
            'FK-cart_products_product_id-products_id',
            'cart_products'
        );
        $this->dropTable('{{%cart_products}}');
    }
}

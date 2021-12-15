<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%complex_products}}`.
 */
class m211213_120903_create_complex_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%complex_products}}', [
            'id' => $this->primaryKey(),
            'complex_id' => $this->integer()->notNull()->comment('Название ЖК'),
            'product_id' => $this->integer()->notNull()->comment('Название товара'),
            'count' => $this->integer()->notNull()->comment('Количество товара'),
            'cost' => $this->integer()->notNull()->comment('Стоимость товара'),
        ]);
        $this->addForeignKey(
            'FK-complex_products_complex_id-apartment_complexes_id',
            'complex_products',
            'complex_id',
            'apartment_complexes',
            'id'
        );
        $this->addForeignKey(
            'FK-complex_products_product_id-products_id',
            'complex_products',
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
            'FK-complex_products_complex_id-apartment_complexes_id',
            'complex_products'
        );
        $this->dropForeignKey(
            'FK-complex_products_product_id-products_id',
            'complex_products'
        );
        $this->dropTable('{{%complex_products}}');
    }
}

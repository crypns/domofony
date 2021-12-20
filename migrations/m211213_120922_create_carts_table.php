<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%carts}}`.
 */
class m211213_120922_create_carts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $timestampColumns = require __DIR__ . DIRECTORY_SEPARATOR . '_migration_timestamp_columns.php';

        $this->createTable('{{%carts}}', array_merge([
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull()->comment('Название товара'),
            'full_name' => $this->string()->notNull()->comment('ФИО'),
            'phone_number' => $this->string()->notNull()->comment('Номер телефона'),
            'email' => $this->string()->notNull()->comment('Электронная почта'),
            'address' => $this->string()->notNull()->comment('Адрес'),
            'delivery' => $this->string()->notNull()->comment('Способ доставки'),
            'general_cost' => $this->integer()->notNull()->comment('Общая стоимость товара'),
            'general_count' => $this->integer()->notNull()->comment('Общее количество товара'),
            'status_order' => $this->string()->notNull()->comment('Статус заказа'),
        ], $timestampColumns));
        $this->addForeignKey(
            'FK-carts_product_id-products_id',
            'carts',
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
        'FK-carts_product_id-products_id',
        'carts'
    );
        $this->dropTable('{{%carts}}');
    }
}

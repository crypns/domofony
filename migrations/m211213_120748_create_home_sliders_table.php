<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%home_sliders}}`.
 */
class m211213_120748_create_home_sliders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%home_sliders}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Заголовок слайдера'),
            'description' => $this->string()->notNull()->comment('Описание слайдера'),
            'image' => $this->string()->notNull()->comment('Изображение'),
            'product_link' => $this->string()->notNull()->comment('Ссылка на продукт'),
            'complex_id' => $this->integer()->defaultValue(null)->comment('Название ЖК'),
        ]);
        $this->addForeignKey(
            'FK-home_sliders_complex_id-apartment_complexes_id',
            'home_sliders',
            'complex_id',
            'apartment_complexes',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-home_sliders_complex_id-apartment_complexes_id',
            'home_sliders'
        );
        $this->dropTable('{{%home_sliders}}');
    }
}

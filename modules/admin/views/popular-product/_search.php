<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\search\PopularProduct $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="popular-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'GET',
    ]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'name') ?>

		<?= $form->field($model, 'product_code') ?>

		<?= $form->field($model, 'description') ?>

		<?= $form->field($model, 'image') ?>

		<?//= $form->field($model, 'product_link') ?>

		<?//= $form->field($model, 'created_at') ?>

		<?//= $form->field($model, 'updated_at') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

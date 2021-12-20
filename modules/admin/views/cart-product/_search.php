<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\search\CartProduct $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="cart-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'GET',
    ]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'cart_id') ?>

		<?= $form->field($model, 'product_id') ?>

		<?= $form->field($model, 'count') ?>

		<?= $form->field($model, 'created_at') ?>

		<?//= $form->field($model, 'updated_at') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

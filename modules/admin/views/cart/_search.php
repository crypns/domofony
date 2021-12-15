<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\search\Cart $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="cart-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'GET',
    ]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'product_id') ?>

		<?= $form->field($model, 'full_name') ?>

		<?= $form->field($model, 'phone_number') ?>

		<?= $form->field($model, 'email') ?>

		<?//= $form->field($model, 'address') ?>

		<?//= $form->field($model, 'delivery') ?>

		<?//= $form->field($model, 'general_cost') ?>

		<?//= $form->field($model, 'general_count') ?>

		<?//= $form->field($model, 'status_order') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

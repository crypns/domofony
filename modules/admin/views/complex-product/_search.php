<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\search\ComplexProduct $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="complex-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'GET',
    ]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'complex_id') ?>

		<?= $form->field($model, 'product_id') ?>

		<?= $form->field($model, 'count') ?>

		<?= $form->field($model, 'cost') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

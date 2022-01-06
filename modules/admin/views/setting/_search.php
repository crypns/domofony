<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\search\Setting $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="setting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'GET',
    ]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'number_phone_1') ?>

		<?= $form->field($model, 'number_phone_2') ?>

		<?= $form->field($model, 'address') ?>

		<?= $form->field($model, 'email') ?>

		<?//= $form->field($model, 'bot_token') ?>

		<?//= $form->field($model, 'chat_id') ?>

		<?//= $form->field($model, 'public_key') ?>

		<?//= $form->field($model, 'private_key') ?>

		<?//= $form->field($model, 'youtube_link') ?>

		<?//= $form->field($model, 'facebook_link') ?>

		<?//= $form->field($model, 'instagram_link') ?>

		<?//= $form->field($model, 'created_at') ?>

		<?//= $form->field($model, 'updated_at') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

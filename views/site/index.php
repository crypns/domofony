<?php
use app\widgets\Video;
use app\widgets\Slider;
use app\widgets\Popular;
/* @var $this yii\web\View */

?>
<div class="container">
    <?= Slider::widget(); ?>
</div>
<!----- popular ----->
    <?= Popular::widget(); ?>
<!----- video ----->
    <?= Video::widget(); ?>


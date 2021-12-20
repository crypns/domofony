<?php
use app\widgets\Video;
use app\widgets\Slider;
use app\widgets\Popular;
/* @var $this yii\web\View */
/* @var $sliders array */
/* @var $popular_product array */
/* @var $youtubeSlides array */

?>
<div class="container">
    <?= Slider::widget([
            'models' => $sliders,
    ]); ?>
</div>
<!----- popular ----->
    <?= Popular::widget([
            'populars' => $popular_product,
    ]); ?>
<!----- video ----->
<?= Video::widget([
    'youtube' => $youtubeSlides,
]); ?>


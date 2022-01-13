<?php
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Html;
/* @var $populars array */
/* @var $popular_product \app\models\PopularProduct */

?>
<section class="popular" id="popular">
    <div class="block">
        <h4>Популярні товари</h4>
        <div class="slider">

            <?php foreach ($populars as $popularProduct): ?>
                <div class="item">
                    <div class="img">
                        <img src="<?= $popularProduct->getFilePathByAttribute(); ?>" alt="">
                    </div>
                    <div class="info">
                        <h5><?= $popularProduct->name?></h5>
                        <p class="p2"><?= $popularProduct->product_code?></p>
                        <p class="p1"><?= $popularProduct->description?></p>
                    </div>

                    <?php if ($popularProduct->product_link != null):?>
                    <div class="button">
                        <a href="<?= $popularProduct->product_link?>" target = "_blank">
                            <h6>Детальніше про товар</h6>
                        </a>
                    </div>
                    <?php endif; ?>

                </div>
            <?php endforeach;?>
        </div>
        <div class="arrows"></div>
    </div>
</section>


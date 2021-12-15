<?php
use yii\helpers\Url;

?>
  <section class="success">
    <div class="block">
      <div class="title">
        <div>
            <img src="<?= Yii::getAlias('@web/img/order/mark.svg') ?>" alt="">
        </div>
        <h6>Оплата замовлення пройшла успішно</h6>
      </div>
      <h3>Термін виконання замовлення 3-5 робочих дні.</h3>
      <a href="<?= Url::to(['site/index']);?>">
        <h5>Повернутись на головну</h5>
      </a>
    </div>
  </section>

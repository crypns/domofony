<?php
use app\widgets\Video;
use app\widgets\Slider;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $youtubeSlides array */
/* @var $sliders array */
/* @var $model array */
/* @var $complexProducts array */

?>


<?php //dd( $youtubeSlides[0])  ?>

<div class="order_block df dn" id="order_block">
    <a href="<?= Url::to(['order/index']);?>">
      <h5>Оформити замовлення</h5>
    </a>
    <div class="cart">
      <h5>
        <span>Товарів  </span>
        <span id="productCount">1</span>
      </h5>
      <div>
        <svg width="40" height="36" viewBox="0 0 40 36" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M7.0166 19.1827C7.01446 19.1712 7.01253 19.1596 7.0108 19.1479L4.5706 4.50673C4.32951 3.06019 3.07796 1.99997 1.61147 1.99997H0.999985C0.447708 1.99997 0 1.55226 0 0.999985C0 0.447708 0.447708 0 0.999985 0H1.61147C3.99507 0 6.03796 1.68056 6.51041 3.99994H38.9994C39.6638 3.99994 40.1434 4.63583 39.9609 5.27464L35.961 19.2744C35.8383 19.7037 35.4459 19.9997 34.9995 19.9997H9.18032L9.42918 21.4929C9.67027 22.9394 10.9218 23.9996 12.3883 23.9996H34.9995C35.5517 23.9996 35.9995 24.4473 35.9995 24.9996C35.9995 25.5519 35.5517 25.9996 34.9995 25.9996H12.3883C9.94416 25.9996 7.85824 24.2326 7.45643 21.8217L7.0166 19.1827ZM11.9998 35.9995C9.79071 35.9995 7.99988 34.2086 7.99988 31.9995C7.99988 29.7904 9.79071 27.9996 11.9998 27.9996C14.2089 27.9996 15.9998 29.7904 15.9998 31.9995C15.9998 34.2086 14.2089 35.9995 11.9998 35.9995ZM29.9995 35.9995C27.7904 35.9995 25.9996 34.2086 25.9996 31.9995C25.9996 29.7904 27.7904 27.9996 29.9995 27.9996C32.2086 27.9996 33.9995 29.7904 33.9995 31.9995C33.9995 34.2086 32.2086 35.9995 29.9995 35.9995Z" fill="#ffffff"/>
          <defs>
            <radialGradient id="paint0_radial_873_311" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(35.0909) rotate(127.293) scale(47.5136 30.0435)">
              <stop stop-color="#DA6263"/>
              <stop offset="0.842575" stop-color="#8B1D1E"/>
            </radialGradient>
          </defs>
        </svg>
      </div>
    </div>
  </div>

  <!----- house ----->

  <section class="house">


    <div class="block">
      <div class="address">
        <h1><?= $model->name ?></h1>
        <p class="p1"><?= $model->address ?></p>
      </div>
      <div class="description">
        <p class="p1"><?= $model->description ?></p>
      </div>
    </div>



  </section>

  <!----- banner ----->
<?= Slider::widget([
    'models' => $sliders,
    'layoutClass' => 'banner solitary',
]); ?>



  <!----- goods ----->

  <section class="goods" id="goods">
    <div class="block">
      <div class="head">
        <h6>Товари для ЖК <?= $model->name ?></h6>
        <div class="cart">
          <h5>Товарів <span> 0</span></h5>
          <div>
              <img src="<?= Yii::getAlias('@web/img/house/cart.svg') ?>" alt="">
          </div>
        </div>
      </div>
    <?php foreach ($complexProducts as $complexProduct): ?>
      <div class="item" data-max="<?= $complexProduct->count ?>">
        <div class="object">
          <div class="img">
              <img src="<?= $complexProduct->product->getFilePathByAttribute(); ?>" alt="">
          </div>
          <div class="name">
            <h6><?= $complexProduct->product->name ?></h6>
          </div>
        </div>
        <div class="interaction">
          <div class="counter">
            <div class="action" data-operation="substract" data-price="<?= $complexProduct->cost ?>>
              <svg width="18" height="4" viewBox="0 0 18 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.5 7.43094e-07C17.7761 7.55164e-07 18 0.223858 18 0.500001V3.5C18 3.77614 17.7761 4 17.5 4L0.5 4C0.223858 4 -1.20706e-08 3.77614 0 3.5L1.31134e-07 0.5C1.43205e-07 0.223858 0.223858 -1.20706e-08 0.5 0L17.5 7.43094e-07Z" fill=""/>
              </svg>
            </div>
            <input type="text" value="1">
            <div class="action" data-operation="add" data-max="<?= $complexProduct->count ?>" data-price="<?= $complexProduct->cost ?>>
              <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.5 18C10.7761 18 11 17.7761 11 17.5L11 11H17.5C17.7761 11 18 10.7761 18 10.5V7.5C18 7.22386 17.7761 7 17.5 7L11 7L11 0.5C11 0.223858 10.7761 0 10.5 0H7.5C7.22386 0 7 0.223858 7 0.5L7 7L0.5 7C0.223858 7 0 7.22386 0 7.5V10.5C0 10.7761 0.223858 11 0.5 11H7L7 17.5C7 17.7761 7.22386 18 7.5 18H10.5Z" fill=""/>
              </svg>
            </div>
          </div>
          <div class="price">
            <h4 data-price="<?= $complexProduct->cost ?>"><?= $complexProduct->cost ?> ₴</h4>
          </div>
          <div class="button">
            <button data-id="<?= $complexProduct->id ?>" type="button">
              <h6>Додати до замовлення</h6>
            </button>
          </div>
        </div>
      </div>
        <?php endforeach;?>

    </div>
  </section>
    <!----- video ----->
<?= Video::widget([
    'youtube' => $youtubeSlides,
]); ?>

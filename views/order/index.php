<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\Cart;


/* @var $youtubeSlides array */
/* @var $sliders array */
/* @var $model array */
/* @var $cartProducts array */
/* @var $cartModel array */

?>
<!----- order ----->
<?php $form = ActiveForm::begin([
    'id' => 'Cart',

    'fieldConfig' => [
        'options' => [
            'tag' => false,
        ],
        'template' => "{input}",
    ],
]); ?>

<section class="order" id="order">
    <div class="block">
        <div class="title">
            <div>
                <img src="<?= Yii::getAlias('@web/img/house/cart.svg') ?>" alt="">
            </div>
            <h6>Ваше замовлення</h6>
        </div>

        <?php foreach ($cartProducts as $index => $cartProduct): ?>
            <div class="item">
                <div class="img">
                    <img src="<?= $cartProduct->complexProduct->product->getFilePathByAttribute(); ?>" alt="">
                </div>
                <div class="cont">
                    <div class="name">
                        <h6><?= $cartProduct->complexProduct->product->name ?></h6>
                        <?= $form->field($cartProduct, "[$index]product_id")->hiddenInput([
                            'value' => $cartProduct->complexProduct->id,
                            'class'
                        ]) ?>
                    </div>
                    <div class="counter">
                        <div class="action" data-operation="substract" data-type="orders"
                             data-max="<?= $cartProduct->complexProduct->count ?>"
                             data-cost="<?= $cartProduct->complexProduct->cost ?>">
                            <svg width="18" height="4" viewBox="0 0 18 4" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.5 7.43094e-07C17.7761 7.55164e-07 18 0.223858 18 0.500001V3.5C18 3.77614 17.7761 4 17.5 4L0.5 4C0.223858 4 -1.20706e-08 3.77614 0 3.5L1.31134e-07 0.5C1.43205e-07 0.223858 0.223858 -1.20706e-08 0.5 0L17.5 7.43094e-07Z"
                                      fill=""/>
                            </svg>
                        </div>
                        <input type="hidden" value="0">
                        <?= $form->field($cartProduct, "[$index]count", [
                        ])->textInput(['maxlength' => true, 'class' => 'special']) ?>
                        <div class="action" data-operation="add" data-type="orders"
                             data-max="<?= $cartProduct->complexProduct->count ?>"
                             data-cost="<?= $cartProduct->complexProduct->cost ?>">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.5 18C10.7761 18 11 17.7761 11 17.5L11 11H17.5C17.7761 11 18 10.7761 18 10.5V7.5C18 7.22386 17.7761 7 17.5 7L11 7L11 0.5C11 0.223858 10.7761 0 10.5 0H7.5C7.22386 0 7 0.223858 7 0.5L7 7L0.5 7C0.223858 7 0 7.22386 0 7.5V10.5C0 10.7761 0.223858 11 0.5 11H7L7 17.5C7 17.7761 7.22386 18 7.5 18H10.5Z"
                                      fill=""/>
                            </svg>
                        </div>
                    </div>
                    <div class="price">
                        <h6><?= $cartProduct->complexProduct->cost ?></h6>
                    </div>
                    <div class="delete" data-cost="<?= $cartProduct->complexProduct->cost ?>">
                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 3V15.5C15 16.8807 13.8807 18 12.5 18H3.5C2.11929 18 1 16.8807 1 15.5V3H0.5C0.223858 3 0 2.77614 0 2.5C0 2.22386 0.223858 2 0.5 2H5V1.5C5 0.671573 5.67157 0 6.5 0H9.5C10.3284 0 11 0.671573 11 1.5V2H15.5C15.7761 2 16 2.22386 16 2.5C16 2.77614 15.7761 3 15.5 3H15ZM2 3V15.5C2 16.3284 2.67157 17 3.5 17H12.5C13.3284 17 14 16.3284 14 15.5V3H2ZM10 2V1.5C10 1.22386 9.77614 1 9.5 1H6.5C6.22386 1 6 1.22386 6 1.5V2H10ZM10 6.5C10 6.22386 10.2239 6 10.5 6C10.7761 6 11 6.22386 11 6.5V13.5C11 13.7761 10.7761 14 10.5 14C10.2239 14 10 13.7761 10 13.5V6.5ZM5 6.5C5 6.22386 5.22386 6 5.5 6C5.77614 6 6 6.22386 6 6.5V13.5C6 13.7761 5.77614 14 5.5 14C5.22386 14 5 13.7761 5 13.5V6.5Z"
                                  fill=""/>
                        </svg>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


        <div class="total">
            <h5>Разом:</h5>
            <h5 class="quantity"><?= $cartModel->general_count ?></h5>
            <h5 class="price"><span><?= $cartModel->general_cost ?></span> ₴</h5>
        </div>
    </div>

</section>

<!----- payment ----->

<section class="payment">
    <div class="block">
        <div class="title">
            <div>
                <img src="<?= Yii::getAlias('@web/img/order/payment.svg') ?>" alt="">
            </div>
            <h6>Ваше замовлення</h6>
        </div>
        <form action="">
            <div class="fields">
                <h5>Інформація про покупця</h5>
                <div class="input-list">

                  <div class="row-input">
                    <div class="row-input-item">
                      <?= $form->field($cartModel, 'first_name')
                          ->textInput([
                              'class' => null,
                              'maxlength' => true,
                              'placeholder' => 'Ім’я'
                          ])->label('name') ?>
                    </div>

                    <div class="row-input-item">
                      <?= $form->field($cartModel, 'last_name')
                          ->textInput([
                              'class' => null,
                              'maxlength' => true,
                              'placeholder' => 'Прізвище'
                          ])->label('name') ?>
                    </div>
                  </div>

                  <div class="row-input">
                    <div class="row-input-item">
                      <?= $form->field($cartModel, 'phone_number')->widget(\borales\extensions\phoneInput\PhoneInput::className(), [
                          'jsOptions' => [
                              'class' => 'special',
                              'allowExtensions' => true,
                              'onlyCountries' => ['ua'],
                              'nationalMode' => true,
                              'placeholder' => '(_ _ _) _ _ _ _ _ _ _'
                          ]
                      ]); ?>
                    </div>
                    <div class="row-input-item">
                      <?= $form->field($cartModel, 'email')
                          ->textInput([
                              'class' => null,
                              'maxlength' => true,
                              'placeholder' => 'Електронна пошта'
                          ])
                      ?>
                    </div>
                  </div>

                  <div class="row-input">
                    <div class="row-input-item">
                      <?= $form->field($cartModel, 'street')
                          ->textInput([
                              'class' => null,
                              'maxlength' => true,
                              'placeholder' => 'Вулиця'
                          ])
                      ?>
                    </div>
                    <div class="row-input-item special">
                      <?= $form->field($cartModel, 'apartment')
                          ->textInput([
                              'class' => null,
                              'maxlength' => true,
                              'placeholder' => 'Будинок'
                          ])
                      ?>
                      <?= $form->field($cartModel, 'house')
                          ->textInput([
                              'class' => null,
                              'maxlength' => true,
                              'placeholder' => 'Квартира'
                          ])
                      ?>
                    </div>
                  </div>

                  <div class="row-input">
                    <div class="row-input-item special">
                      <?= $form->field($cartModel, 'apartment')
                          ->textInput([
                              'class' => null,
                              'maxlength' => true,
                              'placeholder' => 'Будинок'
                          ])
                      ?>
                      <?= $form->field($cartModel, 'house')
                          ->textInput([
                              'class' => null,
                              'maxlength' => true,
                              'placeholder' => 'Квартира'
                          ])
                      ?>
                    </div>
                  </div>
                </div>
            </div>

            <div class="delivery" id="delivery">
                <h5>Доставка</h5>
                <label class="radio">
                    <!--            <input type="radio" name="delivery" id="newPost">-->
                    <?= $form->field($cartModel, 'delivery')
                        ->radioList([
                            Cart::DELIVERY_NOVA => 'Нова Пошта (у відділення)',
                            Cart::DELIVERY_COUR => 'Кур’єрам',
                        ])->label(true) ?>
                    <span>
              <!-- <div>
                  <img src="<?= Yii::getAlias('@web/img/order/newPost.svg') ?>" alt="">
              </div> -->
                        <!--              <p class="p1">Нова Пошта (у відділення)</p>-->
                    </span>
                </label>

                <div class="input-list">
                    <div class="row-input">
                      <div class="row-input-item special">
                        <?= $form->field($cartModel, 'code_post')
                            ->textInput([
                                'placeholder' => 'code_post',
                                'class' => null,
                                'maxlength' => true]) ?>
                      </div>
                    </div>
                </div>
            </div>

            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            <!--        </form>-->
            <div class="online">
                <a href="#">
                    <h5>Оплатити замовлення онлайн</h5>
                </a>
                <?php ActiveForm::end(); ?>
                <div class="cards">
                    <div>
                        <img src="<?= Yii::getAlias('@web/img/order/liqpay.svg') ?>" alt="">
                    </div>
                    <div href="#">
                        <img src="<?= Yii::getAlias('@web/img/order/visa.svg') ?>" alt="">
                    </div>
                    <div href="#">
                        <img src="<?= Yii::getAlias('@web/img/order/mastercard.svg') ?>" alt="">
                    </div>
                    <div href="#">
                        <img src="<?= Yii::getAlias('@web/img/order/24.svg') ?>" alt="">
                    </div>
                </div>
            </div>
    </div>
</section>

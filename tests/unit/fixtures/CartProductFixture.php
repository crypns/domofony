<?php
 
namespace tests\unit\fixtures;
 
use yii\test\ActiveFixture;
 
class CartProductFixture extends ActiveFixture
{
    public $modelClass = 'app\models\CartProduct';
    public $dataFile = '@tests/unit/fixtures/data/cart-product.php';

    public $depends = [
        'tests\unit\fixtures\CartFixture',
        'tests\unit\fixtures\ComplexProductFixture',
    ];
}
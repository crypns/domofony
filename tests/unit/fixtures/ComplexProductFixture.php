<?php
 
namespace tests\unit\fixtures;
 
use yii\test\ActiveFixture;
 
class ComplexProductFixture extends ActiveFixture
{
    public $modelClass = 'app\models\ComplexProduct';
    public $dataFile = '@tests/unit/fixtures/data/complex-product.php';

    public $depends = [
        'tests\unit\fixtures\ApartmentComplexFixture',
        'tests\unit\fixtures\ProductFixture',
    ];
}
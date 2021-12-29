<?php
 
namespace tests\unit\fixtures;
 
use yii\test\ActiveFixture;
 
class ApartmentComplexFixture extends ActiveFixture
{
    public $modelClass = 'app\models\ApartmentComplex';
    public $dataFile = '@tests/unit/fixtures/data/apartment-complex.php';

    public $depends = [
    ];
}
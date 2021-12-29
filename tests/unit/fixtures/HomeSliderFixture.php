<?php
 
namespace tests\unit\fixtures;
 
use yii\test\ActiveFixture;
 
class HomeSliderFixture extends ActiveFixture
{
    public $modelClass = 'app\models\HomeSlider';
    public $dataFile = '@tests/unit/fixtures/data/home-slider.php';

    public $depends = [
        'tests\unit\fixtures\ApartmentComplexFixture',
    ];
}
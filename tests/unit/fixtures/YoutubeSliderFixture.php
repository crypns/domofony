<?php
 
namespace tests\unit\fixtures;
 
use yii\test\ActiveFixture;
 
class YoutubeSliderFixture extends ActiveFixture
{
    public $modelClass = 'app\models\YoutubeSlider';
    public $dataFile = '@tests/unit/fixtures/data/youtube-slider.php';

    public $depends = [
    ];
}
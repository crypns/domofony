<?php

namespace app\widgets;

use yii\base\Widget;

class Slider extends Widget
{
    public array $models;
    public string $layoutClass = 'banner';

    public function run()
    {
        return $this->render('slider', [
            'models' => $this->models,
            'layoutClass' => $this->layoutClass,
        ]);
    }
}
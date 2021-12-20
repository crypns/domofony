<?php

namespace app\widgets;

use yii\base\Widget;

class Video extends Widget
{
    public array $youtube;

    public function run()
    {
        return $this->render('video', [
            'youtube' => $this->youtube,
        ]);
    }
}
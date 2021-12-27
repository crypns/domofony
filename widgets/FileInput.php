<?php

namespace app\widgets;

use yii\base\Widget;

class FileInput extends Widget
{
    public $form;
    public $model;
    public $fileAttribute;
    public $multiple;

    public $isAjax;

    public $uploadUrl;
    public $deleteUrl;
    public $allowedFileExtensions;

    public $uploadExtraData;

    public $initialPreview;
    public $initialPreviewConfig;

    public $customOptions;
    public $customPluginOptions;

    public function run()
    {
        $params = [
            'form' => $this->form,
            'model' => $this->model,
            'fileAttribute' => $this->fileAttribute,
            'multiple' => $this->multiple,

            'uploadUrl' => $this->uploadUrl ?: '',
            'deleteUrl' => $this->deleteUrl ?: '',
            'allowedFileExtensions' => $this->allowedFileExtensions,

            'uploadExtraData' => $this->uploadExtraData ?: [],

            'initialPreview' => $this->initialPreview ?: [],
            'initialPreviewConfig' => $this->initialPreviewConfig ?: [],

            'customOptions' => $this->customOptions ?: [],
            'customPluginOptions' => $this->customPluginOptions ?: [],
        ];
        // dd($params);
        return $this->render($this->isAjax ? 'file-input-ajax' : 'file-input', $params);
    }
}
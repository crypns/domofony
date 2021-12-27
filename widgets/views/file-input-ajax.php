<?php

use kartik\file\FileInput;


$attributeName = $fileAttribute . ($multiple ? '[]' : '');

echo $form->field($model, $attributeName)->widget(FileInput::className(), [
// echo FileInput::widget([
    // 'model' => $model,
    // 'attribute' => $attributeName,

    'options' => array_merge([
        'accept' => 'image/*',
        'multiple' => $multiple,
    ], $customOptions),
    'pluginOptions' => array_merge([
        'allowedFileExtensions' => $allowedFileExtensions,

        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig,

        'initialPreviewAsData' => true,

        'overwriteInitial' => false,

        'uploadUrl' => $uploadUrl,
        'deleteUrl' => $deleteUrl,
        'showUpload' => true,

        'uploadExtraData' => $uploadExtraData,

        'language' => explode('-', Yii::$app->language)[0],
        'fileActionSettings' => [
            'showDrag' => false,
        ],
        // 'layoutTemplates'      => [
        // 'actions'   => '<div class="file-actions">' .
        //                '    <div class="file-footer-buttons">' .
        //                '        {upload} {download} {delete} {zoom} {other}' .
        //                '    </div>' .
        //                '    {drag}' .
        //                '    <div class="clearfix"></div>' .
        //                '</div>',
        // ],

        'pluginEvents'  => [
            'filebatchselected' => 'function(event, params) { $(imageLoader).fileinput("upload");  }',
        ]
    ], $customPluginOptions)
]);

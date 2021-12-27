<?php

namespace app\custom;

use Yii;
use yii\helpers\Url;

use app\helpers\WebHelper;
use app\helpers\FileHelper;


class ActiveRecord extends \yii\db\ActiveRecord {

    use TrDefineConstantsChecking;

    /**
     * Save file & delete old one (based on oldAttributes of model)
     *
     * @return bool|null Null if no files to save, but operation done successful
     * @throws yii\base\InvalidConfigException
     */
    public function saveOrUpdateFile()
    {
        $this->checkConstantDefined('FILE_PATH');
        $this->checkConstantDefined('UPLOAD_FILE_ATTRIBUTE');
        $this->checkPropertyIsset(static::FILE_NAME_ATTRIBUTE);

        return FileHelper::saveOrUpdateFile(
            $this,
            static::FILE_PATH,
            static::FILE_NAME_ATTRIBUTE,
            static::UPLOAD_FILE_ATTRIBUTE
        );
    }

    /**
     * Saves model with files
     *
     * @return bool
     * @throws yii\base\InvalidConfigException
     */
    public function saveWithFiles()
    {
        $this->checkConstantDefined('FILE_NAME_ATTRIBUTE');

        $attributes = $this->attributes();
        if (($key = array_search(static::FILE_NAME_ATTRIBUTE, $attributes)) !== false) {
            unset($attributes[$key]);
        }

        if ($this->validate($attributes)) {
            return ($this->saveOrUpdateFile() !== false) && $this->save();
        }
        return false;
    }

    /**
     * Gets the photo full path
     *
     * @param $photoPropertyName str name of model property that containt photo name (by default 'photo')
     *
     * @return string|null Full path of image to display
     * @throws yii\base\InvalidConfigException If model has no FILE_PATH const or given photo property
     */
    public function getFilePathByAttribute(string $attributeName = null)
    {
        $this->checkConstantDefined('FILE_NAME_ATTRIBUTE');
        $photoPropertyName = $attributeName ?: static::FILE_NAME_ATTRIBUTE;
        return $this->getFilePathByUrl($this->$photoPropertyName);
    }

    /**
     * Gets the photo path by url
     *
     * @param $url str
     *
     * @return str|null photo path to display
     * @throws yii\base\InvalidConfigException If model has no FILE_PATH const
     */
    public function getFilePathByUrl(string $url = null)
    {
        $this->checkConstantDefined('FILE_PATH');
        $this->checkConstantDefined('FILE_URL');

        if ($url) {
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                return $url;
            }

            if (is_file(Yii::getAlias(static::FILE_PATH) . $url)) {
                return Yii::getAlias(static::FILE_URL) . $url;
            }
        }
        return null;
    }

    /**
     * Gets the model frontend page url by given seo_url attributeName
     *
     * @param $seoUrl str {desc}
     *
     * @return string Url
     */
    public function getModelFrontendPageUrl(string $attributeName = null)
    {
        $this->checkConstantDefined('FRONTEND_PAGE_URL');
        $this->checkConstantDefined('SEO_URL_ATTRIBUTE_NAME');

        $attributeName = $attributeName ?: static::SEO_URL_ATTRIBUTE_NAME;
        $value = $this->$attributeName;
        return $value ? Url::to(static::FRONTEND_PAGE_URL . $this->$attributeName) : null;
    }

    /**
     * Deleting file of model
     *
     * @return bool
     */
    public function beforeDelete()
    {
        // If model implements interface of file saving
        if ($this instanceof IFileSaving) {
            $this->checkConstantDefined('FILE_NAME_ATTRIBUTE');
            $this->checkConstantDefined('FILE_PATH');
            $fileNameAttribute = static::FILE_NAME_ATTRIBUTE;
            $folderAlias = static::FILE_PATH;

            FileHelper::deleteModelFile($this, $folderAlias, $fileNameAttribute);
        }
        return parent::beforeDelete();
    }

    /**
     * Finds a model
     *
     * @param $id int
     *
     * @return \yii\db\ActiveRecord
     * @throws \yii\web\NotFoundHttpException if model not found
     */
    public static function findModel(int $id)
    {
        $model = self::findOne($id);

        if ($model) {
            return $model;
        }
        throw new \yii\web\NotFoundHttpException();
    }

    /**
     * Saves model if not found dublicates (based on validation of unique columns)
     * or update found model with new attributes
     *
     * @return bool
     */
    public function saveOrUpdate()
    {
        if ($this->validate()) {
            return $this->save();
        } else {
            $notUniqueAttributes = array_keys($this->errors);

            $attributesForFinding = [];
            foreach ($notUniqueAttributes as $attributeName) {
                $attributesForFinding[$attributeName] = $this->$attributeName;
            }

            $oldModel = static::findOne($attributesForFinding);
            if ($oldModel) {
                $attributeList = array_keys($this->attributes);

                foreach ($attributeList as $attributeName) {
                    $oldModel->$attributeName = $this->$attributeName ?: $oldModel->$attributeName;
                }
                return $oldModel->save();
            } else {
                // There is another errors that makes search by attributes not right

                return false;
                // Maybe it worth to throw 404 exception
                // throw new \yii\web\NotFoundHttpException();
            }
        }

        return false;
    }

    /**
     * Additional fiels to display to rest controllers
     * By default adds all related records to return in rest controller
     * Use ModelClass::find()->with() to get related methods
     *
     * @return array $fields
     */
    public function fields()
    {
        $fields = parent::fields();

        $fields['related'] = function () {
            return $this->relatedRecords;
        };

        return $fields;
    }

    /**
     * Finds a with model with given related models
     *
     * @param $attributes array Filter attributes to find model
     * @param $related array Names of relations to get related objects
     *
     * @return \yii\db\ActiveQuery
     */
    public static function findWithRelated(array $attributes, array $related = [])
    {
        return static::find($attributes)
            ->with($related);
    }
}
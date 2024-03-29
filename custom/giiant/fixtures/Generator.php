<?php

namespace app\custom\giiant\fixtures;

use Yii;
use yii\gii\CodeFile;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

class Generator extends \yii\gii\Generator
{
	public $singularEntities;
    public $overwriteFixtures = false;
    public $fixturesAlias = '@tests/unit/fixtures/';
    public $fixturesNamespace = 'tests/unit/fixtures';
    public $modelsNamespace = 'app/models/';

    public $grabData = false;
	public $classNames2;
    public $tableName;
    public $tablePrefix = '';
    public $tables;
	public $controllers;
	public $controllerClass;
    public $db;
    public $tableForeignKeys;

    public $addTables = [
        'users',
    ];
    
    public $ignoreTables = [
        'message',
        'source_message',

        'users',
    ];

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'SeoG Widgets';
    }

    /**
     * @return string the controller ID (without the module ID prefix)
     */
    public function getControllerID()
    {
        $pos = strrpos($this->controllerClass, '\\');
        if ($pos) {
        	$class = substr(substr($this->controllerClass, $pos + 1), 0, -10);
        } else {
        	$class = $this->controllerClass;
        }
        if ($this->singularEntities) {
            $class = Inflector::singularize($class);
        }

        return Inflector::camel2id($class, '-', true);
    }

    private function configureTableArray()
    {
        $this->tables = array_merge($this->tables, $this->addTables);
        
        foreach ($this->ignoreTables as $tableToIgnore) {
            if ($key = array_search($tableToIgnore, $this->tables)) {
                unset($this->tables[$key]);
            }
        }
    }

    private function getRightNamespace(string $wrongNamespace)
    {
        return str_replace('/', '\\', $wrongNamespace);
    }

	public function generate()
	{	
        $files = [];
        $this->configureTableArray();

        foreach ($this->tables as $tableName) {
            $className = $this->generateClassName($tableName);
            $classNameId = Inflector::camel2id($className, '-', true);

            $fixtureClassFile = Yii::getAlias($this->fixturesAlias).$className.'Fixture.php';
            $fixtureDataFile = Yii::getAlias($this->fixturesAlias).'../templates/'.$classNameId.'.php';


            // var_dump(\app\models\CartProduct::class);die;
            $modelFullClass = $this->modelsNamespace . $className;
            $params = [
                'modelFullClass' => $this->getRightNamespace($modelFullClass),
                'dataFileFullPath' => $this->fixturesAlias . 'data/' . $classNameId . '.php',
                'className' => $className,
                'classNameId' => $classNameId,

                'fixturesNamespace' => $this->getRightNamespace($this->fixturesNamespace),

                'items' => $this->getFixtureData($this->getRightNamespace($modelFullClass)),
            ];
            // var_dump(1);die;

            $tableForeignKeys = $this->getDbConnection()->getSchema()
                ->getTableSchema($tableName)
                ->foreignKeys; 

            $dependencies = [];
            foreach ($tableForeignKeys as $fkName => $array) {
                $dependencyTableName = $array[0];
                $nameOfRelationTable = $this->generateClassName($dependencyTableName);

                // var_dump("Table name $tableName");
                // var_dump("dependecy: $dependencyTableName");

                if ($dependencyTableName !== $tableName) {
                    $dependencies[] = $this->getRightNamespace($this->fixturesNamespace) . '\\' . $nameOfRelationTable . 'Fixture';
                }
            }
            $params['dependencies'] = $dependencies;
            
            if ($this->overwriteFixtures || !is_file($fixtureClassFile)) {
                $files[] = new CodeFile($fixtureClassFile, $this->render('fixture-class.php', $params));
            }
            if ($this->overwriteFixtures || !is_file($fixtureDataFile)) {
                $files[] = new CodeFile($fixtureDataFile, $this->render('data-file.php', $params));
            }
        }

        return $files;
	}


    /**
     * Generates a class name from the specified table name.
     *
     * @param string $tableName the table name (which may contain schema prefix)
     *
     * @return string the generated class name
     */
    public function generateClassName($tableName, $useSchemaName = null)
    {

        //Yii::trace("Generating class name for '{$tableName}'...", __METHOD__);
        if (isset($this->classNames2[$tableName])) {
            //Yii::trace("Using '{$this->classNames2[$tableName]}' for '{$tableName}' from classNames2.", __METHOD__);
            return $this->classNames2[$tableName];
        }

        if (isset($this->tableNameMap[$tableName])) {
            Yii::trace("Converted '{$tableName}' from tableNameMap.", __METHOD__);

            return $this->classNames2[$tableName] = $this->tableNameMap[$tableName];
        }

        if (($pos = strrpos($tableName, '.')) !== false) {
            $tableName = substr($tableName, $pos + 1);
        }

        $db = $this->getDbConnection();

        $patterns = [];
        $patterns[] = "/^{$this->tablePrefix}(.*?)$/";
        $patterns[] = "/^(.*?){$this->tablePrefix}$/";
        $patterns[] = "/^{$db->tablePrefix}(.*?)$/";
        $patterns[] = "/^(.*?){$db->tablePrefix}$/";

        if (strpos($this->tableName, '*') !== false) {
            $pattern = $this->tableName;
            if (($pos = strrpos($pattern, '.')) !== false) {
                $pattern = substr($pattern, $pos + 1);
            }
            $patterns[] = '/^'.str_replace('*', '(\w+)', $pattern).'$/';
        }

        $className = $tableName;
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $tableName, $matches)) {
                $className = $matches[1];
                Yii::trace("Mapping '{$tableName}' to '{$className}' from pattern '{$pattern}'.", __METHOD__);
                break;
            }
        }

        $returnName = Inflector::id2camel($className, '_');
        if ($this->singularEntities) {
            $returnName = Inflector::singularize($returnName);
        }

        Yii::trace("Converted '{$tableName}' to '{$returnName}'.", __METHOD__);

        return $this->classNames2[$tableName] = $returnName;
    }

    /**
     * @return \yii\db\Connection the DB connection from the DI container or as application component specified by [[db]]
     */
    protected function getDbConnection()
    {
        return Yii::$app->db;
    }

    /**
     * @return array
     */
    protected function getFixtureData($modelClass)
    {
        /** @var \yii\db\ActiveRecord $modelClass */
        $items = [];
        if ($this->grabData) {
            $orderBy = array_combine($modelClass::primaryKey(), array_fill(0, count($modelClass::primaryKey()), SORT_ASC));
            foreach ($modelClass::find()->orderBy($orderBy)->asArray()->each() as $row) {
                $item = [];
                foreach ($row as $name => $value) {
                    if (is_null($value)) {
                        $encValue = 'null';
                    } elseif (preg_match('/^(0|[1-9-]\d*)$/s', $value)) {
                        $encValue = $value;
                    } else {
                        $encValue = var_export($value, true);;
                    }
                    $item[$name] = $encValue;
                }
                $items[] = $item;
            }
        } else {
            $item = [];
            foreach ($modelClass::getTableSchema()->columns as $column) {
                $fakerOnName = [
                    // 'column_name' => 'faker type',

                    'amount' => '$faker->numberBetween(1, 30)',
                    '_id' => '$faker->numberBetween(1, 10)',

                    'hex' => '$faker->hexcolor',
                    'phone' => '$faker->phoneNumber',
                    'address' => '$faker->address',
                    'comment' => '$faker->sentence(6)',
                    'name' => '$faker->word . $index',
                    'body' => '$faker->sentence(6)',
                    'email' => '$faker->email',
                    'photo' => '$faker->imageUrl()',
                    
                    'created_at' => '$faker->date($format = \'Y-m-d\', $max = \'now\') . \' \' . $faker->time($format = \'H:i:s\', $max = \'now\')',
                    'updated_at' => '$faker->date($format = \'Y-m-d\', $max = \'now\') . \' \' . $faker->time($format = \'H:i:s\', $max = \'now\')',

                    'seo_h1' => '$faker->word',
                    'seo_title' => '$faker->word',
                    'seo_keywords' => '$faker->sentence(6)',
                    'seo_description' => '$faker->paragraph(3)',
                ];

                $fakerOnType = [
                    // 'column_type' => 'faker type',

                    'boolean' => '$faker->boolean',
                ];

                $columnGotValue = false;
                foreach ($fakerOnName as $columnName => $value) {
                    if (preg_match("/$columnName/ui", $column->name)) {
                        $columnGotValue = true;
                        $item[$column->name] = $value;
                    }
                }

                if (!$columnGotValue) {
                    if (isset($fakerOnType[$column->type])) {
                        $item[$column->name] = $fakerOnType[$column->type];
                    
                    } elseif ($column->defaultValue) {
                        $item[$column->name] = $column->defaultValue;
                    } else {
                        $item[$column->name] = $column->allowNull ? 'null' : '\'\'';
                    }
                }

                unset($item['id']);
            }
            $items[] = $item;
        }
        return $items;
    }
}
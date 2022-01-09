<?php

use yii\db\Migration;

class m220105_233800_settings_rbac extends Migration
{
    /**
     * @var array controller all actions
     */
    public $permisions = [
        'index' => [
            'name' => 'app_setting_index',
            'description' => 'app/setting/index'
        ],
        'view' => [
            'name' => 'app_setting_view',
            'description' => 'app/setting/view'
        ],
        'create' => [
            'name' => 'app_setting_create',
            'description' => 'app/setting/create'
        ],
        'update' => [
            'name' => 'app_setting_update',
            'description' => 'app/setting/update'
        ],
        'delete' => [
            'name' => 'app_setting_delete',
            'description' => 'app/setting/delete'
        ]
    ];
    
    /**
     * @var array roles and maping to actions/permisions
     */
    public $roles = [
        'AppSettingFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppSettingView' => [
            'index',
            'view'
        ],
        'AppSettingEdit' => [
            'update',
            'create',
            'delete'
        ]
    ];
    
    public function up()
    {
        $permisions = [];
        $auth = \Yii::$app->authManager;

        /**
         * create permisions for each controller action
         */
        foreach ($this->permisions as $action => $permission) {
            $permisions[$action] = $auth->createPermission($permission['name']);
            $permisions[$action]->description = $permission['description'];
            $auth->add($permisions[$action]);
        }


        $admin = $auth->getRole('admin');
        /**
         *  create roles
         */
        foreach ($this->roles as $roleName => $actions) {
            $role = $auth->createRole($roleName);
            $auth->add($role);

            /**
             * to role assign permissions
             */
            foreach ($actions as $action) {
                $auth->addChild($role, $permisions[$action]);
            }

            /**
             * each role assign to admin's role
             */
            $auth->addChild($admin, $role);
        }
    }

    public function down() {
        $auth = Yii::$app->authManager;

        foreach ($this->roles as $roleName => $actions) {
            $role = $auth->getRole($roleName);
            $auth->remove($role);
        }

        foreach ($this->permisions as $permission) {
            $authItem = $auth->getPermission($permission['name']);
            $auth->remove($authItem);
        }
    }
}

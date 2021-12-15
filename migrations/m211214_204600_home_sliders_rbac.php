<?php

use yii\db\Migration;

class m211214_204600_home_sliders_rbac extends Migration
{
    /**
     * @var array controller all actions
     */
    public $permisions = [
        'index' => [
            'name' => 'app_home-slider_index',
            'description' => 'app/home-slider/index'
        ],
        'view' => [
            'name' => 'app_home-slider_view',
            'description' => 'app/home-slider/view'
        ],
        'create' => [
            'name' => 'app_home-slider_create',
            'description' => 'app/home-slider/create'
        ],
        'update' => [
            'name' => 'app_home-slider_update',
            'description' => 'app/home-slider/update'
        ],
        'delete' => [
            'name' => 'app_home-slider_delete',
            'description' => 'app/home-slider/delete'
        ]
    ];
    
    /**
     * @var array roles and maping to actions/permisions
     */
    public $roles = [
        'AppHomeSliderFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppHomeSliderView' => [
            'index',
            'view'
        ],
        'AppHomeSliderEdit' => [
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

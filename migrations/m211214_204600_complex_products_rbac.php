<?php

use yii\db\Migration;

class m211214_204600_complex_products_rbac extends Migration
{
    /**
     * @var array controller all actions
     */
    public $permisions = [
        'index' => [
            'name' => 'app_complex-product_index',
            'description' => 'app/complex-product/index'
        ],
        'view' => [
            'name' => 'app_complex-product_view',
            'description' => 'app/complex-product/view'
        ],
        'create' => [
            'name' => 'app_complex-product_create',
            'description' => 'app/complex-product/create'
        ],
        'update' => [
            'name' => 'app_complex-product_update',
            'description' => 'app/complex-product/update'
        ],
        'delete' => [
            'name' => 'app_complex-product_delete',
            'description' => 'app/complex-product/delete'
        ]
    ];
    
    /**
     * @var array roles and maping to actions/permisions
     */
    public $roles = [
        'AppComplexProductFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppComplexProductView' => [
            'index',
            'view'
        ],
        'AppComplexProductEdit' => [
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

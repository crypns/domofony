<?php

use yii\db\Migration;

class m211212_230600_apartment_complexes_rbac extends Migration
{
    /**
     * @var array controller all actions
     */
    public $permisions = [
        'index' => [
            'name' => 'app_apartment-complex_index',
            'description' => 'app/apartment-complex/index'
        ],
        'view' => [
            'name' => 'app_apartment-complex_view',
            'description' => 'app/apartment-complex/view'
        ],
        'create' => [
            'name' => 'app_apartment-complex_create',
            'description' => 'app/apartment-complex/create'
        ],
        'update' => [
            'name' => 'app_apartment-complex_update',
            'description' => 'app/apartment-complex/update'
        ],
        'delete' => [
            'name' => 'app_apartment-complex_delete',
            'description' => 'app/apartment-complex/delete'
        ]
    ];
    
    /**
     * @var array roles and maping to actions/permisions
     */
    public $roles = [
        'AppApartmentComplexFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppApartmentComplexView' => [
            'index',
            'view'
        ],
        'AppApartmentComplexEdit' => [
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

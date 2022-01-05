<?php

use yii\db\Migration;

class m211214_204600_source_message_rbac extends Migration
{
    /**
     * @var array controller all actions
     */
    public $permisions = [
        'index' => [
            'name' => 'app_source-message_index',
            'description' => 'app/source-message/index'
        ],
        'view' => [
            'name' => 'app_source-message_view',
            'description' => 'app/source-message/view'
        ],
        'create' => [
            'name' => 'app_source-message_create',
            'description' => 'app/source-message/create'
        ],
        'update' => [
            'name' => 'app_source-message_update',
            'description' => 'app/source-message/update'
        ],
        'delete' => [
            'name' => 'app_source-message_delete',
            'description' => 'app/source-message/delete'
        ]
    ];
    
    /**
     * @var array roles and maping to actions/permisions
     */
    public $roles = [
        'AppSourceMessageFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppSourceMessageView' => [
            'index',
            'view'
        ],
        'AppSourceMessageEdit' => [
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

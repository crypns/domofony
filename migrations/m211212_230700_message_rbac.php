<?php

use yii\db\Migration;

class m211212_230700_message_rbac extends Migration
{
    /**
     * @var array controller all actions
     */
    public $permisions = [
        'index' => [
            'name' => 'app_message_index',
            'description' => 'app/message/index'
        ],
        'view' => [
            'name' => 'app_message_view',
            'description' => 'app/message/view'
        ],
        'create' => [
            'name' => 'app_message_create',
            'description' => 'app/message/create'
        ],
        'update' => [
            'name' => 'app_message_update',
            'description' => 'app/message/update'
        ],
        'delete' => [
            'name' => 'app_message_delete',
            'description' => 'app/message/delete'
        ]
    ];
    
    /**
     * @var array roles and maping to actions/permisions
     */
    public $roles = [
        'AppMessageFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppMessageView' => [
            'index',
            'view'
        ],
        'AppMessageEdit' => [
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

<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\rbac\rules\GroupRule;



/**
 * RBAC console controller.
 */
class RbacController extends Controller
{

    /**
     * Initial RBAC action
     * @param integer $id Superadmin ID
     */
    public function actionInit($id = null)
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        // Rules
        $groupRule = new GroupRule();

        $auth->add($groupRule);

        // Roles
        $user = $auth->createRole('user');
        $user->description = 'User';
        $user->ruleName = $groupRule->name;
        $auth->add($user);

        $moder = $auth->createRole('moder');
        $moder->description = 'moder';
        $moder->ruleName = $groupRule->name;
        $auth->add($moder);
        $auth->addChild($moder, $user);

        $admin = $auth->createRole('admin');
        $admin->description = 'admin';
        $admin->ruleName = $groupRule->name;
        $auth->add($admin);
        $auth->addChild($admin, $moder);

        // Superadmin assignments
        // if ($id !== null) {
        //     $auth->assign($admin, $id);
        // }


        ###############  Разрешение изменения своей записи ########################
        $rule = new \app\rbac\rules\OwnerRule;
        $auth->add($rule);

        $isOwner = $auth->createPermission('isOwner');
        $isOwner->description = 'Update Owner';
        $isOwner->ruleName = $rule->name;
        $auth->add($isOwner);
        // разрешаем "юзеру" 
        $auth->addChild($user, $isOwner);

        
        ##############  Разрешаем создавать комментарий #################     
        $createComment = $auth->createPermission('createComment');
        $createComment->description = 'Создание комментария';
        $auth->add($createComment);
        $auth->addChild($user, $createComment);
    }
}

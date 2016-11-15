<?php
namespace app\rbac\rules;
 
use yii\rbac\Rule;
use yii\rbac\Item;
 
class OwnerRule extends Rule
{
    public $name = 'isOwner';
 
 
    public function execute($user_id, $item, $params)
    {
        if (\Yii::$app->user->identity->role == 'admin') 
            return true;

        return isset($params['model']) ? $params['model']->user_id == $user_id : false;
    }
}
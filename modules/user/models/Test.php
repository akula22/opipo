<?php
namespace app\modules\user\models;

use Yii;
use yii\base\Model;
use app\modules\user\models\User;


/**
 * Signup form
 */
class Test extends Model
{
    public $avatar;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           ['avatar','file','extensions'=> ['jpg']],

          
        ];
    }

    public function attributeLabels()
    {
        return [
            'avatar' => 'Аватар'
        ];
    }

   
}

<?php

namespace app\modules\user\models;

use Yii;
use vova07\fileapi\behaviors\UploadBehavior;

/**
 * This is the model class for table "profile".
 *
 * @property string $firstname
 * @property string $lastname
 * @property string $avatar
 */
class Profile extends \yii\db\ActiveRecord
{
    const GENDER = 0;
    const GENDER_MALE   = 2;
    const GENDER_FEMALE = 1;

    public $new_password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    public function attributeLabels()
    {
        return [
            'firstname' => Yii::t('main', 'Firstname'),
            'lastname' => Yii::t('main', 'Lastname'),
            'avatar' => Yii::t('main', 'Avatar'),
            'gender' => Yii::t('main', 'Gender'),
            'country' => Yii::t('main', 'Country'),
        ];
    }

    public function rules()
    {
        return [
            ['firstname', 'string', 'min' => 2, 'max' => 255],
            ['lastname', 'string', 'min' => 2, 'max' => 255],
            ['gender', 'default', 'value' => 0],
            [['gender', 'country'], 'integer'],

            
        ];
    }

    public function behaviors()
    {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'avatar' => [
                        'path' => '@app/public_html/upload/images/avatar',
                        'tempPath' => '@app/public_html/upload/tmp',
                    ]
                ]
            ]
        ];
    }

  
    public static function getGenderArray()
    {
        return [
            self::GENDER => '',
            self::GENDER_MALE   => Yii::t('main', 'Male'),
            self::GENDER_FEMALE => Yii::t('main', 'Female')
        ];
    }
    public function getGenderName()
    {
        $gender = self::getGenderArray();
        return $gender[$this->gender];
    }

    public function getAvatar($default = null)
    {
        return $this->avatar_path
            ? Yii::getAlias($this->avatar_base_url . '/' . $this->avatar_path)
            : $default;
    }

}

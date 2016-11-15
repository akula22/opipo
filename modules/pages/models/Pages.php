<?php

namespace app\modules\pages\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $alias
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $short
 * @property string $full
 */
class Pages extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ]
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'full'], 'required'],
            [['full'], 'string'],
            ['alias', 'string', 'max' => 200],
            ['alias', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/', 'message' => 'Только латинские символы.'],
            ['alias', 'unique', 'message' => 'Такая страница уже есть.'],
            [['title', 'keywords'], 'string', 'max' => 200],
            [['description'], 'string', 'max' => 200],
            [['lang'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Ссылка(alias)',
            'title' => 'Название',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'full' => 'Содержание страницы',
            'created_at' => 'Создано',
        ];
    }


    public function beforeSave($insert)
    {
        if(empty($this->description))
            $this->description = \app\components\Helper::create_descr($this->title, $this->full);

        if(empty($this->keywords))
            $this->keywords = \app\components\Helper::create_keywords($this->title, $this->full);
        
        return parent::beforeSave($insert);
    }
}

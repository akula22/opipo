<?php

namespace app\modules\pages\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pages\models\Pages;

/**
 * UserSearch represents the model behind the search form about `app\modules\user\models\User`.
 */
class SearchPages extends Pages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['id', 'title', 'alias','created_at', 'lang'], 'safe'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pages::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'lang' => $this->lang,
            'FROM_UNIXTIME(created_at, "%d.%m.%Y")' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'alias', $this->alias]);
        return $dataProvider;
    }
}

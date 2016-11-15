<?php

namespace app\modules\paper\models; 

use Yii; 
use yii\base\Model; 
use yii\data\ActiveDataProvider; 
use app\modules\paper\models\Paper; 

/** 
 * PosSearch represents the model behind the search form about `app\modules\post\models\Post`. 
 */ 
class PaperSearch extends Paper 
{ 
    /** 
     * @inheritdoc 
     */ 
    public function rules() 
    { 
        return [ 
            [['id', 'price', 'percent', 'position'], 'integer'],
            [['title', 'price', 'percent', 'width', 'height'], 'safe'], 
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
        $query = Paper::find(); 

        // add conditions that should always apply here 

        $dataProvider = new ActiveDataProvider([ 
            'query' => $query, 
            'sort'=> ['defaultOrder' => ['position'=>'']],
            // 'sort'=> ['defaultOrder' => ['position'=>SORT_ASC]],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]); 

        $this->load($params); 

        if (!$this->validate()) { 
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1'); 
            return $dataProvider; 
        } 

        // grid filtering conditions 
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'percent' => $this->percent,
            'width' => $this->width,
            'height' => $this->height
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);
           

        return $dataProvider; 
    } 
} 
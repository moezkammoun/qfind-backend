<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CategoriesMaster;

/**
 * CategoriesMasterSearch represents the model behind the search form about `backend\models\CategoriesMaster`.
 */
class CategoriesMasterSearch extends CategoriesMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'parent_id', 'status'], 'integer'],
            [['name', 'name_arabic', 'canonical_name', 'image', 'leval'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = CategoriesMaster::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'leval' => $this->leval,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'name_arabic', $this->name_arabic])
                ->andFilterWhere(['like', 'canonical_name', $this->canonical_name])
                ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }

}

<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServiceProvider;

/**
 * ServiceProviderSearch represents the model behind the search form about `common\models\ServiceProvider`.
 */
class ServiceProviderSearch extends ServiceProvider {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'city', 'cb', 'ub', 'status'], 'integer'],
            [['name', 'image', 'name_arabic', 'locality_arabic', 'category_id', 'website', 'email', 'phone', 'locality', 'longitude', 'latitude', 'working_time_from', 'working_time_to', 'facebook', 'linkedin', 'instagram', 'twitter', 'snapchat', 'googleplus', 'doc', 'dou'], 'safe'],
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
        $query = ServiceProvider::find();

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
            'city' => $this->city,
            'working_time_from' => $this->working_time_from,
            'working_time_to' => $this->working_time_to,
            'cb' => $this->cb,
            'ub' => $this->ub,
            'doc' => $this->doc,
            'dou' => $this->dou,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'name_arabic', $this->name_arabic])
                ->andFilterWhere(['like', 'category_id', $this->category_id])
                ->andFilterWhere(['like', 'image', $this->image])
                ->andFilterWhere(['like', 'website', $this->website])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'phone', $this->phone])
                ->andFilterWhere(['like', 'locality', $this->locality])
                ->andFilterWhere(['like', 'locality_arabic', $this->locality_arabic])
                ->andFilterWhere(['like', 'longitude', $this->longitude])
                ->andFilterWhere(['like', 'latitude', $this->latitude])
                ->andFilterWhere(['like', 'facebook', $this->facebook])
                ->andFilterWhere(['like', 'linkedin', $this->linkedin])
                ->andFilterWhere(['like', 'instagram', $this->instagram])
                ->andFilterWhere(['like', 'twitter', $this->twitter])
                ->andFilterWhere(['like', 'snapchat', $this->snapchat])
                ->andFilterWhere(['like', 'googleplus', $this->googleplus]);

        return $dataProvider;
    }

}

<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AdminRoles;

/**
 * AdminRolesSearch represents the model behind the search form about `common\models\AdminRoles`.
 */
class AdminRolesSearch extends AdminRoles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cb', 'ub', 'category_access', 'advt_access', 'cms_access'], 'integer'],
            [['role_name', 'doc', 'dou'], 'safe'],
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
        $query = AdminRoles::find();

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
            'cb' => $this->cb,
            'ub' => $this->ub,
            'doc' => $this->doc,
            'dou' => $this->dou,
            'category_access' => $this->category_access,
            'advt_access' => $this->advt_access,
            'cms_access' => $this->cms_access,
        ]);

        $query->andFilterWhere(['like', 'role_name', $this->role_name]);

        return $dataProvider;
    }
}

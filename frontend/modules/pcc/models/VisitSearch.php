<?php

namespace frontend\modules\pcc\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pcc\models\Visit;

/**
 * VisitSearch represents the model behind the search form about `frontend\modules\pcc\models\Visit`.
 */
class VisitSearch extends Visit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'person_id'], 'integer'],
            [['date_visit', 'hight', 'sbp', 'dbp', 'note', 'created_by', 'update_by', 'created_at', 'update_at'], 'safe'],
            [['wight'], 'number'],
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
        $query = Visit::find();

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
            'person_id' => $this->person_id,
            'date_visit' => $this->date_visit,
            'wight' => $this->wight,
            'hight' => $this->hight,
        ]);

        $query->andFilterWhere(['like', 'hight', $this->hight])
            //->andFilterWhere(['like', 'sbp', $this->sbp])
            //->andFilterWhere(['like', 'dbp', $this->dbp])
            ->andFilterWhere(['like', 'concat(spb,dbp)', $this->sbp])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'update_at', $this->update_at]);

        return $dataProvider;
    }
}

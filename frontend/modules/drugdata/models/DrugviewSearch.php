<?php

namespace frontend\modules\drugdata\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\drugdata\models\Drugdata;

/**
 * DrugdataSearch represents the model behind the search form about `frontend\modules\drugdata\models\Drugdata`.
 */
class DrugviewSearch extends Drugdata
{
//public $cardid,$pcucode,$daterecord,$hn,$cardid,$pttitle,$ptfname,$ptlname;
//public $ptsex,$ptdob,$ptaddress,$ptvillage,$pttambon,$ptamphur,$ptprovince;
//public $ptphone,$listname,$listsign,$descrip,$pharmacist,$fullname,$hosname];

	function __construct($cardid){ 
        $this->cardid = $cardid;
    }
	
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['pcucode', 'daterecord', 'hn', 'cardid', 'pttitle', 'ptfname', 'ptlname'
				, 'ptsex', 'ptdob', 'ptaddress', 'ptvillage', 'pttambon', 'ptamphur', 'ptprovince'
				, 'ptphone', 'listname', 'listsign', 'descrip', 'pharmacist','fullname','hosname'], 'safe'],
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
        //$query = Drugdata::find()->where(['cardid'=>$this->cardid])->all();
		$query = Drugdata::find();
		//$query->joinWith('hospital')

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
            'cardid' => $this->cardid
        ]);

        $query->andFilterWhere(['like', 'pcucode', $this->pcucode])
				->orFilterWhere(['like', 'c_hospital.hoscode', $this->pcucode])
            ->andFilterWhere(['like', 'hn', $this->hn])
            ->andFilterWhere(['like', 'cardid', $this->cardid])
            ->andFilterWhere(['like', 'pttitle', $this->pttitle])
				->orFilterWhere(['like', 'ptfname', $this->ptfname])
				->orFilterWhere(['like', 'ptlname', $this->ptfname])
            ->andFilterWhere(['like', 'ptsex', $this->ptsex])
            ->andFilterWhere(['like', 'ptaddress', $this->ptaddress])
            ->andFilterWhere(['like', 'ptvillage', $this->ptvillage])
            ->andFilterWhere(['like', 'pttambon', $this->pttambon])
            ->andFilterWhere(['like', 'ptamphur', $this->ptamphur])
            ->andFilterWhere(['like', 'ptprovince', $this->ptprovince])
            ->andFilterWhere(['like', 'ptphone', $this->ptphone])
            ->andFilterWhere(['like', 'listname', $this->listname])
            ->andFilterWhere(['like', 'listsign', $this->listsign])
            ->andFilterWhere(['like', 'descrip', $this->descrip])
            ->andFilterWhere(['like', 'pharmacist', $this->pharmacist]);
				//->orFilterWhere(['like', 'fullname', $this->fullname])
				//->orFilterWhere(['like', 'ptfname', $this->fullname])
				//->orFilterWhere(['like', 'ptlname', $this->fullname]);
        return $dataProvider;
    }
}

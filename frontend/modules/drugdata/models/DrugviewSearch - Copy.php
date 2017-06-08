<?php

namespace frontend\modules\drugdata\models;

use Yii;
use yii\base\Model;
use yii2mod\query\ArrayQuery;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use frontend\modules\drugdata\models\Drugdata;

class DrugviewSearch extends Drugdata
{
	public $cardid;
	
	function __construct($cardid){ 
        $this->cardid = $cardid;
    }

	public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pcucode' => 'รหัสสถานบริการ',
            'daterecord' => 'วันที่บันทึก',
            'hn' => 'Hn',
            'cardid' => 'เลขบัตร ปชช',
            'pttitle' => 'Pttitle',
            'ptfname' => 'Ptfname',
            'ptlname' => 'Ptlname',
			//'fullname' => Yii::t('app', 'ชื่อ-นามสกุล'),
			'fullname' => 'ชื่อ-นามสกุล',
            'ptsex' => 'เพศ',
            'ptdob' => 'วันที่แพ้',
            'ptaddress' => 'ที่อยู่',
            'ptvillage' => 'หมู่บ้าน',
            'pttambon' => 'ตำบล',
            'ptamphur' => 'อำเภอ',
            'ptprovince' => 'จังหวัด',
            'ptphone' => 'เบอร์โทร',
            'listname' => 'สิ่งที่แพ้',
            'listsign' => 'อาการแพ้',
            'descrip' => 'รายละเอียด',
            'pharmacist' => 'ผู้บันทึก',
        ];
    }
	
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['pcucode', 'daterecord', 'hn', 'cardid', 'pttitle', 'ptfname', 'ptlname'
				, 'ptsex', 'ptdob', 'ptaddress', 'ptvillage', 'pttambon', 'ptamphur', 'ptprovince'
				, 'ptphone', 'listname', 'listsign', 'descrip', 'pharmacist','fullname','hosname'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

	
	
    public function search($params)
    {
		/*$sql = " SELECT * from drugdata where cardid = '$this->cardid' ";
        $models = \Yii::$app->db->createCommand($sql)->queryAll();
        $query = new ArrayQuery();
        $query->from($models);
		*/
		
        $query = Drugdata::find()->where(['cardid'=>$this->cardid]);
		
        if ($this->load($params) && $this->validate()) {
			$query->andFilterWhere([
				'id' => $this->id,
				'daterecord' => $this->daterecord,
				'ptdob' => $this->ptdob,
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
		}
        $all_models = $query->all();        
        
        if (!empty($all_models[0])) {
            $cols = array_keys($all_models[0]);
        }
        return new ArrayDataProvider([
            'allModels' => $all_models,
            //'totalItems'=>100,
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
            'pagination' => [
                'pageSize' => 25
            ]
        ]);
    }
}

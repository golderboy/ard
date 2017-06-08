<?php
namespace frontend\modules\drugdata\models;

use yii\base\Model;
use yii2mod\query\ArrayQuery;
use yii\data\ArrayDataProvider;

class Rpt1Search extends Model {
    public $hoscode,$hosname,$pcucode,$a; 
    public $date1,$date2;
    
    function __construct($date1,$date2,$pcucode){ 
        $this->date1 = $date1;
        $this->date2 = $date2;
		$this->pcucode = $pcucode;
    }
    public function attributeLabels() {
        return [
            'hoscode' => 'รหัสหน่วยบริการ',
            'hosname' => 'หน่วยบริการ',
            'a'=>'จำนวนผู้แก้ยา'
        ];
    }
    public function rules() {
        return [
            [['hoscode','hosname','a'], 'safe']
        ];
    }
    public function search($params = null) {
        $sql = " SELECT d.pcucode as 'hoscode',h.hosname,count(cardid) as 'a'
					from drugdata d
					LEFT OUTER JOIN c_hospital h on d.pcucode = h.hoscode 
					WHERE d.pcucode is not null ";
        if($this->date1 and $this->date2){
            $sql.=" AND d.ptdob BETWEEN '$this->date1' AND '$this->date2' ";
			if($this->pcucode){
			$sql.=" AND d.pcucode = '$this->pcucode' ";
			}
        }else if($this->pcucode){
			$sql.=" AND d.pcucode = '$this->pcucode' ";
		}
		
        $sql.=" GROUP BY d.pcucode ";
        
        $models = \Yii::$app->db->createCommand($sql)->queryAll();
        $query = new ArrayQuery();
        $query->from($models);
        
        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', 'hoscode', $this->hoscode]);
            $query->andFilterWhere(['like', 'hosname', $this->hosname]);            
           
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
    }//search
}


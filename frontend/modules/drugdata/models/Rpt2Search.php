<?php
namespace frontend\modules\drugdata\models;

use yii\base\Model;
use yii2mod\query\ArrayQuery;
use yii\data\ArrayDataProvider;

class Rpt2Search extends Model {
    public $daterecord,$ptdob,$hosname; 
    public $cardid,$fullname;
	public $ptsex,$listname,$listsign,$pharmacist;
	public $date1,$date2,$pcucode;
    
    function __construct($date1,$date2,$pcucode){ 
        $this->date1 = $date1;
        $this->date2 = $date2;
		$this->pcucode = $pcucode;
    }
    public function rules()
    {
        return [
            //[['pcucode', 'daterecord', 'hn'], 'required'],
            [['daterecord', 'ptdob'], 'safe'],
            [['pcucode', 'cardid','hosname', 'fullname', 'ptsex', 'listname', 'listsign','pharmacist'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pcucode' => 'รหัสสถานบริการ',
            'daterecord' => 'วันที่บันทึก',
            'hn' => 'Hn',
            'cardid' => 'เลขบัตร ปชช',
			'fullname' => 'ชื่อ-นามสกุล',
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
    public function search($params = null) {
        $sql = " SELECT h.hosname,d.daterecord,d.cardid
				,concat(d.pttitle,' ',d.ptfname,' ',d.ptlname) as fullname
				,if(d.ptsex = 'SX1','ชาย','หญิง')  as ptsex
				,d.ptdob,d.listname,d.listsign,d.pharmacist
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
		
        $sql.=" ORDER BY d.pcucode ";
        
        $models = \Yii::$app->db->createCommand($sql)->queryAll();
        $query = new ArrayQuery();
        $query->from($models);
        
        if ($this->load($params) && $this->validate()) {
			$query->andFilterWhere(['like', 'hosname', $this->hosname]);
            $query->andFilterWhere(['like', 'cardid', $this->cardid]);
            $query->andFilterWhere(['like', 'fullname', $this->fullname]);
            $query->andFilterWhere(['like', 'ptsex', $this->ptsex]);
            $query->andFilterWhere(['like', 'listname', $this->listname]);
            $query->andFilterWhere(['like', 'listsign', $this->listsign]);
            $query->andFilterWhere(['like', 'pharmacist', $this->pharmacist]);            
           
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


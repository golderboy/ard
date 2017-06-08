<?php

namespace frontend\modules\drugdata\models;

use Yii;
use frontend\modules\drugdata\models\Province;
use frontend\modules\drugdata\models\Ampur;
use frontend\modules\drugdata\models\Tambon;
use frontend\modules\drugdata\models\Hospital;
/**
 * This is the model class for table "drugdata".
 *
 * @property integer $id
 * @property string $pcucode
 * @property string $daterecord
 * @property string $hn
 * @property string $cardid
 * @property string $pttitle
 * @property string $ptfname
 * @property string $ptlname
 * @property string $ptsex
 * @property string $ptdob
 * @property string $ptaddress
 * @property string $ptvillage
 * @property string $pttambon
 * @property string $ptamphur
 * @property string $ptprovince
 * @property string $ptphone
 * @property string $listname
 * @property string $listsign
 * @property string $descrip
 * @property string $pharmacist
 */
class Drugdata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'drugdata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['pcucode', 'daterecord', 'hn'], 'required'],
            [['daterecord', 'ptdob'], 'safe'],
            [['pcucode','sexname','hn', 'cardid', 'pttitle', 'ptfname', 'ptlname', 'ptsex', 'ptaddress', 'ptvillage', 'pttambon', 'ptamphur', 'ptprovince', 'ptphone', 'listname', 'listsign', 'descrip', 'pharmacist'], 'string', 'max' => 255],
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
            'pttitle' => 'Pttitle',
            'ptfname' => 'Ptfname',
            'ptlname' => 'Ptlname',
			//'fullname' => Yii::t('app', 'ชื่อ-นามสกุล'),
			'fullname' => 'ชื่อ-นามสกุล',
            //'ptsex' => 'เพศ',
			'sexname' => 'เพศ',
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
	
	public function getFullname(){
        return $this->pttitle .$this->ptfname. " " .$this->ptlname;
    }

	public function getTmpcode(){
        return $this->ptprovince.''.$this->ptamphur.''.$this->pttambon;
    }
	
	public function getProv() {
        return $this->hasOne(Province::className(), ['changwatcode' => 'ptprovince']);
    }
	public function getAmpcode(){
        return $this->ptprovince.$this->ptamphur;
    }
    public function getAmpur() {
        return $this->hasOne(Ampur::className(), ['ampurcodefull' => $this->ampcode]);
    }

    public function getTambon() {
        return $this->hasOne(Tambon::className(), ['tamboncodefull' => $this->tmpcode]);
    }
	
	public function getHospital() {
        return $this->hasOne(Hospital::className(), ['hoscode' => 'pcucode']);
    }
	
	public function getHosname() {
        return $this->hospital->hosname;
    }
	
	public function getSexname() {
		if($this->ptsex == "SX1"){ 
			$sexname = "ชาย";
		}else if($this->ptsex == "SX2"){ 
			$sexname = "หญิง"; 
		}
			return $sexname;
    }

}

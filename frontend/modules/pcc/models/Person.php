<?php

namespace frontend\modules\pcc\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use frontend\modules\pcc\models\Province;
use frontend\modules\pcc\models\Ampur;
use frontend\modules\pcc\models\Tambon;
/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property string $prename
 * @property string $name
 * @property string $lname
 * @property string $birth
 * @property integer $age
 * @property string $addr
 * @property string $moo
 * @property string $prov_code
 * @property string $amp_code
 * @property string $tmb_code
 * @property string $lat
 * @property string $lon
 * @property string $rapid
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birth'], 'safe'],
            [['age'], 'integer'],
            [['prename', 'name', 'lname', 'addr', 'moo', 'prov_code', 'amp_code', 'tmb_code', 'lat', 'lon', 'rapid', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prename' => 'คำนำ',
            'name' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'birth' => 'วันเกิด',
            'age' => 'อายุ',
            'addr' => 'ที่อยู่',
            'moo' => 'หมู่',
            'prov_code' => 'จังหวัด',
            'amp_code' => 'อำเภอ',
            'tmb_code' => 'ตำบล',
            'lat' => 'ละติจูด',
            'lon' => 'ลองติจูด',
            'rapid' => 'ความเร่งด่วน',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors() {
        return[
            [
              'class' => BlameableBehavior::className(),
              'createdByAttribute' => 'created_by',
              'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()')
            ]
        ];
    }

    public function getProv() {
        return $this->hasOne(Province::className(), ['changwatcode' => 'prov_code']);
    }

    public function getAmpur() {
        return $this->hasOne(Ampur::className(), ['ampurcodefull' => 'amp_code']);
    }

    public function getTambon() {
        return $this->hasOne(Tambon::className(), ['tamboncodefull' => 'tmb_code']);
    }

    public function getFullname() {
        return $this->prename." ".$this->name." ".$this->lname;
    }
}

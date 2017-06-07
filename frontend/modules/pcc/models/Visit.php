<?php

namespace frontend\modules\pcc\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "tb_visit".
 *
 * @property integer $id
 * @property integer $person_id
 * @property string $date_visit
 * @property string $weighi
 * @property string $hight
 * @property string $sbp
 * @property string $dbp
 * @property string $note
 * @property string $created_by
 * @property string $update_by
 * @property string $created_at
 * @property string $update_at
 */
class Visit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_visit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'date_visit', 'wight', 'hight'], 'required'],
            [['person_id'], 'integer'],
            [['date_visit'], 'safe'],
            [['wight'], 'number'],
            [['note'], 'string'],
            [['hight', 'sbp', 'dbp'], 'string', 'max' => 3],
            [['created_by'], 'string', 'max' => 255],
            [['update_by', 'created_at', 'update_at'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_id' => 'ชื่อผู้ป่วย',
            'date_visit' => 'วันที่เยี่ยม',
            'wight' => 'น้ำหนัก',
            'hight' => 'ส่วนสูง',
            'sbp' => 'Sbp',
            'dbp' => 'Dbp',
            'note' => 'Note',
            'created_by' => 'Created By',
            'update_by' => 'Update By',
            'created_at' => 'Created At',
            'update_at' => 'Update At',
        ];
    }
    public function behaviors() {
        return[
            [
              'class' => BlameableBehavior::className(),
              'createdByAttribute' => 'created_by',
              'updatedByAttribute' => 'update_by',
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'update_at',
                'value' => new Expression('NOW()')
            ]
        ];
    }

    public function getPersons($pid) {
        return $this->hasOne(Person::className(), ['id' => $pid]);
    }
}

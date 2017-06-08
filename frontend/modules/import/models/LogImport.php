<?php

namespace frontend\modules\import\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "log_import".
 *
 * @property integer $id
 * @property string $file_name
 * @property integer $records
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class LogImport extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'log_import';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            
            [['records'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['file_name', 'created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'file_name' => 'ชื่อไฟล์',
            'records' => 'จำนวนที่นำเข้า',
            'created_by' => 'ผู้นำเข้า',
            'updated_by' => 'Updated By',
            'created_at' => 'วันที่นำเข้า',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors() {
        return [
            ['class' => BlameableBehavior::className()],
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression("NOW()")
            ]
        ];
    }
	
	public function getUsers() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
	

}

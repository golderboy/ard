<?php

namespace frontend\modules\drugdata\models;

use Yii;

/**
 * This is the model class for table "c_village".
 *
 * @property string $villagecode
 * @property string $villagename
 * @property string $villagecodefull
 * @property string $tamboncode
 * @property string $ampurcode
 * @property string $changwatcode
 * @property string $flag_status
 */
class Village extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c_village';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['villagecode', 'villagecodefull', 'tamboncode', 'ampurcode', 'changwatcode'], 'required'],
            [['villagecode', 'changwatcode'], 'string', 'max' => 2],
            [['villagename'], 'string', 'max' => 255],
            [['villagecodefull'], 'string', 'max' => 8],
            [['tamboncode'], 'string', 'max' => 6],
            [['ampurcode'], 'string', 'max' => 4],
            [['flag_status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'villagecode' => 'Villagecode',
            'villagename' => 'Villagename',
            'villagecodefull' => 'Villagecodefull',
            'tamboncode' => 'Tamboncode',
            'ampurcode' => 'Ampurcode',
            'changwatcode' => 'Changwatcode',
            'flag_status' => 'Flag Status',
        ];
    }
}

<?php

namespace frontend\modules\import\models;

use Yii;

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
            [['pcucode', 'hn', 'cardid', 'pttitle', 'ptfname', 'ptlname', 'ptsex', 'ptaddress', 'ptvillage', 'pttambon', 'ptamphur', 'ptprovince', 'ptphone', 'listname', 'listsign', 'descrip', 'pharmacist'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pcucode' => 'Pcucode',
            'daterecord' => 'Daterecord',
            'hn' => 'Hn',
            'cardid' => 'Cardid',
            'pttitle' => 'Pttitle',
            'ptfname' => 'Ptfname',
            'ptlname' => 'Ptlname',
            'ptsex' => 'Ptsex',
            'ptdob' => 'Ptdob',
            'ptaddress' => 'Ptaddress',
            'ptvillage' => 'Ptvillage',
            'pttambon' => 'Pttambon',
            'ptamphur' => 'Ptamphur',
            'ptprovince' => 'Ptprovince',
            'ptphone' => 'Ptphone',
            'listname' => 'Listname',
            'listsign' => 'Listsign',
            'descrip' => 'Descrip',
            'pharmacist' => 'Pharmacist',
        ];
    }
}

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\drugdata\models\Drugdata */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลการแพ้ยา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drugdata-view">
    <p>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'pcucode',
            'daterecord',
            'hn',
            'cardid',
			[
			'attribute' => 'ptfname',
			'label' => 'ชื่อ-สกุล',
			'value' => function($model){
				return  $model->pttitle." ".$model->ptfname." ".$model->ptlname 
				;},
			],
            //'pttitle',
            //'ptfname',
            //'ptlname',
            'sexname',
            'ptdob',
			
			[
            'attribute' =>'ptaddress',
			'label' => 'ที่อยู่',
			'value' => function($model){
				return  $model->ptaddress
						." หมู่ที่ ".$model->ptvillage
							
			;},
			],
            [
            'attribute' =>'ptvillage',
			'label' => 'VHID',
			'value' => function($model){
			$model->ptprovince.$model->ptamphur.$model->ptprovince	
			;},
			],
            //'pttambon',
            //'ptamphur',
            //'ptprovince',
            'ptphone',
            'listname',
            'listsign',
            'descrip',
            'pharmacist',
        ],
    ]) ?>

</div>

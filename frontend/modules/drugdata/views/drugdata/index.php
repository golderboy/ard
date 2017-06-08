<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\drugdata\models\DrugdataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลผู้แพ้ยา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drugdata-index">

    

    <p>
        <?= Html::a('นำเข้า Excel', ['/import/excel/index'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'panel' => [ 'befor' => ''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'pcucode',
			[
			'attribute' => 'pcucode',
			'label' => 'สถานบริการ',
			'value' => function($model){return  $model->hosname ;},
			],
            'daterecord',
            //'hn',
            //'cardid',
			[
			'attribute'=>'cardid',
			'format'=>'Html',
			'value' => function($model){
			  return Html::a('<i class="glyphicon glyphicon-search"></i> '.$model->cardid,
					  ['/drugdata/drugdata/drugview','cardid'=>$model->cardid]
					);
			},
			],
			//'fullname',
			[
			'attribute' => 'ptfname',
			'label' => 'ชื่อ-สกุล',
			'value' => function($model){
				return  $model->pttitle." ".$model->ptfname." ".$model->ptlname 
				;},
			],
            // 'pttitle',
            // 'ptfname',
            // 'ptlname',
            // 'ptsex',
            // 'ptdob',
            // 'ptaddress',
            // 'ptvillage',
            // 'pttambon',
            // 'ptamphur',
            // 'ptprovince',
            // 'ptphone',
             'listname',
             'listsign',
             //'descrip',
             'pharmacist',

            ['class' => 'yii\grid\ActionColumn','template' => ' {view}',],
        ],
    ]); ?>
</div>


<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = $model->cardid ;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลการแพ้ยา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $model,
		'panel' => [ 'befor' => 'ข้อมูลการแพ้ยา'],
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
			//'fullname',
			[
			'attribute' => 'ptfname',
			'label' => 'ชื่อ-สกุล',
			'value' => function($model){
				return  $model->pttitle." ".$model->ptfname." ".$model->ptlname 
				;},
			],
            'ptsex',
            'ptdob',
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
    ]); 
?>

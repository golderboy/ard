<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;

$this->title = 'รายงานผู้แพ้ยา';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 
	$form = ActiveForm::begin([
				'method'=>'Get',
				'action'=>Url::to(['/drugdata/report/report1']),
			]);
	echo "<div class='row'>";
		echo "<div class='col col-md-4'>";	
		//echo Html::textInput('date1');
		echo DatePicker::widget([
			'name' => 'date1',
			'value' => $date1,
			'attribute' => 'date1',
			'options' => ['placeholder' => 'ระหว่างวันที่'],
			'pluginOptions' => [
			  'autoclose'=>true,
			  'format' => 'yyyy-m-d',
			  'todayHighlight'=> true,
        ]
      ]);
		echo "</div>";
		echo "<div class='col col-md-4'>";
		//echo Html::textInput('date2')."   ";
		echo DatePicker::widget([
		'name' => 'date2',
        'value' => $date2,
        'attribute' => 'date2',
        'options' => ['placeholder' => 'ถึงวันที่'],
        'pluginOptions' => [
          'autoclose'=>true,
          'format' => 'yyyy-m-d',
          'todayHighlight'=> true,
        ]
      ]);
		echo "</div>";
		echo "<div class='col col-md-4'>";
		//echo<>
		echo Html::submitButton('ประมวลผล',['class'=>'btn btn-info']);
		echo "</div>";
	echo "</div>";
	ActiveForm::end();
	echo "<br>";

?>
<?php
echo GridView::widget([
						'dataProvider' => $dataProvider,
						'filterModel' => $model,
						'panel'=>	[
							'before'=>'ข้อมูลผู้แพ้ยารายสถานบริการ'
						],
						'columns' => [
							['class' => 'yii\grid\SerialColumn'],
							'hoscode',
							'hosname',
							'a',
						],
					]);
?>


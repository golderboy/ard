<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use frontend\modules\pcc\models\Person;
use yii\helpers\Json;
use miloschuman\highcharts\HighchartsAsset;
HighchartsAsset::register($this)->withScripts(['modules/exporting', 'modules/drilldown']);

$m_person = Person::findone($pid);
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pcc\models\VisitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $m_person->fullname;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Visit', ['create','pid'=>$pid], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
      //  ['panel' =>['before'=>''],],
          'panel'=>[
              'before'=>'เยี่ยมบ้าน'
          ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'person_id',
            'date_visit',
            'wight',
            'hight',
            [
              'attribute'=>'sbp',
              'value' => function($model){
                return  $model->sbp."/".$model->dbp;
              },
            ],
            // 'note:ntext',
            // 'created_by',
            // 'update_by',
            // 'created_at',
            // 'update_at',

            [ 'class' => 'yii\grid\ActionColumn',
/*
              'buttons' => [
                    'view' => function ($url, $model) {
                         $url = Url::to(['view','pid'=>$model->person_id,'id'=>$model->id]);
                        return Html::a('<span class="fa fa-eye"></span>', $url, ['title' => 'view']);
                        //['view','pid'=>$model->person_id,'id'=>$model->id],
                  ]
*/
              ]]

              ]); ?>
</div>
<div id="container"></div>
<?php
$raw = $dataProvider->getModels();

$dataX = [];
$dataY = [];
/*
foreach($raw as $value){
  $data[] = [
    'date_visit' => $value->date_visit,
    'wight' => $value->wight
    echo
  ];
}*/
foreach($raw as $value){
  $dataY[] =  ($value->wight)*1;
  $dataS[] =  ($value->sbp)*1;
  $dataD[] =  ($value->dbp)*1;
  $dataX[] =  $value->date_visit;
  //$dataY[] =  (int)($value->wight);
  //$dataY[] =  (float)($value->wight);
}

/*
Array (
[0] => Array ( [date_visit] => 2017-05-03 [wight] => 222 )
[1] => Array ( [date_visit] => 2017-05-18 [wight] => 555 )
)
*/

/*
$data = ArrayHelper::map($raw,'date_visit','wight');
//Array ( [2017-05-03] => 222 [2017-05-18] => 555 )
*/
//print_r($data);
$jsonX = Json_encode($dataX);
$jsonY = Json_encode($dataY);
$jsonS = Json_encode($dataS);
$jsonD = Json_encode($dataD);
$js=<<<JS
Highcharts.chart('container', {

    title: {
        text: 'ผลการคัดกรอง ของ $this->title'
    },

    subtitle: {
        text: 'Source: thesolarfoundation.com'
    },

    xAxis: {
      categories:$jsonX
    },

    yAxis: {
        title: {
            text: 'อัตราการเปลี่ยนแปลงน้ำหนัก'
        },
        min: 0,
        max: 300,
        tickinterval:10,
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    series: [{
        name: 'น้ำหนัก',
        data: $jsonY,
        color: '#1BC305',
      },
      {
          name: 'SBP',
          data: $jsonS,
      },
      {
          name: 'DBP',
          data: $jsonD,
      },
    ]

});
JS;
$this->registerJs($js);
?>

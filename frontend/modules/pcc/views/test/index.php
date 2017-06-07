<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\data\ActiveQuery;
use yii\data\ActiveDataProvider;
use frontend\modules\pcc\models\Person;

  $model = Person::find();


$dataProvider = new ActiveDataProvider([
  'query' => $model,
]);

?>

<div class="pcc-default-index">
<?php
  $this->title = 'Test models';
  $this->params['breadcrumbs'][] = $this->title;
?>
<ul>

    <li class="btn btn-info"><?=Html::a('ไปหน้า Pcc', ['/pcc'])?></li>
    <li class="btn btn-info"><?=Html::a('ไปหน้า Test2 ด้วย ID', ['test/test2','id'=>'1'])?></li>
    <li class="btn btn-info">MENU3</li>
    <li class="btn btn-info"><?=Html::a('ไปหน้า Google', 'https:\\google.com',['target'=>'_bank'])?></li>

</ul>
<?= GridView::widget([
    'dataProvider'=>$dataProvider,
    'panel'=> [
      'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
                'before' => '',
                'showFooter' => true
              ],
        //'filterModel' => $searchModel,
      ]);
?>
</div>

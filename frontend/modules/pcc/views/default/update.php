<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use frontend\modules\pcc\models\Person;

//$model = new Person();
// INSERT
/*
$model->prename = "นาย";
$model->fname   = "aaa";
$model->lname   = "bbb";
$model->save();
*/
// INSERT $DATA Array
/*
$data = [
  'prename' => 'นาย',
  'fname'   => 'ccc',
  'lname'   => 'eee'
  ];
$model->attributes = $data;
$model->save();
*/
// SELECT
$model = Person::find();
$dataProvider = new ActiveDataProvider([
  'query' => $model,
]);

?>

<div class="pcc-default-index">
<?php
  $this->title = 'งาน PCC';
  $this->params['breadcrumbs'][] = $this->title;
?>
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

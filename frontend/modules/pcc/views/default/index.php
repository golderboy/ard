<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\data\ActiveQuery;
use yii\data\ActiveDataProvider;
use frontend\modules\pcc\models\Person;

// INSERT
/*
$model = new Person();
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

// UPDATE
/*
$model = Person::findOne(2);
$model->fname = "cแก้ไขc";
$model->update();
*/

// SELECT
$model = Person::find();
$dataProvider = new ActiveDataProvider([
  'query' => $model,
]);

// DELETE
/*
$model = Person::findOne(2);
$model->delete();
*/
?>

<div class="pcc-default-index">
<?php
  $this->title = 'งาน PCC';
  $this->params['breadcrumbs'][] = $this->title;
?>
<ul>

    <li class="btn btn-info"><?=Html::a('ไปหน้า Test', ['test/index'])?></li>
    <li class="btn btn-info"><?=Html::a('ไปหน้า Test2 ด้วย ID', ['test/test2','id'=>'1'])?></li>
    <li class="btn btn-info">MENU3</li>
    <li class="btn btn-info">MENU4</li>

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

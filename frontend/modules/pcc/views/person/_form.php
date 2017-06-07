<?php
use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use frontend\modules\pcc\models\Province;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pcc\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
  <div class="col-md-2">
  <?php
      $item = ['นาย'=> 'นาย','นาง' => 'นาง','นส.'=> 'นส.'];
  ?>
    <?= $form->field($model, 'prename')->DropDownList($item,[
                                          'option'=>'---เลือก----'
                                          ])
    ?>
  </div>
  <div class="col-md-4">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
  </div>
  <div class="col-md-3">
    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
  </div>
  <div class="col-md-3">
    <?= $form->field($model, 'birth')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'วดป.เกิด...'],
            'language' => 'th',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]) ?>
  </div>
</div>
<div class="row">
  <div class="col-md-9">
    <?= $form->field($model, 'addr')->textInput(['maxlength' => true]) ?>
  </div>
  <div class="col-md-3">
    <?= $form->field($model, 'moo')->textInput(['maxlength' => true]) ?>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <?php
    $array = Province::find()->all();
    $items = ArrayHelper::map($array, 'changwatcode', 'changwatname');
    echo $form->field($model, 'prov_code')->dropDownList($items, ['id' => 'prov_code', 'prompt' => 'เลือก...'])
    ?>
  </div>
  <div class="col-md-4">
      <?php
      echo $form->field($model, 'amp_code')->widget(DepDrop::classname(), [
          'data' => !empty($amp) ? $amp : [],
          'options' => ['id' => 'amp_code'],
          'pluginOptions' => [
              'depends' => ['prov_code'],
              'placeholder' => 'เลือก...',
              'url' => Url::to(['/pcc/default/getamp'])
          ]
      ]);
      ?>
  </div>
  <div class="col-md-4">
    <?php
    echo $form->field($model, 'tmb_code')->widget(DepDrop::classname(), [
        'data' => !empty($tmb) ? $tmb : [],
        'options' => ['id' => 'tmb_code'],
        'pluginOptions' => [
            'depends' => ['amp_code'],
            'placeholder' => 'เลือก...',
            'url' => Url::to(['/pcc/default/gettmb'])
        ]
    ]);
    ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>
  </div>
  <div class="col-md-6">
    <?= $form->field($model, 'lon')->textInput(['maxlength' => true]) ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <?php
        $item = ['Green'=> 'เขียว','Yellow' => 'เหลือง','Red'=> 'แดง'];
        echo $form->field($model, 'rapid')->DropDownList($item,[
                                            'option'=>'---เลือก----'
                                            ])
      ?>
  </div>
</div>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'เพิ่ม' : 'บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>

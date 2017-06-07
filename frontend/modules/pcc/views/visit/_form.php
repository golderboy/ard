<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;
use yii\helpers\Url;

use frontend\modules\visit\models\CTambon;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pcc\models\Visit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visit-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
  <div class="col-md-4">
    <?= $form->field($model, 'date_visit')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'วันที่ให้บริการ.....'],
            'language' => 'th',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]) ?>
  </div>
  <div class="col-md-2">
    <?= $form->field($model, 'wight')->textInput(['maxlength' => true]) ?>
  </div>
  <div class="col-md-2">
    <?= $form->field($model, 'hight')->textInput(['maxlength' => true]) ?>
  </div>
  <div class="col-md-2">
    <?= $form->field($model, 'sbp')->textInput(['maxlength' => true]) ?>
  </div>
  <div class="col-md-2">
    <?= $form->field($model, 'dbp')->textInput(['maxlength' => true]) ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
  </div>
</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\drugdata\models\Drugdata */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="drugdata-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pcucode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'daterecord')->textInput() ?>

    <?= $form->field($model, 'hn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cardid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pttitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ptfname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ptlname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ptsex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ptdob')->textInput() ?>

    <?= $form->field($model, 'ptaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ptvillage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pttambon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ptamphur')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ptprovince')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ptphone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'listname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'listsign')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descrip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pharmacist')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

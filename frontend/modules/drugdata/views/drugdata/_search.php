<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\drugdata\models\DrugdataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="drugdata-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pcucode') ?>

    <?= $form->field($model, 'daterecord') ?>

    <?= $form->field($model, 'hn') ?>

    <?= $form->field($model, 'cardid') ?>

    <?php // echo $form->field($model, 'pttitle') ?>

    <?php // echo $form->field($model, 'ptfname') ?>

    <?php // echo $form->field($model, 'ptlname') ?>

    <?php // echo $form->field($model, 'ptsex') ?>

    <?php // echo $form->field($model, 'ptdob') ?>

    <?php // echo $form->field($model, 'ptaddress') ?>

    <?php // echo $form->field($model, 'ptvillage') ?>

    <?php // echo $form->field($model, 'pttambon') ?>

    <?php // echo $form->field($model, 'ptamphur') ?>

    <?php // echo $form->field($model, 'ptprovince') ?>

    <?php // echo $form->field($model, 'ptphone') ?>

    <?php // echo $form->field($model, 'listname') ?>

    <?php // echo $form->field($model, 'listsign') ?>

    <?php // echo $form->field($model, 'descrip') ?>

    <?php // echo $form->field($model, 'pharmacist') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

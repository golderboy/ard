<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pcc\models\Visit */

$this->title = 'Update Visit: ' . $model->id;
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="visit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
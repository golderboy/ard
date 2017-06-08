<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\drugdata\models\Drugdata */

$this->title = 'Update Drugdata: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Drugdatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="drugdata-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\drugdata\models\Drugdata */

$this->title = 'Create Drugdata';
$this->params['breadcrumbs'][] = ['label' => 'Drugdatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drugdata-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

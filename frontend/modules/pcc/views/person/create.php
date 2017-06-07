<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\pcc\models\Person */

?>
<div class="person-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
<?php
$js=<<<JS
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(loc){
    console.log(loc.coords.latitude);
    $('#person-lat').val(loc.coords.latitude);
    console.log(loc.coords.longitude);
    $('#person-lon').val(loc.coords.longitude);
    });
}
JS;
$this->registerJs($js);
?>

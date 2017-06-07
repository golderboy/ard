<?php

namespace frontend\modules\pcc\controllers;

use yii\web\Controller;
use yii\helpers\Json;

class MapController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}

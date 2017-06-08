<?php

namespace frontend\modules\drugdata\controllers;

use yii\web\Controller;
use yii\data\ArrayDataProvider;
//use common\components\AppController;
use frontend\modules\drugdata\models\Rpt1Search;
use frontend\modules\drugdata\models\Rpt2Search;

class ReportController extends Controller {

	public function actionReport1($date1=Null,$date2=Null,$pcucode=Null ){
		$model = new Rpt1Search($date1,$date2,$pcucode);
		$dataProvider = $model->search(\Yii::$app->request->queryParams);
        return $this->render('/report/report1',[
								'dataProvider'=>$dataProvider,
								'model' => $model,
								'date1' => $date1,
								'date2' => $date2,
								'pcucode'=> $pcucode,
								]
							);
    }
	
	public function actionReport2($date1=Null,$date2=Null,$pcucode=Null ){
		$model = new Rpt2Search($date1,$date2,$pcucode);
		$dataProvider = $model->search(\Yii::$app->request->queryParams);
        return $this->render('/report/report2',[
								'dataProvider'=>$dataProvider,
								'model' => $model,
								'date1' => $date1,
								'date2' => $date2,
								'pcucode'=> $pcucode,
								]
							);
    }
	


}

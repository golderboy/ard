<?php

namespace frontend\modules\import\controllers;

use yii;
use frontend\modules\import\components\Excel;
use frontend\modules\import\models\Drugdata;
use yii\web\Controller;
use frontend\modules\import\models\UploadForm;
use yii\web\UploadedFile;
use frontend\modules\import\models\LogImport;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
/**
 * Default controller for the `import` module
 */
class ExcelController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['pm','admin'],
                    ],
                ],
            ],

        ];
    }
	 
	 
    public function actionIndex() {
        $mUpload = new UploadForm();

        if (\Yii::$app->request->isPost) {
            $mUpload->dataFile = UploadedFile::getInstance($mUpload, 'dataFile');
            if ($mUpload->upload()) {
                $filename = $mUpload->fname;

                $excel = new Excel($filename);
                $array = $excel->toArray();
				$rec = 0;
				if(\Yii::$app->user->identity->id === 1 ){//for admin id = 1
					foreach ($array as $value) {
						$drug = new Drugdata();
						$drug->daterecord = date('d-m-Y', \PHPExcel_Shared_Date::ExcelToPHP($value['daterecord']));
						$drug->ptdob = date('d-m-Y', \PHPExcel_Shared_Date::ExcelToPHP($value['ptdob']));
						$drug->attributes = $value;
						$drug->save(FALSE);
						$rec++;
					}
				}else{
					foreach ($array as $value) {
						if( ($value['pcucode']) == \Yii::$app->user->identity->hoscode ){
							$drug->daterecord = date('d-m-Y', \PHPExcel_Shared_Date::ExcelToPHP($value['daterecord']));
							$drug->ptdob = date('d-m-Y', \PHPExcel_Shared_Date::ExcelToPHP($value['ptdob']));
							$drug = new Drugdata();
							$drug->attributes = $value;
							$drug->save(FALSE);
							$rec++;
						}
					}
				}
					//print_r($array);
					if($rec > 0){
						$log = new LogImport();
						$log->file_name = $mUpload->dataFile->name;
						//$log->records = count($array);
						$log->records = $rec;
						$log->save(FALSE);
						\Yii::$app->session->setFlash('success', "นำเข้าสำเร็จ!!!");
						return $this->redirect(['index']);
					}else{
						\Yii::$app->session->setFlash('danger', "นำเข้าไม่สำเร็จ!!!");
						return $this->redirect(['index']);
					}
				}	
			}
		
        return $this->render('index', ['mUpload' => $mUpload]);
    }

}

<?php

namespace frontend\modules\import\controllers;

use frontend\modules\import\components\Excel;
use frontend\modules\import\models\Drugdata;
use yii\web\Controller;
use frontend\modules\import\models\UploadForm;
use yii\web\UploadedFile;
use frontend\modules\import\models\LogImport;

/**
 * Default controller for the `import` module
 */
class ExcelController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $mUpload = new UploadForm();

        if (\Yii::$app->request->isPost) {
            $mUpload->dataFile = UploadedFile::getInstance($mUpload, 'dataFile');
            if ($mUpload->upload()) {
                // file is uploaded successfully
               // \Yii::$app->session->setFlash('success', "OK");

                $filename = $mUpload->fname;

                $excel = new Excel($filename);
                $array = $excel->toArray();
                foreach ($array as $value) {
                    $drug = new Drugdata();
                    $drug->attributes = $value;
                    $drug->save(FALSE);
                }
                $log = new LogImport();
                $log->file_name = $mUpload->dataFile->name;
                $log->records = count($array);
                $log->save(FALSE);
                \Yii::$app->session->setFlash('success', "นำเข้าสำเร็จ!!!");
                return $this->redirect(['index']);
            }
        }
        return $this->render('index', ['mUpload' => $mUpload]);
    }

}

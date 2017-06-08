<?php

namespace frontend\modules\drugdata\controllers;

use Yii;
use frontend\modules\drugdata\models\Drugdata;
use frontend\modules\drugdata\models\DrugdataSearch;
use frontend\modules\drugdata\models\DrugviewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\data\ArrayDataProvider;

/**
 * DrugdataController implements the CRUD actions for Drugdata model.
 */
class DrugdataController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
			
			'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view','create','update','delete','drugview'],
                'rules' => [
                    [
                        'actions' => ['index','view','drugview'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => false,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['update','delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
			
        ];
    }

    /**
     * Lists all Drugdata models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DrugdataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Drugdata model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Drugdata model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    /*    $model = new Drugdata();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['drugdata/drugdata/index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
	*/
    }

    /**
     * Updates an existing Drugdata model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		/*
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
		*/
    }

    /**
     * Deletes an existing Drugdata model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

	public function actionDrugview($cardid)
    {
		
		$model = new DrugviewSearch($cardid);
		$dataProvider = $model->search(\Yii::$app->request->queryParams);
        return $this->render('drugview',[
								'dataProvider'=>$dataProvider,
								'model' => $model,
								'cardid' => $cardid
								]
							);
    }
	 
 
	 
    protected function findModel($id)
    {
        if (($model = Drugdata::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	

	
}

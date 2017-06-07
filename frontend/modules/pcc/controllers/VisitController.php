<?php

namespace frontend\modules\pcc\controllers;

use Yii;
use frontend\modules\pcc\models\Visit;
use frontend\modules\pcc\models\VisitSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VisitController implements the CRUD actions for Visit model.
 */
class VisitController extends Controller
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
                'only' => ['index', 'view','create','update','delete','bulk-delete'],
                'rules' => [
                    [
                        'actions' => ['index','create'],
                        'allow' => true,
                        'roles' => ['doctor'],
                    ],
                    [
                        'actions' => ['bulk-delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['view','update','delete'],
                        'allow' => true,
                        'roles' => ['doctor'],
                        'matchCallback' => function($rule, $action) {
                    $model = $this->findModel(\Yii::$app->request->get('id'));
                    return \Yii::$app->user->can('accessOwn', ['model' => $model, 'attr' => 'created_by']);
                }
                    ],
                ],
            ],

        ];
    }

    /**
     * Lists all Visit models.
     * @return mixed
     */
    public function actionIndex($pid)
    {
        $searchModel = new VisitSearch();
        $searchModel->person_id=$pid;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pid'=>$pid
        ]);
    }

    /**
     * Displays a single Visit model.
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
     * Creates a new Visit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate($pid)
     {
         $model = new Visit();
         $model->person_id =$pid;
         if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['index', 'pid' => $model->person_id]);
         } else {
             return $this->render('create', [
                 'model' => $model,
                 'pid'=>$pid
             ]);
         }
     }

    /**
     * Updates an existing Visit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['index', 'pid' => $model->person_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'id'=>$id
            ]);
        }
    }

    /**
     * Deletes an existing Visit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index','pid'=>$model->person_id]);
    }

    /**
     * Finds the Visit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Visit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Visit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

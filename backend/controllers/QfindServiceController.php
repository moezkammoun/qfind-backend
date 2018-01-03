<?php

namespace backend\controllers;

use Yii;
use common\models\QfindService;
use common\models\QfindServiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QfindServiceController implements the CRUD actions for QfindService model.
 */
class QfindServiceController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all QfindService models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new QfindServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QfindService model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new QfindService model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new QfindService();

        if ($model->load(Yii::$app->request->post())) {
            $model->doc = date('Y-m-d');
            $model->cb = Yii::$app->user->identity->id;
            $model->ub = Yii::$app->user->identity->id;
            $model->date_from = $_POST['QfindService']['date_from'];
            $model->date_to = $_POST['QfindService']['date_to'];

            if ($model->save()) {
                return $this->redirect(['index']);
            } else {

                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing QfindService model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->doc = date('Y-m-d');
            $model->cb = Yii::$app->user->identity->id;
            $model->ub = Yii::$app->user->identity->id;
            $model->save();
            return $this->redirect(['index']);
        } else {

            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing QfindService model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the QfindService model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QfindService the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = QfindService::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

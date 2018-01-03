<?php

namespace backend\controllers;

use Yii;
use common\models\AdminRoles;
use common\models\AdminRolesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AdminRolesController implements the CRUD actions for AdminRoles model.
 */
class AdminRolesController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $action = [];
        $get_role = AdminRoles::findOne(Yii::$app->user->identity->role);
        if ($get_role->category_access == 1) {
            $action = ['create', 'update', 'view', 'delete', 'index'];
        } else {
            $action = ['noaction'];
        }
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
//                      'actions' => ['create', 'update', 'view', 'delete'],
                        'actions' => $action,
                        'allow' => true,
                        'roles' => [ '@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AdminRoles models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AdminRolesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [

                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminRoles model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdminRoles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new AdminRoles();

        if ($model->load(Yii::$app->request->post())) {
            $model->cb = Yii::$app->user->identity->id;
            $model->ub = Yii::$app->user->identity->id;
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminRoles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
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
     * Deletes an existing AdminRoles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdminRoles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminRoles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AdminRoles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

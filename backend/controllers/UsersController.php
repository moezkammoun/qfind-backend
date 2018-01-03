<?php

namespace backend\controllers;

use Yii;
use common\models\Users;
use common\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $action = [];
        $get_role = \common\models\AdminRoles::findOne(Yii::$app->user->identity->role);
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Users('');
        $model->scenario = 'create';
        if ($model->load(Yii::$app->request->post())) {
            $model->username = $_POST['Users']['username'];
            $model->cb = Yii::$app->user->identity->id;
            $model->ub = Yii::$app->user->identity->id;
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
            $model->generateAuthKey();
            $model->save();


            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $old_pwd = $model->password_hash;
        if ($model->load(Yii::$app->request->post())) {
            $c_password = $_POST['Users']['password_hash'];
            $model->username = $_POST['Users']['username'];
            $model->ub = Yii::$app->user->identity->id;
            if ($c_password == '') {
                $model->password_hash = $old_pwd;
            } else {
                $model->password_hash = Yii::$app->security->generatePasswordHash($_POST['Users']['password_hash']);
                $model->generateAuthKey();
            }
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

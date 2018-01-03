<?php

namespace backend\controllers;

use Yii;
use backend\models\CategoriesMaster;
use common\models\CategoriesMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * CategoriesMasterController implements the CRUD actions for CategoriesMaster model.
 */
class CategoriesMasterController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $action = [];
        $get_role = \common\models\AdminRoles::findOne(Yii::$app->user->identity->role);
        if ($get_role->category_access == 1) {
            $action = ['create', 'update', 'view', 'delete', 'index', 'delimage'];
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
     * Lists all CategoriesMaster models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CategoriesMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoriesMaster model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CategoriesMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new CategoriesMaster();
        $model->scenario = 'create';
        $model->status = 1;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->parent_id == "") {
                $model->parent_id = 0;
            }

            $file1 = UploadedFile::getInstance($model, 'icon');
            if ($file1) {
                $model->icon = $model->canonical_name . '.' . $file1->extension;
            }
            if ($model->parent_id == 0) {
                $model->leval = 1;
            } else {
                $model->leval = 2;
            }
            if ($model->save()) {
                if ($file1) {
                    $model->uploadicon($file1, $model);
                }
                return $this->redirect(['index']);
            } else {
                print_r($model->getErrors());
                exit;
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing CategoriesMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {

        $model = $this->findModel($id);
        $images = $model->icon;
        $can_name = $model->canonical_name;
        if ($model->load(Yii::$app->request->post())) {
            $file1 = UploadedFile::getInstance($model, 'icon');
            if ($file1) {
                $model->icon = $model->canonical_name . '.' . $file1->extension;
            } else if ($model->canonical_name !== $can_name && $images !== "") {

                $img_name = explode(".", $images);
                $model->icon = $model->canonical_name . '.' . $img_name[1];
            } else {

                $model->icon = $images;
            }
            if ($model->parent_id == $model->id) {
                $model->parent_id = 0;
            }
            if ($model->parent_id == 0) {
                $model->leval = 1;
            } else {
                $model->leval = 2;
            }
            if ($model->save(false)) {
                if ($file1) {
                    $model->uploadicon($file1, $model);
                }
                if ($model->canonical_name !== $can_name && $file1 == NULL) {
                    $targetFolder = \yii::$app->basePath . '/../uploads/categories-master/' . $id . '/icon/' . $images;
                    $newname = \yii::$app->basePath . '/../uploads/categories-master/' . $id . '/icon/' . $model->icon;
                    rename($targetFolder, $newname);
                }

                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CategoriesMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CategoriesMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoriesMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = CategoriesMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDelImage($id, $item) {
        $model = $this->findModel($id);
        $folder = Yii::$app->basePath . '/../uploads/categories-master/' . $id . '/thump/';
        $image = $model->image;
        $model->image = "";
        if ($model->save(false)) {

        } else {
            print_r($model->getErrors());
            exit;
        }

        if (is_dir($folder)) {
            $image = $folder . '/' . $image;
            if (!empty($image))
                unlink($image);
        }
        $this->redirect(Yii::$app->request->referrer);
    }

    public function actionArrayCategory() {
        $industries = [];
        $sub = [];
        $i = 0;
        $results = CategoriesMaster::find()->where(['status' => 1])->all();
        foreach ($results as $mainCategory) {

            $sub[$mainCategory->name] = $this->arraySubCat($mainCategory, $mainCategory->name);
        }
        print_r($sub);
    }

    public function arraySubCat($cat, $ret) {

        if ($data = CategoriesMaster::findOne($cat->parent_id)) {
            $ret = $data->name . '->' . $ret;
            $this->arraySubCat($data->parent_id, $ret);
        }

        if ($cat->parent_id == 0) {
            $parent = CategoriesMaster::findOne($data->id);
            $ret = $parent->name . '->' . $ret;
        }

        return $ret;
    }

    public function actionTest() {
        $test = $this->category_tree_array();
        print_r($test);
    }

    public function category_tree_array($cat_id = 0, $level = 0) {
        $categories = array();
        $results = CategoriesMaster::find()->where(['status' => 1, 'parent_id' => $cat_id])->all();
        foreach ($results as $mainCategory) {
            $category = array();
            $prefix = "";
            for ($j = 0; $j < $level; $j++) {
                $prefix .= "-";
            }
            $category['id'] = $mainCategory['id'];
            $category['name'] = $prefix . $mainCategory['name'];
            $category['parent_id'] = $mainCategory['parent_id'];
            $category['level'] = $level;
            $category['sub_categories'] = $this->category_tree_array($category['id'], ($level + 1));
            $categories[$mainCategory['id']] = $category;
        }
//        return $categories;
        return $this->category_tree_master($categories);
    }

//    public function arraySubCat($cat_id = 0, $sub) {
//        $results = CategoriesMaster::find()->where(['status' => 1, 'parent_id' => $cat_id])->all();
//        if (count($results) > 0) {
//            return $subCat = [];
//        } else {
//            $res = CategoriesMaster::findOne($cat_id);
//            if (array_key_exists($res->id, $sub)) {
//                $sub[$res->id] = $sub[$res->id] + ' > ' . $res->name;
//            } else {
//                $subCat['id'] = $res->id;
//                $subCat['name'] = $res->name;
//                $sub['id'] = $res->id;
//                $sub['name'] = $res->name;
//            }
//
//
////            $sub[$res->id] = $sub[$res->id] + ' > ' .
////                    $subCat['id'] = $res->id;
////            $subCat['name'] = $res->name . '> ';
//            return $sub;
//        }
//    }
}

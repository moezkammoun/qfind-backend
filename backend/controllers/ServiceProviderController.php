<?php

namespace backend\controllers;

use Yii;
use common\models\ServiceProvider;
use common\models\ServiceProviderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use common\components\UploadFile;
use yii\filters\AccessControl;
use frostealth\yii2\aws\s3\base\commands\traits\Options;
use frostealth\yii2\aws\s3\interfaces\commands\Command;
use frostealth\yii2\aws\s3\interfaces\commands\HasBucket;

/**
 * ServiceProviderController implements the CRUD actions for ServiceProvider model.
 */
class ServiceProviderController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {

        $action = [];
        $get_role = \common\models\AdminRoles::findOne(Yii::$app->user->identity->role);
        if ($get_role->category_access == 1) {
            $action = ['create', 'update', 'view', 'delete', 'index', 'del-image'];
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
     * Lists all ServiceProvider models.
     * @return mixed
     */
    public function actionIndex() {
        $s3 = Yii::$app->get('s3');
////        $result = $s3->list('1/');
//        $result = $s3->upload('muha mutty.jpg', 'C:/Users/user/Desktop/muha.jpg');
////        exit();
////        $exist = $s3->commands()->exist('2017-12-28.jpg')->execute();
////        $exist = $s3->commands()->exist('\Dslr-Camera-icon.png')->execute();
//        if ($result) {
//            var_dump($result['Contents']);
////            foreach ($result as $key) {
//            foreach ($result['Contents'] as $lm => $kj) {
////                $url = $s3->commands()->getUrl($kj['Key'])->execute();
//                $url = $s3->commands()->getPresignedUrl($kj['Key'], '+2 days')->execute();
//                echo $url;
//            }
////            }
////            echo '<pre>' . var_dump($result);
//        } else {
//            echo '<pre>' . var_dump($result);
//        }
        //$result = $s3->commands()->get('filename.ext')->saveAs('/new.ext')->execute();
        //var_dump($result);
//        exit;
        $searchModel = new ServiceProviderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    's3' => $s3,
        ]);
    }

    /**
     * Displays a single ServiceProvider model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ServiceProvider model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $s3 = Yii::$app->get('s3');
        $model = new ServiceProvider();
        $model->scenario = 'create';
        if ($model->load(Yii::$app->request->post())) {
            $model->cb = Yii::$app->user->identity->id;
            $model->ub = Yii::$app->user->identity->id;
//            $file1 = UploadedFile::getInstance($model, 'image');
            $time_from = $_POST['ServiceProvider']['working_time_from'];
            $time_to = $_POST['ServiceProvider']['working_time_to'];
            $model->working_time_from = date('H:i:s', strtotime($time_from));
            $model->working_time_to = date('H:i:s', strtotime($time_to));
//            $model->status = 1;
            $gallery = UploadedFile::getInstances($model, 'image');
            $model->image = '0';
            $model->latitude = $_POST['ServiceProvider']['latitude'];
            $model->longitude = $_POST['ServiceProvider']['longitude'];
            if ($model->save()) {
                if ($gallery) {
                    foreach ($gallery as $attachment) {
                        $canonical_name = '';
                        $canonical_name = str_replace(' ', '-', $attachment->baseName); // Replaces all spaces with hyphens.
                        $canonical_name = preg_replace('/[^A-Za-z0-9\-]/', '', $canonical_name); // Removes special chars.
                        $image_name = preg_replace('/-+/', '-', $canonical_name); // Replaces multiple hyphens with single one.
                        $image_name_array[] = $image_name . '.' . $attachment->extension;
                        $result = $s3->upload('service-provider/' . $model->id . '/' . $image_name . '.' . $attachment->extension, $attachment->tempName);
//                $images[] = $attachment->name;
                    }
                }

                if ($result) {
                    $model->image = implode(',', $image_name_array);

//                    $model->image = $file1->extension;
                }
                $model->save(false);
//                if ($file1) {
//                    Yii::$app->UploadFile->upload($file1, $model->id, 'service-provider');
//                }
                return $this->redirect(['index']);
            } else {
                var_dump($model->errors);
                exit;
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ServiceProvider model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $s3 = Yii::$app->get('s3');
        $model = $this->findModel($id);
        $image = $model->image;
        $current_image = explode(',', $image);
        if ($model->load(Yii::$app->request->post())) {
            $model->ub = Yii::$app->user->identity->id;
            $gallery = UploadedFile::getInstances($model, 'image');
            $time_from = $_POST['ServiceProvider']['working_time_from'];
            $time_to = $_POST['ServiceProvider']['working_time_to'];
            $model->working_time_from = date('H:i:s', strtotime($time_from));
            $model->working_time_to = date('H:i:s', strtotime($time_to));
            $count_images = explode(',', $image);
//            var_dump(count($count_images));
//            exit;
            $result_cnt = count($count_images) + count($gallery);
            $balance = 5 - count($current_image);
            if ($result_cnt > 5) {
                $model->addError('image', 'You allready uploaded the ' . count($current_image) . ' images. Now only you can upload ' . $balance . ' images Or you can delete exist one.');
            }
            $image_name_array = NULL;
            if ($result_cnt > 5) {

            } else {
                if ($gallery) {
                    foreach ($gallery as $attachment) {
                        $canonical_name = '';
                        $canonical_name = str_replace(' ', '-', $attachment->baseName); // Replaces all spaces with hyphens.
                        $canonical_name = preg_replace('/[^A-Za-z0-9\-]/', '', $canonical_name); // Removes special chars.
                        $image_name = preg_replace('/-+/', '-', $canonical_name); // Replaces multiple hyphens with single one.
                        $image_name_array[] = $image_name . '.' . $attachment->extension;
                        $result = $s3->upload('service-provider/' . $model->id . '/' . $image_name . '.' . $attachment->extension, $attachment->tempName);
                    }
                }
            }


            if ($model->hasErrors()) {
                $model->image = $image;
                return $this->render('update', [
                            'model' => $model,
                ]);
            } else {
                $new_result = array_merge($image_name_array, $current_image);
                if ($result) {
                    $model->image = implode(',', $new_result);
                    // $model->save(false);
                }
                if ($model->save()) {
                    return $this->redirect(['index']);
                }
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ServiceProvider model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ServiceProvider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServiceProvider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ServiceProvider::findOne($id) ) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDelImage($id, $item) {
        $model = $this->findModel($id);
        $s3 = Yii::$app->get('s3');
        $result = $s3->commands()->delete('service-provider/' . $model->id . '/' . $item)->execute();
        $image = $model->image;
        $exp_images = explode(',', $image);
        if (($key = array_search($item, $exp_images)) !== false) {
            unset($exp_images[$key]);
        }
        if ($exp_images != NULL) {
            $model->image = implode(',', $exp_images);
        }

        if ($result) {
            if ($model->save(false)) {

            } else {

            }
        }

        $this->redirect(Yii::$app->request->referrer);
    }

}

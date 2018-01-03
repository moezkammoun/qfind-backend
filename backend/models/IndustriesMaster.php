<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "industries_master".
 *
 * @property integer $id
 * @property string $name
 * @property string $canonical_name
 * @property integer $category_id
 * @property string $status
 */
class IndustriesMaster extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'industries_master';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                    [['name', 'canonical_name', 'status'], 'required'],
                    [['parent_id', 'sort_order', 'status'], 'integer'],
                    [['name', 'canonical_name', 'image', 'icon'], 'string', 'max' => 250],
                    [['icon'], 'safe'],
                    ['canonical_name', 'unique', 'targetAttribute' => ['canonical_name'], 'message' => 'Canonical Name must be unique.'],
                    ['canonical_name', 'match', 'pattern' => '/^[A-Za-z0-9-]+$/'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'name' => 'Name',
                    'canonical_name' => 'Canonical Name',
                    'parent_id' => 'Select Parent',
                    'status' => 'Status',
                    'image' => 'Image',
                    'sort_order' => 'Sort Order',
                ];
        }

//     public function upload($file, $id, $name) {
//
//        $targetFolder = \yii::$app->basePath . '/../uploads/industries-master/' . $id . '/';
//        if (!file_exists($targetFolder)) {
//            mkdir($targetFolder, 0777, true);
//        }
//        if ($file->saveAs($targetFolder . $name )) {
//            return true;
//        } else {
//            return false;
//        }
//    }

        public function upload($file, $model) {
                $targetFolderMain = \yii::$app->basePath . '/../uploads/industries-master/' . $model->id . '/main/';
                $targetFolderCover = \yii::$app->basePath . '/../uploads/industries-master/' . $model->id . '/cover/';
                $targetFolderThump = \yii::$app->basePath . '/../uploads/industries-master/' . $model->id . '/thump/';
                $targetFolderPre = \yii::$app->basePath . '/../uploads/industries-master/' . $model->id . '/premium/';
                if (!file_exists($targetFolderMain)) {
                        mkdir($targetFolderMain, 0777, true);
                }
                if (!file_exists($targetFolderCover)) {
                        mkdir($targetFolderCover, 0777, true);
                }
                if (!file_exists($targetFolderThump)) {
                        mkdir($targetFolderThump, 0777, true);
                }
                if (!file_exists($targetFolderPre)) {
                        mkdir($targetFolderPre, 0777, true);
                }
                $imgtemp = $file->tempName;
                $source_properties = getimagesize($imgtemp);
                $image_type = $file->type;
                if ($image_type == "image/png") {
                        $image_resource_id = imagecreatefrompng($imgtemp);
                        $target_layer = $this->fn_resize($image_resource_id, $source_properties[0], $source_properties[1], 594, 450);
                        $target_layer1 = $this->fn_resize($image_resource_id, $source_properties[0], $source_properties[1], 363, 216);
                        $target_layer_thump = $this->fn_resize($image_resource_id, $source_properties[0], $source_properties[1], 100, 100);
                        if (imagepng($target_layer, $targetFolderMain . $model->canonical_name . '.png')) {
                                imagejpeg($target_layer1, $targetFolderCover . $model->canonical_name . '.png');
                                imagejpeg($target_layer_thump, $targetFolderThump . $model->canonical_name . '.png');
                                return true;
                        } else {
                                return FALSE;
                        }
                } elseif ($image_type == "image/jpeg" || $image_type == "image/jpg") {
                        $image_resource_id = imagecreatefromjpeg($imgtemp);
                        $target_layer = $this->fn_resize($image_resource_id, $source_properties[0], $source_properties[1], 594, 450);
                        $target_layer1 = $this->fn_resize($image_resource_id, $source_properties[0], $source_properties[1], 363, 216);
                        $target_layer_thump = $this->fn_resize($image_resource_id, $source_properties[0], $source_properties[1], 100, 100);
                        $target_layer_pre = $this->fn_resize($image_resource_id, $source_properties[0], $source_properties[1], 666, 285);
                        if (imagejpeg($target_layer, $targetFolderMain . $model->canonical_name . ".jpg")) {
                                imagejpeg($target_layer1, $targetFolderCover . $model->canonical_name . ".jpg");
                                imagejpeg($target_layer_thump, $targetFolderThump . $model->canonical_name . ".jpg");
                                imagejpeg($target_layer_pre, $targetFolderPre . $model->canonical_name . ".jpg");
                                return true;
                        } else {
                                return FALSE;
                        }
                } else {
                        return FALSE;
                }
        }

        public function fn_resize($image_resource_id, $width, $height, $target_width = 200, $target_height = 200) {
                $target_layer = imagecreatetruecolor($target_width, $target_height);
                imagecopyresampled($target_layer, $image_resource_id, 0, 0, 0, 0, $target_width, $target_height, $width, $height);
                return $target_layer;
        }

        public function industrySubTree() {
                $cat = [];
                $categories = IndustriesMaster::find()->where(['status' => 1, 'parent_id' => 0])->all();
                foreach ($categories as $category) {
                        $products = \common\models\Products::find()->where(['industry_id' => $category->id])->count();
                        if ($products == 0) {
                                $cat[$category->id] = $category->name;
                        }
                        $Level1categories = IndustriesMaster::find()->where(['status' => 1, 'parent_id' => $category->id])->all();
                        foreach ($Level1categories as $Level1category) {
                                $products = \common\models\Products::find()->where(['industry_id' => $category->id])->count();
                                if ($products == 0) {
                                        $cat[$Level1category->id] = '-' . $Level1category->name;
                                }
                                $Level2categories = IndustriesMaster::find()->where(['status' => 1, 'parent_id' => $Level1category->id])->all();
                                foreach ($Level2categories as $Level2category) {
                                        $products = \common\models\Products::find()->where(['industry_id' => $Level1category->id])->count();
                                        if ($products == 0) {
                                                $cat[$Level2category->id] = '--' . $Level2category->name;
                                        }
                                        $Level3categories = IndustriesMaster::find()->where(['status' => 1, 'parent_id' => $Level2category->id])->all();
                                        foreach ($Level3categories as $Level3category) {
                                                $products = \common\models\Products::find()->where(['industry_id' => $Level2category->id])->count();
                                                if ($products == 0) {
                                                        $cat[$Level3category->id] = '---' . $Level3category->name;
                                                }
                                                $Level4categories = IndustriesMaster::find()->where(['status' => 1, 'parent_id' => $Level3category->id])->all();
                                                foreach ($Level4categories as $Level4category) {
                                                        $products = \common\models\Products::find()->where(['industry_id' => $Level3category->id])->count();
                                                        if ($products == 0) {
                                                                $cat[$Level4category->id] = '----' . $Level4category->name;
                                                        }
                                                }
                                        }
                                }
                        }
                }

                return $cat;
        }

        public function breadCrump($catid = 0) {
                $bread = [];
                for ($i = $catid; $i !== 0;) {
                        $level = IndustriesMaster::find()->where(['id' => $i])->one();
                        if (!empty($level)) {
                                $bread[$i]['id'] = $level->id;
                                $bread[$i]['name'] = $level->name;
                                $bread[$i]['canonical_name'] = $level->canonical_name;
                                $i = $level->parent_id;
                        }
                }
                return $bread;
        }

}

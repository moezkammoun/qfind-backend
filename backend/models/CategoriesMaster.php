<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "categories_master".
 *
 * @property integer $id
 * @property string $name
 * @property string $canonical_name
 * @property integer $parent_id
 * @property string $image
 * @property integer $status
 * @property integer $leval
 */
class CategoriesMaster extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {

        return 'categories_master';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'status', 'name_arabic'], 'required'],
            [['icon'], 'required', 'on' => 'create'],
            [['parent_id', 'status', 'sort_order'], 'integer'],
            [['name', 'canonical_name', 'image', 'name_arabic'], 'string', 'max' => 250],
            [['icon', 'parent_id', 'leval'], 'safe'],
            ['image', 'image', 'skipOnEmpty' => true, 'minWidth' => 594, 'maxWidth' => 1024, 'minHeight' => 285, 'maxHeight' => 1024, 'extensions' => 'jpg,png,jeg', 'maxSize' => 1024 * 1024 * .2],
            ['icon', 'image', 'skipOnEmpty' => true, 'minWidth' => 16, 'maxWidth' => 1024, 'minHeight' => 16, 'maxHeight' => 1024, 'extensions' => 'jpg,png,jeg', 'maxSize' => 1024 * 1024 * .1],
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
            'name_arabic' => 'Name In Arabic',
            'canonical_name' => 'Canonical Name',
            'parent_id' => 'Select Parent',
            'image' => 'Image',
            'status' => 'Status',
            'sort_order' => 'Sort Order',
            'leval' => 'Leval',
        ];
    }

    public function uploadicon($file, $model) {
        $targetFolderMain = \yii::$app->basePath . '/../uploads/categories-master/' . $model->id . '/icon/';
        if (!file_exists($targetFolderMain)) {
            mkdir($targetFolderMain, 0777, true);
        }
        $imgtemp = $file->tempName;
        $source_properties = getimagesize($imgtemp);
        $image_type = $file->type;
        if ($image_type == "image/png") {
            if ($file->saveAs($targetFolderMain . $model->canonical_name . '.png')) {
                // Image::getImagine()->open($targetFolder . $name . '.' . $file->extension)->save($targetFolder . $name . '.' . $file->extension, ['quality' => 70]);
                return true;
            } else {
                return false;
            }
//            $image_resource_id = imagecreatefrompng($imgtemp);
//            $target_layer = $this->fn_resize($image_resource_id, $source_properties[0], $source_properties[1], 1024, 1024);
//            if (imagepng($target_layer, $targetFolderMain . $model->canonical_name . '.png')) {
//
//
//                return true;
//            } else {
//                return FALSE;
//            }
        } elseif ($image_type == "image/jpeg" || $image_type == "image/jpg") {
            if ($file->saveAs($targetFolderMain . $model->canonical_name . '.jpg')) {
                // Image::getImagine()->open($targetFolder . $name . '.' . $file->extension)->save($targetFolder . $name . '.' . $file->extension, ['quality' => 70]);
                return true;
            } else {
                return false;
            }
//            $image_resource_id = imagecreatefromjpeg($imgtemp);
//            $target_layer = $this->fn_resize($image_resource_id, $source_properties[0], $source_properties[1], 1024, 1024);
//            if (imagejpeg($target_layer, $targetFolderMain . $model->canonical_name . ".jpg")) {
//
//                return true;
//            } else {
//                return FALSE;
//            }
        } else {
            return FALSE;
        }
    }

    public function upload($file, $model) {
        $targetFolderMain = \yii::$app->basePath . '/../uploads/categories-master/' . $model->id . '/main/';
        $targetFolderCover = \yii::$app->basePath . '/../uploads/categories-master/' . $model->id . '/cover/';
        $targetFolderThump = \yii::$app->basePath . '/../uploads/categories-master/' . $model->id . '/thump/';
        $targetFolderPre = \yii::$app->basePath . '/../uploads/categories-master/' . $model->id . '/premium/';
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
        return $categories;
    }

    public function category_tree_array_test($cat_id = 0, $level = 0) {
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

            $category['sub_categories'] = $this->category_tree_array_test($category['id'], ($level + 1));
            $categories[] = $category;
        }

        return $categories;
    }

    public function loadCategory() {
        $cat = [];
        $array = $this->category_tree_array();
        if (!empty($array)) {
            foreach ($array as $arr) {
                if (!empty($arr->sub_categories)) {
                    $sub = $this->SubCats($arr->sub_categories, $arr->name);
                    if (!empty($sub->subCat)) {
                        $sub = $this->SubCats($arr->sub_categories, $arr->name . '->' . $sub->subCat);
                    } else {
                        $cat[$arr->id] = $arr->name . '->' . $arr->name;
                    }
                } else {
                    $cat[$arr->id] = $arr->name;
                }
            }
        }
        print_r($aray);
    }

    public function gpu_cat($parent = 0) {
        $categories = CategoriesMaster::find()->where(['status' => 1, 'parent_id' => $parent])->all();
        foreach ($categories as $category) {
            echo '<option>' . $category->name . '</option>';
            $this->gpu_grandcatchild($category->id, 1);
        }
    }

    public function gpu_grandcatchild($catId, $depth) {
        $categories2 = CategoriesMaster::find()->where(['status' => 1, 'parent_id' => $catId])->all();
        $prefix = "";
        for ($j = 0; $j < $depth; $j++) {
            $prefix .= "-";
        }
        foreach ($categories2 as $category2) {
            echo '<option class ="s' . $depth . '">' . $prefix . $category2->name . '</option>';
            $this->gpu_grandcatchild($category2->id, $depth++);
        }
    }

    ///Looping Category limit 5


    public function categorySubTree() {
        $cat = [];
        $categories = CategoriesMaster::find()->where(['status' => 1, 'parent_id' => 0])->all();
        foreach ($categories as $category) {
//            $products = \common\models\Products::find()->where(['category_id' => $category->id])->count();
//            if ($products == 0) {
//                $cat[$category->id] = $category->name;
//            }
            $cat[$category->id] = $category->name;
//            $Level1categories = CategoriesMaster::find()->where(['status' => 1, 'parent_id' => $category->id])->all();
//            foreach ($Level1categories as $Level1category) {
//                $products = \common\models\Products::find()->where(['category_id' => $category->id])->count();
//                if ($products == 0) {
//                    $cat[$Level1category->id] = '-' . $Level1category->name;
//                }
//                $Level2categories = CategoriesMaster::find()->where(['status' => 1, 'parent_id' => $Level1category->id])->all();
//                foreach ($Level2categories as $Level2category) {
//                    $products = \common\models\Products::find()->where(['category_id' => $Level1category->id])->count();
//                    if ($products == 0) {
//                        $cat[$Level2category->id] = '--' . $Level2category->name;
//                    }
//                    $Level3categories = CategoriesMaster::find()->where(['status' => 1, 'parent_id' => $Level2category->id])->all();
//                    foreach ($Level3categories as $Level3category) {
//                        $products = \common\models\Products::find()->where(['category_id' => $Level2category->id])->count();
//                        if ($products == 0) {
//                            $cat[$Level3category->id] = '---' . $Level3category->name;
//                        }
//                        $Level4categories = CategoriesMaster::find()->where(['status' => 1, 'parent_id' => $Level3category->id])->all();
//                        foreach ($Level4categories as $Level4category) {
//                            $products = \common\models\Products::find()->where(['category_id' => $Level3category->id])->count();
//                            if ($products == 0) {
//                                $cat[$Level4category->id] = '----' . $Level4category->name;
//                            }
//                        }
//                    }
//                }
//            }
        }

        return $cat;
    }

    public function breadCrump($catid = 0) {
        $bread = [];
        for ($i = $catid; $i !== 0;) {
            $level = CategoriesMaster::find()->where(['id' => $i])->one();
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

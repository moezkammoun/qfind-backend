<?php

namespace common\components;

use yii\base\Component;
use Yii;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class UploadFile extends Component {

    public function upload($file, $id, $foldername) {

        $folder = $this->folderName(0, 1000, $id) . '/';
        if (\yii::$app->basePath . '/../uploads') {
            chmod(\yii::$app->basePath . '/../uploads', 0777);

            if (!is_dir(Yii::$app->basePath . '/../uploads/' . $foldername . '/' . $folder))
                mkdir(Yii::$app->basePath . '/../uploads/' . $foldername . '/' . $folder);
            chmod(Yii::$app->basePath . '/../uploads/' . $foldername . '/' . $folder . '/', 0777);

            if (!is_dir(Yii::$app->basePath . '/../uploads/' . $foldername . '/' . $folder . '/' . $id))
                mkdir(Yii::$app->basePath . '/../uploads/' . $foldername . '/' . $folder . '/' . $id);
            chmod(Yii::$app->basePath . '/../uploads/' . $foldername . '/' . $folder . '/' . $id . '/', 0777);

            if ($file->saveAs(\yii::$app->basePath . '/../uploads/' . $foldername . '/' . $folder . '/' . $id . '/' . $id . '.' . $file->extension)) {
                chmod(\yii::$app->basePath . '/../uploads/' . $foldername . '/' . $folder . '/' . $id . '/' . $id . '.' . $file->extension, 0777);
            }
            return true;
        }
    }

    public function uploadMultipleImage($uploadfile, $id, $foldername = false, $dimensions = array()) {

        if ($foldername) {
            $folder = $this->folderName(0, 1000, $id) . '/';
        } else {
            $folder = "";
        }
        foreach ($uploadfile as $upload) {
            if (isset($upload)) {
                if (Yii::$app->basePath . '/../uploads/products') {
                    chmod(Yii::$app->basePath . '/../uploads/products', 0777);
                    if ($foldername) {
                        if (!is_dir(Yii::$app->basePath . '/../uploads/products/' . $folder))
                            mkdir(Yii::$app->basePath . '/../uploads/products/' . $folder);
                        chmod(Yii::$app->basePath . '/../uploads/products/' . $folder . '/', 0777);

                        if (!is_dir(Yii::$app->basePath . '/../uploads/products/' . $folder . '/' . $id))
                            mkdir(Yii::$app->basePath . '/../uploads/products/' . $folder . '/' . $id);
                        chmod(Yii::$app->basePath . '/../uploads/products/' . $folder . '/' . $id . '/', 0777);

                        if (!is_dir(Yii::$app->basePath . '/../uploads/products/' . $folder . '/' . $id . '/gallery/'))
                            mkdir(Yii::$app->basePath . '/../uploads/products/' . $folder . '/' . $id . '/gallery/');
                        chmod(Yii::$app->basePath . '/../uploads/products/' . $folder . '/' . $id . '/gallery/', 0777);
                    }
                    $path = Yii::$app->basePath . '/../uploads/products/' . $folder . '/' . $id . '/' . '/gallery/';

                    $picname = $this->fileExists($path, $upload->name, $upload, 1);


                    if ($upload->saveAs(Yii::$app->basePath . '/../uploads/products/' . $folder . '/' . $id . '/gallery/' . $picname)) {
                        chmod(Yii::$app->basePath . '/../uploads/products/' . $folder . $id . '/gallery/' . $picname, 0777);
                        // $this->WaterMark(Yii::$app->basePath . '/../uploads/products/' . $folder . $id . '/gallery/' . $picname, '/../images/watermark.png');
                        $file = Yii::$app->basePath . '/../uploads/products/' . $folder . '/' . $id . '/gallery/' . $picname;



                        if (!empty($dimensions)) {



                            foreach ($dimensions as $dimension) {
                                if (!is_dir(Yii::$app->basePath . '/../uploads/products/' . $folder . '/' . $id . '/' . '/gallery/' . $dimension['name']))
                                    mkdir(Yii::$app->basePath . '/../uploads/products/' . $folder . '/' . $id . '/' . '/gallery/' . $dimension['name']);

                                $path = Yii::$app->basePath . '/../uploads/products/' . $folder . '/' . $id . '/' . '/gallery/' . $dimension['name'];

                                $this->ResizeMultiple($file, $dimension['width'], $dimension['height'], $path, $picname);
                            }
                        }
                    }
                }
            }
        }
    }

    public function uploadById($file, $id, $location) {

        $targetFolder = \yii::$app->basePath . '/../uploads/' . $location . '/' . $id . '/';
        if (!file_exists($targetFolder)) {
            mkdir($targetFolder, 0777, true);
        }
        if ($file->saveAs($targetFolder . $id . '.' . $file->extension)) {
            return true;
        } else {
            return false;
        }
    }

    public function uploadByIdAsName($file, $id, $location) {

        $targetFolder = \yii::$app->basePath . '/../uploads/' . $location . '/';
        if (!file_exists($targetFolder)) {
            mkdir($targetFolder, 0777, true);
        }
        if ($file->saveAs($targetFolder . $id . '.' . $file->extension)) {
            return true;
        } else {
            return false;
        }
    }

    public function uploadByFilenameAsName($file, $location, $name) {

        $targetFolder = $location;
        if (!file_exists($targetFolder)) {
            mkdir($targetFolder, 0777, true);
        }

        if ($file->saveAs($targetFolder . $name)) {
            return true;
        } else {
//            return false
            echo '21324';
        }
    }

    public function uploadGallery($files, $location) {
        $targetFolder = \yii::$app->basePath . '/../uploads/' . $location;
        if (!file_exists($targetFolder)) {

            mkdir($targetFolder, 0777, true);
        }
        foreach ($files as $file) {
            $file->saveAs($targetFolder . $file->name);
        }
        return;
    }

    public function removeDirectory($path) {
        $files = glob($path . '/*');
        foreach ($files as $file) {
            is_dir($file) ? $this->removeDirectory($file) : unlink($file);
        }
        rmdir($path);
        return;
    }

    public function folderName($min, $max, $id) {
        if ($id > $min && $id <= $max) {
            return $max;
        } else {
            $xy = $this->folderName($min + 1000, $max + 1000, $id);
            return $xy;
        }
    }

    public function ResizeMultiple($file, $width, $height, $path, $name) {
//                $imagine = new Imagine\Gd\Imagine();
// or
//                $imagine = new Imagine\Imagick\Imagine();
// or
//                $imagine = new Imagine\Gmagick\Imagine();
//                $size = new Imagine\Image\Box($width, $height);
//                $mode = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
// or
//                $mode = Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;

        Image::getImagine()->open($file)
                ->thumbnail(new Box($width, $height))
                ->save($path . '/' . $name);

//                $resize = new EasyImage($file);
//                $resize->resize($width, $height);
//                $resize->save($path . '/' . $name);
    }

}

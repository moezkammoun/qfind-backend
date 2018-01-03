<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ServiceProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Service Providers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>

    .grid-view img {
        width: 48px !important;
    }
</style>
<div class="service-provider-view">

    <section class="content-header">

        <h1><?= Html::encode($this->title) ?></h1>

        <ol class="breadcrumb">

            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">

                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'name',
                        [
                            'attribute' => 'image',
//                            'filter' => ArrayHelper::map(\common\models\AdminRoles::find()->distinct()->all(), 'id', 'role_name'),
//                            'filter' => [1 => "Category", 2 => 'Sub Category'],
                            'value' => function($data) {
                        if ($data->image == '') {
                            return "Not Set";
                        } else {
                            return Yii::$app->request->baseUrl . "/../uploads/service-provider/" . Yii::$app->UploadFile->folderName(0, 1000, $data->id) . '/' . $data->id . '/' . $data->id . '.' . $data->image;
                        }
                    },
                            'format' => 'image',
                        ],
                        'website',
                        'email:email',
                        'phone',
                        [
                            'attribute' => 'city',
//                            'filter' => ArrayHelper::map(\backend\models\CategoriesMaster::find()->where([''])->distinct()->all(), 'id', 'role_name'),
//                            'filter' => [1 => "Category", 2 => 'Sub Category'],
                            'value' => function($data) {
                        if ($data->city == 0) {
                            return "Not Set";
                        } else {
                            return \common\models\Cities::findOne($data->city)->name;
                        }
                    }
                        ],
                        'locality',
                        'latitude',
                        'longitude',
                        [
                            'attribute' => 'working_time_from',
                            'value' => function($data) {
                        if ($data->working_time_from) {
                            return date('H:i A', strtotime($data->working_time_from));
                        }
                    }
                        ],
                        [
                            'attribute' => 'working_time_to',
                            'value' => function($data) {
                        if ($data->working_time_to) {
                            return date('H:i A', strtotime($data->working_time_to));
                        }
                    }
                        ],
                        'facebook',
                        'linkedin',
                        'instagram',
                        'twitter',
                        'snapchat',
                        'googleplus',
                        [
                            'attribute' => 'cb',
                            'filter' => ArrayHelper::map(\common\models\Users::find()->distinct()->all(), 'id', 'first_name'),
                            'value' => function($data) {
                        if ($data->cb == 0) {
                            return "";
                        } else {
                            return \common\models\Users::findOne($data->cb)->first_name;
                        }
                    }
                        ],
                        [
                            'attribute' => 'ub',
                            'filter' => ArrayHelper::map(\common\models\Users::find()->distinct()->all(), 'id', 'first_name'),
                            'value' => function($data) {
                        if ($data->ub == 0) {
                            return "";
                        } else {
                            return \common\models\Users::findOne($data->ub)->first_name;
                        }
                    }
                        ],
                        'doc',
                        'dou',
                        [
                            'attribute' => 'status',
                            'filter' => [0 => "Disable", 1 => 'Enable'],
                            'value' => function($data) {
                        if ($data->status == 1) {
                            return "Enable";
                        } else {
                            return "Disable";
                        }
                    }
                        ],
                    ],
                ])
                ?>

            </div>
        </div>
    </section>
</div>

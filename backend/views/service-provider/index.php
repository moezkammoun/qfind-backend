<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServiceProviderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Providers';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .aws_image {
        height: 35px;
    }
    .grid-view img {
        width: 35px !important;
        margin-left: 5px;
    }
</style>
<div class="service-provider-index">
    <section class="content-header">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <ol class="breadcrumb">

            <?= Html::a('Create Service Provider', ['create'], ['class' => 'btn btn-success']) ?>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
//                                'id',
                        'name',
                        'name_arabic',
//                        'image',
                        'phone',
                        'email:email',
                        [
                            'attribute' => 'image',
//                            'filter' => ArrayHelper::map(\common\models\AdminRoles::find()->distinct()->all(), 'id', 'role_name'),
//                            'filter' => [1 => "Category", 2 => 'Sub Category'],
                            'value' => function($data) {
                        if ($data->image == '') {
                            return "Not Set";
                        } else {
                            $images = explode(',', $data->image);
                            if ($images == NULL) {
                                return '';
                            } else {
                                $return_html = "<div class='aws_image'>";
                                foreach ($images as $image) {
                                    $s3 = Yii::$app->get('s3');
                                    $url = $s3->commands()->getUrl('service-provider/' . $data->id . '/' . $image)->execute();
                                    $return_html .= "<img src='" . $url . "'/>";
                                }
                                $return_html .="</div>";
                            }
                            return $return_html;

                            //   return Yii::$app->request->baseUrl . "/../uploads/service-provider/" . Yii::$app->UploadFile->folderName(0, 1000, $data->id) . '/' . $data->id . '/' . $data->id . '.' . $data->image;
                        }
                    },
                            'format' => 'html',
                        ],
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
                        // 'phone',
                        // 'city',
                        // 'locality',
                        // 'location',
                        // 'working_time_from',
                        // 'working_time_to',
                        // 'facebook',
                        // 'linkedin',
                        // 'instagram',
                        // 'twitter',
                        // 'snapchat',
                        // 'googleplus',
                        // 'cb',
                        // 'ub',
                        // 'doc',
                        // 'dou',
                        // 'status',
                        //['class' => 'yii\grid\ActionColumn'],
                        ['class' => 'yii\grid\ActionColumn',
                            'header' => 'view',
                            'template' => '{view}'],
                        ['class' => 'yii\grid\ActionColumn',
                            'header' => 'update',
                            'template' => '{update}'],
                        ['class' => 'yii\grid\ActionColumn',
                            'header' => 'delete',
                            'template' => '{delete}',
                        ],
                    ],
                ]);
                ?>
            </div>
        </div>
    </section>
</div>

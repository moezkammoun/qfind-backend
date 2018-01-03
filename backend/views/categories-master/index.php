<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategoriesMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>

    .grid-view img {
        width: 48px !important;
    }
</style>
<div class="categories-master-index">
    <section class="content-header">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <ol class="breadcrumb">

            <?= Html::a('Create Categories Master', ['create'], ['class' => 'btn btn-success']) ?>
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
//                        'canonical_name',
//                        'parent_id',
                        [
                            'attribute' => 'parent_id',
//                            'filter' => ArrayHelper::map(\backend\models\CategoriesMaster::find()->where([''])->distinct()->all(), 'id', 'role_name'),
//                            'filter' => [1 => "Category", 2 => 'Sub Category'],
                            'value' => function($data) {
                        if ($data->leval == 1) {
                            return "Top Leval Category";
                        } else {
                            return \backend\models\CategoriesMaster::findOne($data->parent_id)->name;
                        }
                    }
                        ],
                        [
                            'attribute' => 'leval',
//                            'filter' => ArrayHelper::map(\common\models\AdminRoles::find()->distinct()->all(), 'id', 'role_name'),
                            'filter' => [1 => "Category", 2 => 'Sub Category'],
                            'value' => function($data) {
                        if ($data->leval == 1) {
                            return "Category";
                        } else {
                            return 'Sub Category';
                        }
                    }
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
                        [
                            'attribute' => 'icon',
//                            'filter' => ArrayHelper::map(\common\models\AdminRoles::find()->distinct()->all(), 'id', 'role_name'),
                            'filter' => [1 => "Category", 2 => 'Sub Category'],
                            'value' => function($data) {
                        if ($data->icon == '') {
                            return "Not Set";
                        } else {
                            return Yii::$app->request->baseUrl . "/../uploads/categories-master/" . $data->id . '/icon/' . $data->icon;
                        }
                    },
                            'format' => 'image',
                        ],
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

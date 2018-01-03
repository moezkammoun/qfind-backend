<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminRolesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-roles-index">
    <section class="content-header">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

        <ol class="breadcrumb">

            <?= Html::a('Create Admin Roles', ['create'], ['class' => 'btn btn-success']) ?>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <?php Pjax::begin(); ?>                                    <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
//                        'id',
                        'role_name',
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
                        [
                            'attribute' => 'category_access',
                            'filter' => [0 => "Disable", 1 => 'Enable'],
                            'value' => function($data) {
                        if ($data->category_access == 1) {
                            return "Enable";
                        } else {
                            return "Disable";
                        }
                    }
                        ],
                        [
                            'attribute' => 'advt_access',
                            'filter' => [0 => "Disable", 1 => 'Enable'],
                            'value' => function($data) {
                        if ($data->advt_access == 1) {
                            return "Enable";
                        } else {
                            return "Disable";
                        }
                    }
                        ],
                        [
                            'attribute' => 'cms_access',
                            'filter' => [0 => "Disable", 1 => 'Enable'],
                            'value' => function($data) {
                        if ($data->cms_access == 1) {
                            return "Enable";
                        } else {
                            return "Disable";
                        }
                    }
                        ],
//            'doc',
//            // 'dou',
                        // 'category_access',
                        // 'advt_access',
                        // 'cms_access',
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
                <?php Pjax::end(); ?>            </div>
        </div>
    </section>
</div>

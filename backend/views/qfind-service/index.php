<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\QfindServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Qfind Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qfind-service-index">
    <section class="content-header">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

        <ol class="breadcrumb">

            <?= Html::a('Create Qfind Service', ['create'], ['class' => 'btn btn-success']) ?>
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
//                        'id',
//                        'title',
                        'date_from',
                        'date_to',
                        [
                            'attribute' => 'service',
                            'filter' => ArrayHelper::map(\common\models\ServiceProvider::find()->where(['status' => 1])->distinct()->all(), 'id', 'name'),
//                            'filter' => [1 => "Category", 2 => 'Sub Category'],
                            'value' => function($data) {
                        if ($data->service == 0) {
                            return "Top Leval Category";
                        } else {
                            return \common\models\ServiceProvider::findOne($data->service)->name;
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
                        // 'service',
                        // 'dou',
                        // 'doc',
                        // 'cb',
                        // 'ub',
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

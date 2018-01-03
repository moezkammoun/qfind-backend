<?php
/* @var $this yii\web\View */
$this->title = 'Nine piller Admin Dashboard';
?>
<!-- Content Wrapper. Contains page content -->
<style>

    .users-list>li {
        width: 25%;
        float: left;
        padding: 10px;
        text-align: center;
        min-height: 255px;
    }
    .users-list>li img {
        border-radius: 50%;
        max-width: 100%;
        height: auto;
        height: 267px !important;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <!--<small>Version 2.0</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-product-hunt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Categories</span>
                    <span class="info-box-number">1000</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-tasks"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Sub Categories </span>
                    <span class="info-box-number">41,410</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Service providers</span>
                    <span class="info-box-number">760</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-building-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Advertisements</span>
                    <span class="info-box-number">40</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->


    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">

            <!-- /.box -->
            <div class="row">

                <!-- /.col -->

                <div class="col-md-12">
                    <!-- Category LIST -->
                    <?php
                    $cats = backend\models\CategoriesMaster::find()->where(['status' => 1])->orderBy(['sort_order' => SORT_ASC])->limit(9)->all();
                    ?>

                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Categories</h3>
                            <div class="box-tools pull-right">
                                <!--<span class="label label-danger"><?= count($cats) . " Master Categories" ?></span>-->
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <ul class="users-list clearfix">
                                <?php foreach ($cats as $cat) { ?>
                                    <li>
                                        <?php
                                        $img = Yii::$app->request->baseUrl . '/../uploads/no-image.png';
                                        if ($cat->icon != "") {
                                            $img = Yii::$app->request->baseUrl . '/../uploads/categories-master/' . $cat->id . '/icon/' . $cat->icon;
                                        }
                                        ?>

                                        <img src="<?= $img ?>" alt="<?= $cat->name ?>">
                                        <a class="users-list-name" href="#"><?= $cat->name ?></a>
                                        <?php
                                        $countChild = backend\models\CategoriesMaster::find()->where(['status' => 1, 'parent_id' => $cat->id])->count();
                                        ?>
                                        <span class="users-list-date"><?= $countChild . ' Child Categories' ?></span>
                                    </li>

                                <?php } ?>

                            </ul>
                            <!-- /.users-list -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="<?= Yii::$app->request->baseUrl . '/categories-master' ?>" class="uppercase">View All Categories</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!--/.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->

            <!-- /.box -->
        </div>
        <!-- /.col -->


    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

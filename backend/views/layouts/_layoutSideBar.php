<?php
$controller = Yii::$app->controller->id;

$active_usersmain = "";
$active_admin = "";
$active_setings = "";
$active_seller = "";
//$adminPost = \backend\models\AdminPost::findOne(Yii::$app->user->identity->role);
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Yii::$app->request->baseUrl ?>/images/admin.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">SITE CONTENTS</li>

            <li class="treeview <?= $active_usersmain ?>">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Admin</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/admin-roles"><i class="fa fa-circle-o"></i> Admin Roles</a></li>
                    <li class="<?= $active_adminuser ?>"><a href="<?= Yii::$app->request->baseUrl ?>/users"><i class="fa fa-circle-o"></i> Admin Users</a></li>

                </ul>
            </li>

<!--            <li class="treeview <?= $active_usersmain ?>">
                <a href="#">
                    <i class="fa fa-address-card-o"></i> <span>Sellers</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/admin-post"><i class="fa fa-circle-o"></i> Companies</a></li>
                    <li class="<?= $active_adminuser ?>"><a href="<?= Yii::$app->request->baseUrl ?>/admin-users"><i class="fa fa-circle-o"></i> Individual</a></li>

                </ul>
            </li>-->

            <li class="treeview <?= $active_adminpost ?>">
                <a href="<?= Yii::$app->request->baseUrl ?>/categories-master">
                    <i class="fa fa-contao"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="treeview <?= $active_adminpost ?>">
                <a href="<?= Yii::$app->request->baseUrl ?>/service-provider">
                    <i class="fa fa-sliders"></i>
                    <span>Service Providers</span>
                </a>
            </li>
            <li class="treeview <?= $active_adminpost ?>">
                <a href="<?= Yii::$app->request->baseUrl ?>/qfind-service">
                    <i class="fa fa-file-image-o"></i>
                    <span>Qfind Service</span>
                </a>
            </li>
<!--            <li class="treeview <?= $active_ui ?>">
                <a href="<?= Yii::$app->request->baseUrl ?>/products">
                    <i class="fa fa-product-hunt"></i>
                    <span>Products</span>
                </a>
            </li>
            <li class="treeview <?= $active_ui ?>">
                <a href="<?= Yii::$app->request->baseUrl ?>/projects">
                    <i class="fa fa-building"></i>
                    <span>Projects</span>
                </a>
            </li>-->
            <?php /* <li class="treeview <?= $active_ui ?>">
              <a href="<?= Yii::$app->request->baseUrl ?>/enquiry-details">
              <i class="fa fa-building"></i>
              <span>Enquiry Details</span>
              </a>
              </li> */ ?>
<!--            <li class="treeview <?= $active_ui ?>">
                <a href="<?= Yii::$app->request->baseUrl ?>/enquiry">
                    <i class="fa fa-building"></i>
                    <span>Enquiry</span>
                </a>
            </li>


            <li class="treeview <?= $active_setings ?>">
                <a href="#">
                    <i class="fa fa-television"></i> <span>Display</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/home-slider"><i class="fa fa-picture-o"></i> Home Slider</a></li>

                </ul>
            </li>-->


<!--            <li class="treeview <?= $active_setings ?>">
                <a href="#">
                    <i class="fa fa-cog"></i> <span>Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/social-media"><i class="fa fa-share-square-o"></i> Social Media</a></li>
                    <li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/brand"><i class="fa fa-trademark"></i> Brand</a></li>
                    <li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/business-nature"><i class="fa fa-briefcase"></i> Business Nature</a></li>
                    <li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/home-industries"><i class="fa fa-university"></i> Home Industry</a></li>
                    <li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/premium-industries"><i class="fa fa-random"></i> Premium Industry</a></li>
                    <li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/premium-industries-left"><i class="fa fa-reply"></i> Premium Industry Left</a></li>
                    <li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/premium-industries-right"><i class="fa fa-share"></i> Premium Industry Right</a></li>
                    <li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/map-category-business-type"><i class="fa fa-arrows-h"></i> Map Category - Business Type</a></li>
                </ul>
            </li>

            -->
            <li class="treeview <?= $active_setings ?>">
                <a href="#">
                    <i class="fa fa-database"></i> <span>Masters</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!--<li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/countries"><i class="fa fa-globe"></i> Countries</a></li>-->
                    <!--<li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/states"><i class="fa fa-thumb-tack"></i> State</a></li>-->
                    <li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/cities"><i class="fa fa-dot-circle-o"></i> Cities</a></li>
                    <!--<li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/categories-master"><i class="fa fa-tags"></i> Categories</a></li>-->
                    <!--<li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/industries-master"><i class="fa fa-industry"></i> Business Industries</a></li>-->
                    <!--<li class="<?= $active_adminpost ?>"><a href="<?= Yii::$app->request->baseUrl ?>/master-business-types"><i class="fa fa-file-text-o"></i> Business Type</a></li>-->

                </ul>
            </li>



    </section>
    <!-- /.sidebar -->
</aside>
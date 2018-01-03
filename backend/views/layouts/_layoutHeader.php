<header class="main-header">
    <!-- Logo -->
    <a  class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Q</b>F</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><img src="<?= Yii::$app->request->baseUrl . '/images/logo-small.png' ?>"></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?= Yii::$app->request->baseUrl ?>/images/admin.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?= (isset(Yii::$app->user->identity->username)) ? Yii::$app->user->identity->username : '' ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/admin.png" class="img-circle" alt="User Image">

                                        <p>
                                            <?= (isset(Yii::$app->user->identity->username)) ? Yii::$app->user->identity->username : '' ?>
                                            <small><?= (isset(Yii::$app->user->identity->email)) ? Yii::$app->user->identity->email : '' ?></small>
                                        </p>
                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Hide</a>
                                        </div>
                                        <div class="pull-right">

                                            <a href="<?= Yii::$app->request->baseUrl . '/site/logout' ?>" data-method="post" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
                </header>
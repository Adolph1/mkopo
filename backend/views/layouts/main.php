<?php

/**
 * @var $content string
 */

use yii\helpers\Html;
use common\widgets\Alert;
use backend\models\Cart;
use backend\models\Inventory;

yiister\adminlte\assets\Asset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <script>
        $("#language").click(function(){
            alert("clicked");
        });

    </script>
    <![endif]-->
    <?php $this->head() ?>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-green sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>MM</b>5.0</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Mkopo Manager</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation </span>
                <?php
                if (!Yii::$app->user->isGuest) {
                    ?>

                System Date:<?= \backend\models\SystemDate::getCurrentDate();?>
                <?php }?>
            </a>

            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Languages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">

                        <ul class="dropdown-menu">

                            <li>
                                <!-- inner menu: contains the messages -->
                                <ul class="menu">
                                    <?php
                                    /*$languages=\backend\models\Language::getAll();
                                    foreach ($languages as $language)
                                    {
                                        echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><li style="padding: 10px" id="language">
                                                <i class="fa fa-angle-double-right"></i>
                                            '.$language->title.'
                                            </li></a>';
                                    }*/
                                    ?>
                                </ul><!-- /.menu -->
                            </li>

                        </ul>
                    </li><!-- /.Languages-menu -->


                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->

                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">
                                <?php
                                if (!Yii::$app->user->isGuest) {
                                    echo '<i>welcome:</i>'. Yii::$app->user->identity->username;
                                }
                                ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="http://placehold.it/160x160" class="img-circle" alt="User Image">
                                <p>
                                    <?php
                                    if (!Yii::$app->user->isGuest) {

                                        echo Yii::$app->user->identity->username;
                                        $user_id=Yii::$app->user->identity->id;
                                    }

                                    ?>

                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <?php
                                    if(!Yii::$app->user->isGuest) {
                                        echo Html::beginForm(['/site/logout'], 'post');
                                        echo Html::submitButton(
                                            'Logout (' . Yii::$app->user->identity->username . ')',
                                            ['class' => 'btn btn-link logout']
                                        );
                                        echo Html::endForm();
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar Menu -->
            <?php if (!Yii::$app->user->isGuest) {?>
                <?=

                \yiister\adminlte\widgets\Menu::widget(
                    [
                        "items" => [
                            ["label" =>Yii::t('app','Home'), "url" =>  Yii::$app->homeUrl, "icon" => "home"],

                            [
                                "label" =>Yii::t('app','Branches'),
                                "url" =>  "#",
                                "icon" => "fa fa-sitemap",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Branches'),
                                        "url" =>["/branch/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                ],

                            ],


                            [
                                "label" =>Yii::t('app','Customer Account'),
                                "url" =>  "#",
                                "icon" => "fa fa-bank",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Account List'),
                                        "url" =>["/account/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Account Classes'),
                                        "url" =>["/account-class/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],

                                ],

                            ],

                            [
                                "label" =>Yii::t('app','Customer Details'),
                                "url" =>  "#",
                                "icon" => "fa fa-user",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Customers List'),
                                        "url" =>["/customer/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Category'),
                                        "url" =>["/customer-category/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Type'),
                                        "url" =>["/customer-type/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],

                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Identification'),
                                        "url" =>["/customer-identification/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Customer balances'),
                                        "url" =>["/customer-balance/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],

                                ],

                            ],

                            [
                                "label" =>Yii::t('app','Loans & Deposits'),
                                "url" =>  "#",
                                "icon" => "fa fa-money",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('Level5')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Loans'),
                                        "url" =>["/contract-master/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Deposits'),
                                        "url" =>["/contract-master/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                ],



                            ],

                            [
                                "label" =>Yii::t('app','Teller'),
                                "url" =>  "#",
                                "icon" => "fa fa-lock",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('Level5')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Post'),
                                        "url" =>["/teller/create"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Transactions'),
                                        "url" =>["/teller/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                ],



                            ],



                            [
                                "label" =>Yii::t('app','Today Transactions'),
                                "url" =>  "#",
                                "icon" => "fa fa-clock-o",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Authorised'),
                                        "url" =>["/today-entry/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Unauthorised'),
                                        "url" =>["/today-entry/unauthorised"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Reversed'),
                                        "url" =>["/today-entry/reversed"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                ],



                            ],



                            [
                                "label" =>Yii::t('app','Accounting'),
                                "url" =>  "#",
                                "icon" => "fa fa-clock-o",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','General Ledgers'),
                                        "url" =>["/general-ledger/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Types'),
                                        "url" =>["/gl-type/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Balances'),
                                        "url" =>["/gl-balance/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                ],



                            ],

                            [
                                "label" =>Yii::t('app','Savings & Shares'),
                                "url" =>  "#",
                                "icon" => "fa fa-lock",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('Level5')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Savings'),
                                        "url" =>["/teller/create"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Shares'),
                                        "url" =>["/teller/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                ],



                            ],

                            [
                                "label" =>Yii::t('app','Interests & Charges'),
                                "url" =>  "#",
                                "icon" => "fa fa-lock",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('Level5')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Interests'),
                                        "url" =>["/teller/create"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Charges'),
                                        "url" =>["/teller/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                ],



                            ],

                            //["label" =>Yii::t('app','Locations'), "url" =>  ["/location/index"], "icon" => "fa fa-sitemap",],




                            [
                                'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                "label" =>Yii::t('app','Settings'),
                                "url" => "#",
                                "icon" => "fa fa-gears",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        'label' =>'System Products',
                                        'url' => ['/product/index'],
                                        'icon' => 'fa fa-lock',
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        'label' =>'System Account roles',
                                        'url' => ['/accrole/index'],
                                        'icon' => 'fa fa-lock',
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        'label' => Yii::t('app', 'System Rates'),
                                        'url' => ['/system-rate/index'],
                                        'icon' => 'fa fa-lock',
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        'label' => Yii::t('app', 'System Dates'),
                                        'url' => ['/system-date/index'],
                                        'icon' => 'fa fa-calendar-o',
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanManager') || yii::$app->User->can('admin'),
                                        'label' => Yii::t('app', 'EOD'),
                                        'url' => ['/system-setup/run-eod'],
                                        'icon' => 'fa fa-lock',
                                    ],


                                    /*[
                                        'visible' => (Yii::$app->user->identity->username == 'admin'),
                                        "label" => "Backup",
                                        "url" => ["/backup"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],*/
                                    [
                                        'visible' => (Yii::$app->user->identity->username == 'admin'),
                                        "label" => "Users",
                                        "url" => ["/user"],
                                        "icon" => "fa fa-user",
                                    ],

                                    [
                                        'visible' => (Yii::$app->user->identity->username == 'admin'),
                                        'label' => Yii::t('app', 'Manager Permissions'),
                                        'url' => ['/auth-item/index'],
                                        'icon' => 'fa fa-lock',
                                    ],
                                    [
                                        'visible' => (Yii::$app->user->identity->username == 'admin'),
                                        'label' => Yii::t('app', 'Manage User Roles'),
                                        'url' => ['/role/index'],
                                        'icon' => 'fa fa-lock',
                                    ],

                                ],
                            ],
                        ],
                    ]
                )
                ?>
            <?php }?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php // Html::encode(isset($this->params['h1']) ? $this->params['h1'] : $this->title) ?>
            </h1>
            <?php if (isset($this->params['breadcrumbs'])): ?>
                <?=
                \yii\widgets\Breadcrumbs::widget(
                    [
                        'encodeLabels' => false,
                        'homeLink' => [
                            'label' => new \rmrevin\yii\fontawesome\component\Icon('home') .Yii::t('app','Home'),
                            "url" =>  Yii::$app->homeUrl,
                        ],
                        'links' => $this->params['breadcrumbs'],
                    ]
                )
                ?>
            <?php endif; ?>
        </section>

        <!-- Main content -->
        <section class="content" style="background: #fff">
            <div style="padding-top: 10px"><?= Alert::widget() ?></div>
            <?= $content ?>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Powered by Adotech
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; Mkopo Manager <?= date("Y") ?>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

            </div><!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                            Some information about this general settings option
                        </p>
                    </div><!-- /.form-group -->
                </form>
            </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script>
    $("#purchasemaster-country").change(function(){
        var id =document.getElementById("purchasemaster-country").value;
        if(id==1){
            $( "#rates" ).hide( "slow", function() {
                //alert( "Animation complete." );
            });
        }
        else if(id==2){
            $( "#rates" ).show( "slow", function() {
            });
        }
        else if(id==0){
            $( "#rates" ).show( "slow", function() {
            });
        }


    });

</script>

<script>
    $(document).ready(function(){
        var id =document.getElementById("purchasemaster-country").value;
        if(id==1){
            $( "#rates" ).hide( "slow", function() {
                //alert( "Animation complete." );
            });
        }
        else if(id==2){
            $( "#rates" ).show( "slow", function() {
            });
        }
        else if(id==0){
            $( "#rates" ).show( "slow", function() {
            });
        }


    });

</script>



<script>
    $("#item-branch_id").change(function(){
        var id =document.getElementById("item-branch_id").value;
        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['department/filter','id'=>'']);?>"+id,function(data) {

            //alert(data);
            $("#item-department_id").html(data);

        });
    });

</script>





<?php //Loans and Deposits javascripts ?>

<script>
    $("#contractmaster-customer_name").change(function(){
        var id =document.getElementById("contractmaster-customer_name").value;
        //alert(id);
        $("#prodid").html('<i class="fa fa-spinner fa-spin"></i> Looding....');
        $.get("<?php echo Yii::$app->urlManager->createUrl(['contract-master/list','id'=>'']);?>"+id,function(data){
            //alert(data);
            $("#contractmaster-settle_account").html(data);
            $("#prodid").html('');
        });
        document.getElementById("contractmaster-customer_number").value=id


    });

    //load products and set product group
    $("#contractmaster-product").change(function(){
        var id =document.getElementById("contractmaster-product").value;
        //alert(id);
        $("#prodid").html('<i class="fa fa-spinner fa-spin"></i> Looding....');
        $.get("<?php echo Yii::$app->urlManager->createUrl(['contract-master/productgroup','id'=>'']);?>"+id,function(data){
            //alert(data);
            document.getElementById("contractmaster-product_type").value=data

        });
        $.get("<?php echo Yii::$app->urlManager->createUrl(['contract-master/reference','id'=>'']);?>"+id,function(data) {
            //alert(data);
            document.getElementById("contractmaster-contract_ref_no").value =data;
            $("#prodid").html('');

        });


    });
</script>






<?php //Teller javascripts ?>

<script>
    $("#teller-related_customer").change(function(){
        var id =document.getElementById("teller-related_customer").value;
        //alert(id);
        $("#prodid").html('<i class="fa fa-spinner fa-spin"></i> Looding....');
        $.get("<?php echo Yii::$app->urlManager->createUrl(['contract-master/list','id'=>'']);?>"+id,function(data){
            //alert(data);
            //$("#contractmaster-settle_account").html(data);
            $("#prodid").html('');
        });
        document.getElementById("teller-customer_number").value=id


    });

    //load products and set product group
    $("#teller-product").change(function(){
        var id =document.getElementById("teller-product").value;
        //alert(id);
        $("#prodid").html('<i class="fa fa-spinner fa-spin"></i> Looding....');
        $.get("<?php echo Yii::$app->urlManager->createUrl(['contract-master/reference','id'=>'']);?>"+id,function(data) {
            //alert(data);
            document.getElementById("teller-reference").value =data;
            $("#prodid").html('');

        });

        $.get("<?php echo Yii::$app->urlManager->createUrl(['product-event-entry/offset','id'=>'']);?>"+id,function(data) {
            //alert(data);
            document.getElementById("teller-offset_account").value =data;
            $("#prodid").html('');

        });


    });
</script>

<script>

    $("#datechange").change(function() {

        var frequency = document.getElementById('contractmaster-frequency').value;
        var paymentdate = document.getElementById('datechange').value;

        //alert(paymentdate);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['contract-master/calcmaturitydate1', 'paymentdate' => '']);?>" + paymentdate, function (data) {
            //alert(data);
            document.getElementById("contractmaster-maturity_date").value = data;


        });
    });

</script>



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
<style>
    /*SEARCH FORM*/
    .search-form {
        border-radius: 30px 30px 30px 30px;
        /*border-radius:Top-left, Top-right, Bottom-right, Bottom-left;*/
    }
    /*to cange only one form and not all give unique class name like  class="search-form" */
    .search-btn {
        border-radius: 0px 30px 30px 0px;
        cursor: pointer;

    }

    /* Center the loader */
    #loader1 {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 50px;
        height: 50px;
        margin: -75px 0 0 -75px;
        border: 10px solid #f3f3f3;
        border-radius: 50%;
        border-top: 10px solid #3498db;
        width: 50px;
        height: 50px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Add animation to "page content" */
    .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
        from { bottom:-100px; opacity:0 }
        to { bottom:0px; opacity:1 }
    }

    @keyframes animatebottom {
        from{ bottom:-100px; opacity:0 }
        to{ bottom:0; opacity:1 }
    }


</style>

<?php $this->beginBody() ?>
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>PSS</b>2.0.1</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>PSS</b></span>
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

                    <?php
                    if (!Yii::$app->user->isGuest && yii::$app->User->can('LoanOfficer')) {
                        //echo Yii::$app->user->identity->username;

                        ?>
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <?php
                                $awatingRepayments=\backend\models\ContractAmountReduceDue::getAwaiting();
                                ?>
                                <span class="label label-warning"><?= $awatingRepayments;?></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li class="header"><i class="fa fa-th text-aqua"></i> There are <?= $awatingRepayments;?> installments awaiting  for repayments</li>
                                <?php
                                if($awatingRepayments>0){
                                    echo  '<li><div class="col-sm-12 text-center" style="padding: 10px">'.Html::a(Yii::t('app', 'View'), ['contract-amount-reduce-due/awaiting'], ['class' => 'btn btn-primary']).'</div></li>';
                                }
                                ?>

                            </ul>

                        </li><!-- /.messages-menu -->
                    <?php }?>



                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->

                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs" style="margin-right: 200px"> <?php
                                $curren_stage=\backend\models\SystemSetup::getCurrentStage();
                                if($curren_stage==\backend\models\SystemStage::TI){
                                    echo 'TRANSACTIONS INPUT';

                                }elseif($curren_stage==\backend\models\SystemStage::EOTI) {
                                    echo 'END OF TRANSACTIONS INPUT';

                                }elseif($curren_stage==\backend\models\SystemStage::EOFI){

                                    echo 'END OF FINANCIAL INPUT';

                                }elseif($curren_stage==\backend\models\SystemStage::EOD){

                                    echo 'END OF DAY';

                                }

                                ?>
                            </span>
                            <span class="hidden-xs">
                                <?php
                                if (!Yii::$app->user->isGuest) {
                                    // echo '<i>welcome:</i>'. Yii::$app->user->identity->username;
                                }
                                ?></span>
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
                                "label" =>Yii::t('app','Saccoss'),
                                "url" =>  "#",
                                "icon" => "fa fa-building",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Details'),
                                        "url" =>["/saccoss/create"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Shareholders'),
                                        "url" =>["/shareholder/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Investments'),
                                        "url" =>["/investment/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Shares'),
                                        "url" =>["/share/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                ],

                            ],

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
                                "label" =>Yii::t('app','Contributions'),
                                "url" =>  "#",
                                "icon" => "fa fa-sitemap",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Contributions'),
                                        "url" =>["/contribution/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Contributions Types'),
                                        "url" =>["/contribution-type/index"],
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
                                        "label" => Yii::t('app','Add Account'),
                                        "url" =>["/account/create"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Account List'),
                                        "url" =>["/account/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],

                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Account Settings'),
                                        "url" =>["/account-bal-setting/index"],
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
                                ],

                            ],

                            [
                                "label" =>Yii::t('app','Groups'),
                                "url" =>  "#",
                                "icon" => "fa fa-sitemap",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('Level5')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','New Group'),
                                        "url" =>["/group/create"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Groups List'),
                                        "url" =>["/group/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                ],



                            ],

                            [
                                "label" =>Yii::t('app','Loans & Savings'),
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
                                        "label" => Yii::t('app','Savings'),
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
                                        "label" => Yii::t('app','Category'),
                                        "url" =>["/gl-category/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Journals'),
                                        "url" =>["/journal-entry/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Daily Balances'),
                                        "url" =>["/gl-daily-balance/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                ],



                            ],



                            [
                                'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')||yii::$app->User->can('admin'),
                                "label" =>Yii::t('app','Employees'),
                                "url" =>  ["/employee/index"], "icon" => "fa fa-users",
                            ],


                            [
                                'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                "label" =>Yii::t('app','Departments'),
                                "url" =>  ["/department/index"], "icon" => "fa fa-sitemap",
                            ],

                            //["label" =>Yii::t('app','Locations'), "url" =>  ["/location/index"], "icon" => "fa fa-sitemap",],

                            [
                                "label" =>Yii::t('app','SMS Module'),
                                "url" =>  "#",
                                "icon" => "fa fa-envelope-o",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('Level5')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','SMS Templates'),
                                        "url" =>["/sms-template/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','SMS Logs'),
                                        "url" =>["/sms-log/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                ],




                            ],
                            [
                                "label" =>Yii::t('app','Reports'),
                                "url" =>  "#",
                                "icon" => "fa fa-line-chart",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Customers'),
                                        "url" =>"#",
                                        "icon" => "fa fa-user",
                                        "items" => [
                                            [
                                                'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                                "label" => Yii::t('app','All customers'),
                                                "url" =>["/report/customers"],
                                                "icon" => "fa fa-angle-double-right",
                                            ],
                                            [
                                                'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                                "label" => Yii::t('app','Accounts balances'),
                                                "url" =>["/report/account-balance"],
                                                "icon" => "fa fa-angle-double-right",
                                            ],
                                            [
                                                'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                                "label" => Yii::t('app','Customers collateral'),
                                                "url" =>["/report/collateral"],
                                                "icon" => "fa fa-angle-double-right",
                                            ],
                                            [
                                                'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                                "label" => Yii::t('app','Customers branch-wise'),
                                                "url" =>["/report/customer-branch-wise"],
                                                "icon" => "fa fa-angle-double-right",
                                            ],
                                        ],
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','SMS Logs'),
                                        "url" =>["/sms-log/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                ],




                            ],

                            [
                                'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                "label" =>Yii::t('app','Settings'),
                                "url" => "#",
                                "icon" => "fa fa-gears",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('LoanOfficer') || yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        'label' => Yii::t('app', 'System Setup'),
                                        'url' => ['/system-setup/index'],
                                        'icon' => 'fa fa-lock',
                                    ],
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
                                        'visible' => yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Events'),
                                        "url" =>["/event-type/index"],
                                        "icon" => "fa fa-angle-double-right",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('LoanManager') || yii::$app->User->can('admin'),
                                        'label' => Yii::t('app', 'EOD'),
                                        'url' => ['/eod-cycle/index'],
                                        'icon' => 'fa fa-lock',
                                    ],

                                    [
                                        'visible' => yii::$app->User->can('LoanManager')|| yii::$app->User->can('admin'),
                                        "label" => Yii::t('app','Business Rules'),
                                        "url" =>["/business-rule/index"],
                                        "icon" => "fa fa-angle-double-right",
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
        <section class="content" style="background: #ecf0f5">
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
        <strong>Copyright &copy; PSS <?= date("Y") ?>
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
    $("#run-ti").click(function(){
        //alert('yes bro');
        $.get("<?php echo Yii::$app->urlManager->createUrl(['system-setup/run-eoti']);?>",function(data) {
            //alert('yes bro');
        });
    });

    $("#run-eofi").click(function(){
        alert('yes bro');
        $.get("<?php echo Yii::$app->urlManager->createUrl(['system-setup/run-eofi']);?>",function(data) {
            //alert('yes bro');
        });
    });

    $("#run-eod").click(function(){
        alert('yes bro');
        $.get("<?php echo Yii::$app->urlManager->createUrl(['system-setup/run-eod']);?>",function(data) {
            //alert('yes bro');
        });
    });




</script>

<script>
    $("#product-product_group").change(function(){
        var id =document.getElementById("product-product_group").value;
        //alert(id);
        if(id=='Teller'){
            $( "#interest-method" ).hide( "slow", function() {
            });
            $("#product-type" ).show( "slow", function() {
            });
            $("#loan-method" ).hide( "slow", function() {
            });

            $("#fund-id" ).hide( "slow", function() {
            });




        }

        else if(id=='Loans'){
            $("#interest-method" ).show( "slow", function() {
            });
            $("#product-type" ).hide( "slow", function() {
            });
            $("#loan-method" ).show( "slow", function() {
            });
            $("#fund-id" ).show( "slow", function() {
            });

        }
        else if(id=='Deposits'){
            $("#interest-method" ).hide( "slow", function() {
            });
            $("#product-type" ).hide( "slow", function() {
            });
            $("#loan-method" ).show( "slow", function() {
            });
            $("#fund-id" ).hide( "slow", function() {
            });
        }


    });

    $(document).ready(function(){
        //alert('yes bro');


        var account_role=document.getElementById('productevententry-product_code').value;
        // alert(account_role);

        $.get("<?php echo Yii::$app->urlManager->createUrl(['product-accrole/fetch-role','id'=>'']);?>"+account_role,function(data) {
            // alert(data);
            document.getElementById('productevententry-account_role_code').value=data;
        });



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


    //load products and set product group
    $("#contribution-product").change(function(){
        var refno =document.getElementById("contribution-product").value;

        $.get("<?php echo Yii::$app->urlManager->createUrl(['contract-master/reference', 'id' => '']);?>" + refno, function (data) {
//alert(data);
            document.getElementById("contribution-trn_ref_no").value = data;
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

        $.get("<?php echo Yii::$app->urlManager->createUrl(['contract-master/calcmaturitydate', 'paymentdate' => '']);?>" + paymentdate+'&frequency='+frequency, function (data) {
            //alert(data);
            document.getElementById("contractmaster-maturity_date").value = data;


        });
    });

    $("#journalentry-debit_account").change(function() {


        var id = document.getElementById("journalentry-debit_account").value;

        alert(id);

        $.get("<?php echo Yii::$app->urlManager->createUrl(['general-ledger/fetch-credit', 'id' => '']);?>" + id, function (data) {
            alert(data);

            $("#journalentry-credit_account").html(data);


        });

    });


</script>


<script>
    $('#account-branch_code').on('change', function () {
        var cust_no = document.getElementById('account-cust_no').value;
        if(cust_no==""){
            alert('Kindly search customer first');
            window.location.reload(true);
        }
        else{
            var cust_acc=document.getElementById('account-branch_code').value+cust_no;

            $.get("<?php echo Yii::$app->urlManager->createUrl(['account/check-exist', 'id' => '']);?>" + cust_acc, function (data) {
              if(data==true){
                  alert('Account exists');
                  window.location.reload(true);
              }else{
                  document.getElementById("account-cust_ac_no").value=cust_acc;
              }


            });

        }

    });

    $('.activity-view-link').click(function() {
        // alert('yes bro');
        var elementId = $(this).closest('tr').data('key');
        //alert(elementId);
    });

    $("#repay-id").click(function(){
        var id= document.getElementById('contractpayment-id').value;
        var amount= document.getElementById('contractpayment-amount').value;
        //alert('yes bro');
        $.get("<?php echo Yii::$app->urlManager->createUrl(['contract-payment/create-payment', 'id' => '']);?>" + id+'&amount='+amount, function (data) {
            alert(data);
            //document.getElementById("contractmaster-maturity_date").value = data;


        });
    });
</script>

<script>
    window.onload = function() {
        //alert('yes bro');
        //gets statement

        var id=document.getElementById("account-id").innerHTML;
        var from=document.getElementById("from-id").value;
        var to=document.getElementById("to-id").value;
        $.get("<?php echo Yii::$app->urlManager->createUrl(['today-entry/statement', 'id' => '']);?>"+ id +'&start_date='+ from +'&end_date='+ to, function (data) {
            $("#statement-table").html(data);
        });

    };

    $("#load-data").click(function () {
        document.getElementById("loader1").style.display = "block";
        setTimeout(showPage, 3000);

    });
    function showPage() {
        var id=document.getElementById("account-id").innerHTML;
        var from=document.getElementById("from-id").value;
        var to=document.getElementById("to-id").value;
        $.get("<?php echo Yii::$app->urlManager->createUrl(['today-entry/statement', 'id' => '']);?>"+ id +'&start_date='+ from +'&end_date='+ to, function (data) {

            document.getElementById("loader1").style.display = "none";
            $("#statement-table").html(data);

        });
    }


    $("#new-entry").click(function () {
        var refno = 'JRN';
        //alert(refno);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['contract-master/reference', 'id' => '']);?>" + refno, function (data) {
            //alert(data);
            document.getElementById("journalentry-trn_ref_no").value = data;
            $("#prodid").html('');

        });
    });


    $("#print-preview").click(function(){
        var printContents = document.getElementById('statement').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    });




    //sends sms notification
    $("#send-sms").click(function() {
        //alert('yes bro');

        $.get("<?php echo Yii::$app->urlManager->createUrl(['contract-amount-reduce-due/filter-unpaid']);?>", function (data) {
            // alert(data);
            var sms = data.split(';');
            alert(sms);

            for (var i = 1; i < sms.length; i++) {
                var num = sms[i].split(',');
                for(var j=1;j<num.length;j++) {
                    var sms1="Dear " + num[1] +",You are reminded to repay your loan as of "+ num[2] +" Tsh "+ num[3];
                    var to=num[0];
                    var data = JSON.stringify({
                        "from": "InfoText",
                        "to": to,
                        "text": sms1
                    });
                }

                var xhr = new XMLHttpRequest();
                xhr.withCredentials = false;

                xhr.addEventListener("readystatechange", function () {
                    if (this.readyState === this.DONE) {
                        console.log(this.responseText);
                    }
                });

                xhr.open("POST", "https://api.infobip.com/sms/1/text/single");
                xhr.setRequestHeader("authorization", "Basic QWRvdGVjaFRaOlRlc3QxMjM0");
                xhr.setRequestHeader("content-type", "application/json");
                xhr.setRequestHeader("accept", "application/json");

                xhr.send(data);
                //alert('Successfully sent');
                theUrl = 'http://localhost/mkopo/index.php?r=sms-log/create-log&to=' + to + '&sms=' + sms1;
                $.get(theUrl, function (data) {
                    alert(data);
                });
            }


        });
    });

</script>




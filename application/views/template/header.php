<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>:v :) :'(</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- bootstrapdashboard -->
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/vendor/bootstrap/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/vendor/bootstrap/css/bootstrap-datepicker3.css');?>">
    <link rel="stylesheet" href="<?=  base_url('assets/css/bootstrapdashboardcustom.css');?>">
    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/vendor/bootstrap/css/bootstrap-select.min.css');?>">
    <!-- <link rel="stylesheet" href="<?=  base_url('assets/bootstrap/css/bootstrap.css');?>"> -->
    <!-- <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/css/bootstrap-datepicker3.css');?>"> -->
    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/vendor/bootstrap/css/animate.css');?>">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/vendor/font-awesome/css/font-awesome.min.css');?>">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/css/fontastic.css');?>">
    <!-- Google fonts - Roboto -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700"> -->
    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/vendor/bootstrap/css/googlefonts.css');?>">

    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/vendor/bootstrap/css/dataTables.bootstrap4.css');?>">
    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/vendor/bootstrap/css/responsive.bootstrap4.min.css');?>">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/css/grasp_mobile_progress_circle-1.0.0.min.css');?>">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css');?>">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/css/style.default.premium.css');?>" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/css/custom.css');?>">
    <!-- <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/css/file/component.css');?>">
    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/css/file/demo.css');?>">
    <link rel="stylesheet" href="<?=  base_url('assets/bootstrapdashboard/css/file/normalize.css');?>"> -->
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?=  base_url('assets/bootstrapdashboard/img/favicon.ico');?>">

    <!-- JS -->
    <script src="<?= base_url('assets/js/jquery.min.js');?>"></script>
    <!-- <script src="<?=  base_url('assets/bootstrapdashboard/js/bootstrap-notify.js');?>"></script>
    <script src="<?=  base_url('assets/bootstrapdashboard/js/bootbox.min.js');?>"></script> -->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body> 
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="<?=  base_url('assets/bootstrapdashboard/img/avatar-5.jpg');?>" alt="person" class="img-fluid rounded-circle">
          <?php 
            $groupname = ''; 
            if(isset($_SESSION[get_variable().'userdata']['M_Groupuser_Id']))
              $groupname = $this->M_groupusers->get($_SESSION[get_variable().'userdata']['M_Groupuser_Id'])->GroupName;
          ?>  
          <h2 class="h5"><?=  $_SESSION[get_variable().'userdata']['Username']?></h2><span><?= $groupname ?></span>
          </div>
          
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Main</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="<?=  base_url('office');?>"> <i class="icon-home"></i>Home</a></li>
            <li><a href="#exampledropdownDropdownGeneral" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i><?= lang('ui_setting')?></a>
              <ul id="exampledropdownDropdownGeneral" class="collapse list-unstyled ">
                <!-- <li><a href="<?=  base_url('mainsetup');?>"><?= lang('ui_mainsetup')?></a></li> -->
                <li><a href="<?=  base_url('mcompany');?>"><?= lang('ui_company')?></a></li>
              </ul>
            </li>
            <li><a href="#exampledropdownDropdownMaster" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Master</a>
              <ul id="exampledropdownDropdownMaster" class="collapse list-unstyled ">
              <?php 
              foreach($mastermenu as $master) {
                if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'], $master->FormName, "Read")){
              ?>
                <li><a href="<?= base_url($master->IndexRoute);?>"><?= lang($master->Resource)?></a></li>
              <?php 
                }
              }
              ?>
                
              </ul>
            </li>
            <li><a href="#exampledropdownDropdownTransaction" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i><?= lang('ui_transaction')?></a>
              <ul id="exampledropdownDropdownTransaction" class="collapse list-unstyled ">
                <li><a href="<?=  base_url('tjournal');?>"><?= lang('ui_transaction')?></a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="admin-menu">
          <h5 class="sidenav-heading"><?= lang('ui_report')?></h5>
          <ul id="side-admin-menu" class="side-menu list-unstyled"> 
            <!-- <li><a href="<?=  base_url('report');?>"><i class="icon-interface-windows"></i><?= lang('ui_report')?></a></li> -->
            <li><a href="#exampledropdownDropdownReport" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i><?= lang('ui_report')?></a>
              <ul id="exampledropdownDropdownReport" class="collapse list-unstyled ">
              <?php foreach($this->R_reports->get_list() as $report) {?>
                <li><a href="<?=  base_url($report->Url);?>"><?= lang($report->Resource)?></a></li>
              <?php }?>
              </ul>
            </li>
          </ul>
        </div>
        <div class="admin-menu">
          <h5 class="sidenav-heading">User</h5>
          <ul id="side-admin-menu" class="side-menu list-unstyled"> 
            <li><a href="<?=  base_url('mgroupuser');?>"><i class="icon-user"></i><?= lang('ui_groupuser')?></a></li>
            <li><a href="<?=  base_url('muser');?>"><i class="icon-user"></i><?= lang('ui_user')?></a></li>
          </ul>
        </div>
        
        <?php if($_SESSION[get_variable().'userdata']['Username'] == "superadmin") { ?>
        
        <?php }?>
          
      </div>
    </nav>
    <div class="page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="<?=  base_url();?>" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><span> </span><strong class="text-primary"><?= $companyname?></strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Notifications dropdown-->
                <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell"></i><span class="badge badge-warning">12</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification d-flex justify-content-between">
                          <div class="notification-content"><i class="fa fa-envelope"></i>You have 6 new messages </div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification d-flex justify-content-between">
                          <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification d-flex justify-content-between">
                          <div class="notification-content"><i class="fa fa-upload"></i>Server Rebooted</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification d-flex justify-content-between">
                          <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                          <div class="notification-time"><small>10 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>view all notifications                                            </strong></a></li>
                  </ul>
                </li>
                <!-- Messages dropdown-->
                <!-- <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope"></i><span class="badge badge-info">10</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Jason Doe</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Frank Williams</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Ashley Wood</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-envelope"></i>Read all messages    </strong></a></li>
                  </ul>
                </li> -->
                <!-- Languages dropdown    -->
                <li class="nav-item dropdown">
                  <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle">
                    <?php 
                      $flag = $this->G_languages->get($_SESSION[get_variable().'languages']['Id'])->getFlagName();
                    ?>
                    <img src="<?= base_url('assets/bootstrapdashboard/img/flags/16/'.$flag)?>" alt="<?=  $_SESSION[get_variable().'languages']['Name']?>">
                    <span class="d-none d-sm-inline-block"><?=  $_SESSION[get_variable().'languages']['Name']?></span>
                  </a>
                  <ul aria-labelledby="languages" class="dropdown-menu">
                    <li><a rel="nofollow" class="dropdown-item" href ="<?=  base_url('language/change_language');?>?language=indonesia"> 
                      <img src="<?=  base_url('assets/bootstrapdashboard/img/flags/16/ID.png')?>" alt="Indonesia" class="mr-2">
                      <span>Indonesia</span></a>
                    </li>
                    <li><a rel="nofollow" class="dropdown-item"  href ="<?=  base_url('language/change_language');?>?language=english"> 
                      <img src="<?=  base_url('assets/bootstrapdashboard/img/flags/16/US.png');?>" alt="English" class="mr-2">
                      <span>English</span></a>
                    </li>
                  </ul>
                </li>
                <!-- profile dropdown    -->
                <li class="nav-item dropdown">
                  <a id="profile" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle">
                    hi, 
                    <span class="d-none d-sm-inline-block"><?=  $_SESSION[get_variable().'userdata']['Username']?></span>
                  </a>
                  <ul aria-labelledby="profile" class="dropdown-menu">
                    <li><a rel="nofollow" class="dropdown-item" href ="<?=  base_url('changePassword');?>"> 
                      <i class="fa fa-edit"></i>
                      <span><?= lang('ui_changepassword')?></span></a>
                    </li>
                    <li><a rel="nofollow" class="dropdown-item" href ="<?=  base_url('login/dologout');?>"> 
                      <i class="fa fa-sign-out"></i>
                      <span><?= lang('ui_logout')?></span></a>
                    </li>
                    
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>

      
    
    
<?php
        ob_start();
        include_once("include/include.php");
        $objContact = new contact();
        $objRoles = new roles();



#........... editor ....................................
        $objContent = new CKEditor();
        $objContent->basePath = 'ckeditor/';
        $ckfinder = new CKFinder();
        $ckfinder->BasePath = 'ckfinder/'; // Note: the BasePath property in the CKFinder class starts with a capital letter.
        $ckfinder->SetupCKEditorObject($objContent);
#........... editor ....................................
#...........roles ....................................
        $arrGetAllContact = $objContact->getAll("", "contact_id DESC");
        $getRoles = $objRoles->getRow("user_id=" . $_SESSION['userid']);

        $user = $getRoles['user'];
        $pages = $getRoles['pages'];
        $igallery = $getRoles['imagegallery'];
        $vgallery = $getRoles['videogallery'];
        $dgallery = $getRoles['docgallery'];
        $contact = $getRoles['contact'];
        $job = $getRoles['career'];
        $applicants = $getRoles['applicants'];
        $menu = $getRoles['menu'];
        $banner = $getRoles['banner'];
        $news = $getRoles['news'];
        $events = $getRoles['events'];
        $admissionform = $getRoles['admissionform'];
        $alumniform = $getRoles['alumniform'];
        $quick = $getRoles['quick'];
        $staff = $getRoles['staff'];
        $settings = $getRoles['settings'];
        $web_app = $getRoles['web_app'];
        $profile_edit = $getRoles['profile_edit'];
        $trans_hist = $getRoles['trans_hist'];
        $edit_notes = $getRoles['edit_notes'];
        $mobile_app = $getRoles['mobile_app'];
        $mob_banner = $getRoles['mob_banner'];
        $mob_member = $getRoles['mob_member'];
        $mob_noti = $getRoles['mob_noti'];
        $mob_noti_email = $getRoles['mob_noti_email'];
#...........roles ....................................

        $uid = $_REQUEST['uid'];
        $read = $_REQUEST['read'];
        $pid = isset($_REQUEST['pid']) ? $_REQUEST['pid'] : '0';
        $gall_id = isset($_REQUEST['gall_id']) ? $_REQUEST['gall_id'] : '0';
        $m = $_REQUEST['m'];
        $s = $_REQUEST['s'];
        $success = $_REQUEST['success'];
        $did = isset($_GET['did']) ? $_GET['did'] : "";
        $trans_id = isset($_GET['trans_id']) ? $_GET['trans_id'] : "";
        $ardid = isset($_GET['ardid']) ? $_GET['ardid'] : "";
        $bidar = isset($_GET['bidar']) ? $_GET['bidar'] : "";
        $sod = isset($_GET['sod']) ? $_GET['sod'] : "";
        $bid = isset($_GET['bid']) ? $_GET['bid'] : "";
        $cid = isset($_GET['cid']) ? $_GET['cid'] : "";
        $pgNo = isset($_GET["pgNo"]) ? $_GET["pgNo"] : 1;
        $statid = $_REQUEST['statid'];
        $status = $_REQUEST['status'];
        $priority = $_REQUEST['priority'];
        $searchitem = $_REQUEST['searchitem'];
        //$status          =    $_REQUEST['status'];




        switch ($m) {
                case 1 : $msg = "Data added successfully";
                        break;
                case 2 : $msg = "Data updated successfully";
                        break;
                case 3 : $msg = "Data deleted successfully";
                        break;
                case 4 : $msg = "Status updated successfully";
                        break;
                case 5 : $msg = "Rights updated successfully";
                        break;
                case 6 : $msg = "Wrong file type... Allowed File Types Are(" . implode(',', $arrImgType) . ")";
                        break;
                case 7 : $msg = "Image deleted successfully";
                        break;
                case 8 : $msg = "Products added to offer";
                        break;
                case 9 : $msg = "Priority has been updated";
                        break;
                case 10 : $msg = "Items added to latest list";
                        break;
                case 11 : $msg = "Item has been marked as unreaded";
                        break;
                case 12 : $msg = "Message sent successfully";
                        break;
                case 13 : $msg = "Notifications sent successfully";
                        break;
                case 14 : $msg = "Receipt generated in Skoolee and Smart Systems";
                        break;
                default: break;
        }

        switch ($s) {
                case 1 : $msg = "The item has been unpublished";
                        break;
                case 2 : $msg = "The item has been published successfully";
                        break;
                case 3 : $msg = "Permission granted successfully";
                        break;
                case 4 : $msg = "Permission disabled successfully";
                        break;
                default: break;
        }
?>
<!DOCTYPE html>
<html lang="en">

        <head>

                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible"content="IE=edge">
                <meta name="viewport"content="width=device-width, initial-scale=1">
                <meta name="description"content="">
                <meta name="author"content="">

                <title>Administrator</title>


                <!-- Bootstrap Core CSS -->
                <link href="bower_components/bootstrap/dist/css/bootstrap.min.css"rel="stylesheet">

                <!-- MetisMenu CSS -->
                <link href="bower_components/metisMenu/dist/metisMenu.min.css"rel="stylesheet">

                <!-- Custom CSS -->
                <link href="dist/css/sb-admin-2.css"rel="stylesheet">

                <link href="dist/css/timeline.css" rel="stylesheet">

                <link href="bower_components/morrisjs/morris.css" rel="stylesheet">

                <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
                <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                <!--[if lt IE 9]>
                    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                <![endif]-->
                <!-- Timeline CSS -->
                <link href="css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen"> 

                <!-- Custom Fonts -->
                <link href="bower_components/font-awesome/css/font-awesome.min.css"rel="stylesheet"type="text/css">
                <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
                <link href="bower_components/bootstrap/dist/css/custom.css" rel="stylesheet">
                <link href="css/developercustom.css" rel="stylesheet" media="screen"> 
                <script src="js/Chart.js"></script>
                <script type="text/javascript">

                                function printDiv(divName, update_id) {
                                        var update_id = update_id;
                                        document.cookie = "update_id=" + update_id;
                                        var printContents = document.getElementById(divName).innerHTML;
                                        var originalContents = document.body.innerHTML;
                                        document.body.innerHTML = printContents;
                                        window.print();
                                        document.body.innerHTML = originalContents;
                                        window.location.reload();
                                }

                </script>

        </head>
        <style>
                body {
                        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
                        font-size: 12px !important ;
                        line-height: 1.42857143;
                        color: #333;
                        background-color: #fff;

                }
                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                        padding: 3px !important;
                        line-height: 1.42857143;
                        vertical-align: top;
                        border-top: 1px solid #ddd;
                        font-size: 12px;
                }

        </style>
        <body>

                <div id="wrapper">

                        <!-- Navigation -->
                        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                                <div class="navbar-header">
                                        <button type="button"class="navbar-toggle"data-toggle="collapse"data-target=".navbar-collapse">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                        </button>
                                        <a class="navbar-brand"href="#"> Welcome, <?= $_SESSION["display"] ?> </a>
                                </div>
                                <!-- /.navbar-header -->

                                <ul class="nav navbar-top-links navbar-right">
                                        <?php if ($contact == '1') { ?> <li class="dropdown">
                                                                <a class="dropdown-toggle"data-toggle="dropdown"href="#">
                                                                        <i class="fa fa-envelope fa-fw" style="font-size: large;"></i>  <i class="fa fa-caret-down"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-messages">
                                                                        <?php
                                                                        for ($i = 0; $i < 3; $i++) {
                                                                                ?>
                                                                                <li>
                                                                                        <a href="#">
                                                                                                <div>
                                                                                                        <strong><?= $arrGetAllContact[$i]['name'] ?></strong>
                                                                                                        <span class="pull-right text-muted">
                                                                                                                <em><?= $arrGetAllContact[$i]['pdate'] ?></em>
                                                                                                        </span>
                                                                                                </div>
                                                                                                <div><?= substr($arrGetAllContact[$i]['description'], 0, 100) ?>...</div>
                                                                                        </a>
                                                                                </li>
                                                                                <li class="divider"></li>
                                                                        <?php } ?>
                                                                        <li>
                                                                                <a class="text-center" href="contact.list.php">
                                                                                        <strong>Read All Messages</strong>
                                                                                        <i class="fa fa-angle-right"></i>
                                                                                </a>
                                                                        </li>
                                                                </ul>
                                                                <!-- /.dropdown-messages -->
                                                        </li><?php } ?>
                                        <!-- /.dropdown --><!-- /.dropdown --><!-- /.dropdown -->
                                        <li class="dropdown">
                                                <a class="dropdown-toggle"data-toggle="dropdown"href="#">
                                                        <i class="fa fa-user fa-fw" style="font-size: large;"></i>  <i class="fa fa-caret-down"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-user">
                                                        <?php if ($settings == '1') { ?>  <li><a href="settings.add.php"><i class="fa fa-gear fa-fw"></i> Settings</a></li><?php } ?>
                                                        <li><a href="admin.edit.php"><i class="fa fa-user fa-fw"></i> Edit Profile</a></li>
                                                        <li><a href="admin.change.password.php"><i class="fa fa-edit fa-fw"></i> Change Password</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                                                </ul>
                                                <!-- /.dropdown-user -->
                                        </li>
                                        <!-- /.dropdown -->
                                </ul>
                                <!-- /.navbar-top-links -->

                                <div class="navbar-default sidebar" role="navigation">
                                        <div class="sidebar-nav navbar-collapse">
                                                <ul class="nav"id="side-menu">
                                                        <?php if ($vgallery == '1') { ?>  <li><a href="dashboard.php"><i class="fa fa-windows fa-fw fa-1x" ></i> Dashboard</a></li><?php } ?>

                                                        <?php if ($user == '1') { ?>  <li><a href="admin.list.php"><i class="fa fa-user fa-fw" ></i> Admins </a>


                                                                        </li>
                                                                <?php } ?>

                                                        <?php if ($menu == '1') { ?><li><a href="menu.list.php"><i class="fa fa-th-list" ></i> Menu</a></li><?php } ?>
                                                        <?php if ($pages == '1') { ?><li><a href="page.list.php"><i class="fa fa-list-alt" ></i> Pages</a></li><?php } ?>
                                                        <?php if ($banner == '1') { ?><li><a href="banner.list.php"><i class="fa fa-photo" ></i> Banners</a></li><?php } ?>
                                                        <?php if ($contact == '1') { ?><li><a href="contact.list.php"><i class="fa fa-envelope" ></i> Contacts</a></li><?php } ?>
                                                        <?php if ($quick == '1') { ?><li><a href="quicklinks.list.php"><i class="fa fa-anchor" ></i> Quick Links</a></li><?php } ?>
                                                        <?php if ($staff == '1') { ?><li><a href="staffgallery.list.php"><i class="fa fa-folder-open" ></i> Staff directory</a></li><?php } ?>
                                                        <?php if ($dgallery == '1') { ?> <li><a href="docgallery.list.php"><i class="fa  fa-file-o" ></i> Documents</a></li><?php } ?>
                                                        <?php if ($igallery == '1') { ?><li><a href="imagegallery.list.php"><i class="fa  fa-camera-retro" ></i> Image gallery</a></li><?php } ?>    

                                                        <?php if (($job == '1') OR ( $applicants == '1')) { ?><li><a href="#"><i class="fa fa-columns" ></i> Career<span class="fa arrow"></span></a>

                                                                                <ul class="nav nav-second-level">
                                                                                        <?php if ($applicants == '1') { ?><li><a href="career.list.php">Applicants</a></li><?php } ?>
                                                                                        <?php if ($job == '1') { ?><li><a href="careerpost.list.php">Job Vacancies</a></li><?php } ?>
                                                                                </ul>
                                                                        </li><?php } ?>

                                                        <?php if (($news == '1') OR ( $events == '1')) { ?><li><a href="#"><i class="fa fa-stack-overflow fa-fw" ></i> News & Events<span class="fa arrow"></span></a>
                                                                                <ul class="nav nav-second-level">
                                                                                        <?php if ($news == '1') { ?><li><a href="news.list.php">News</a></li><?php } ?>
                                                                                        <?php if ($events == '1') { ?><li><a href="events.list.php">Events</a></li><?php } ?>
                                                                                </ul>
                                                                        </li><?php } ?>


                                                        <?php if (($admissionform == '1') OR ( $alumniform == '1')) { ?><li><a href="#"><i class="fa fa-sitemap fa-fw"></i> Registration <span class="fa arrow"></span></a>
                                                                                <ul class="nav nav-second-level">
                                                                                        <?php if ($admissionform == '1') { ?><li><a href="admissionform.list.php">Admission Enquiry</a></li><?php } ?>
                                                                                        <?php if ($alumniform == '1') { ?><li><a href="alumniform.list.php">Alumni updates</a></li><?php } ?>

                                                                                </ul>
                                                                        </li><?php } ?>

                                                        <?php if ($profile_edit == '1' || $trans_hist == '1' || $edit_notes == '1') { ?><li ><a href="#"><i class="fa  fa-money fa-fw" ></i> Payment Application<span class="fa arrow"></span></a>

                                                                                <ul class="nav nav-second-level">
                                                                                        <?php if ($profile_edit == '1') { ?> <li><a href="profile.update.list.php">Profile edits received</a></li><?php } ?>
                                                                                        <?php if ($trans_hist == '1') { ?> <li><a href="javascript:void(0);"><b>Transactions - Tuition</b><span class="fa arrow"></span></a>
                                                                                                        <ul class="nav nav-third-level collapse in" aria-expanded="true">
                                                                                                                <li><a href="transaction.slist.php" style="font-size: small;">&nbsp;&nbsp;&nbsp;&nbsp;Successful Transactions</a></li>
                                                                                                                <li><a href="transaction.plist.php" style="font-size: small;">&nbsp;&nbsp;&nbsp;&nbsp;Pending Transactions</a></li>
                                                                                                                <li><a href="transaction.flist.php" style="font-size: small;">&nbsp;&nbsp;&nbsp;&nbsp;Failed Transactions</a></li>
                                                                                                                <li><a href="transaction.tlist.php" style="font-size: small;">&nbsp;&nbsp;&nbsp;&nbsp;Test Transactions</a></li>
                                                                                                        </ul>
                                                                                                </li><?php } ?>
                                                                                        <?php if ($trans_hist == '1') { ?> <li><a href="javascript:void(0);"><b>Transactions - Activities</b><span class="fa arrow"></span></a>
                                                                                                        <ul class="nav nav-third-level collapse in" aria-expanded="true">
                                                                                                                <li><a href="transaction-activity.slist.php" style="font-size: small;">&nbsp;&nbsp;&nbsp;&nbsp;Successful Transactions</a></li>
                                                                                                                <li><a href="transaction-activity.plist.php" style="font-size: small;">&nbsp;&nbsp;&nbsp;&nbsp;Pending Transactions</a></li>
                                                                                                                <li><a href="transaction-activity.flist.php" style="font-size: small;">&nbsp;&nbsp;&nbsp;&nbsp;Failed Transactions</a></li>
                                                                                                                <li><a href="transaction-activity.tlist.php" style="font-size: small;">&nbsp;&nbsp;&nbsp;&nbsp;Test Transactions</a></li>
                                                                                                        </ul>
                                                                                                </li><?php } ?>
                                                                                        <?php if ($edit_notes == '1') { ?> <li><a href="notes.add.php">Add/Edit Notes</a></li><?php } ?>
                                                                                </ul>
                                                                        </li><?php } ?> 
                                                        <?php if ($mob_banner == '1' || $mob_member == '1' || $mob_noti == '1' || $mob_noti_email == '1') { ?><li><a href="#"><i class="fa  fa-mobile fa-fw" ></i> Mobile Application<span class="fa arrow"></span></a>

                                                                                <ul class="nav nav-second-level">
                                                                                        <?php if ($mob_banner == '1') { ?> <li><a href="mobilebanner.list.php">Banners</a></li><?php } ?>
                                                                                        <?php if ($mob_member == '1') { ?>  <li><a href="javascript:void(0);">Users<span class="fa arrow"></a>
                                                                                                        <ul class="nav nav-third-level collapse in" aria-expanded="true">
                                                                                                                <li><a href="mobileappusers.list.php" style="font-size: small;">&nbsp;&nbsp;&nbsp;&nbsp;Registered Users</a></li>
                                                                                                                <li><a href="teacher.list.php" style="font-size: small;">&nbsp;&nbsp;&nbsp;&nbsp;Imported Teachers</a></li>
                                                                                                        </ul>
                                                                                                </li>
                                                                                        <?php } ?>
                                                                                        <?php if ($mob_noti == '1') { ?>  <li><a href="notificationsend.add.php">Send notification</a></li><?php } ?>
                                                                                        <?php if ($mob_noti_email == '1') { ?><li><a href="notification.list.php">View notifications</a></li <?php } ?>
                                                                                </ul>
                                                                        </li><?php } ?> 
                                                </ul>
                                        </div>
                                        <!-- /.sidebar-collapse -->
                                </div>
                                <!-- /.navbar-static-side -->
                        </nav>

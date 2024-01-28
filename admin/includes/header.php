<?php
ob_start();
if ($_SESSION['useremail'] == "" or $_SESSION['role'] == 'User') {
    header('location:../index.php');
    exit();
}

include_once "../include/db.php";

$id = $_SESSION['userid'];
$select_user = $pdo->prepare("select * from tbl_user where userid = $id");
$select_user->execute();
$row = $select_user->fetch(PDO::FETCH_ASSOC);
// exit();
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS Sistemi</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">



</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <!-- <a href="index3.html" class="nav-link">Home</a> -->
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <!-- <a href="#" class="nav-link">Contact</a> -->
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../avatar/<?php echo $row['avatar'];?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="profile.php?id=<?php echo $_SESSION['userid']; ?>" class="d-block"><?php echo $row['fName'].' '.$row['lName'];?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class  with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Ballina
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="category.php" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Kategorit

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="addproduct.php" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Regjistro Produktin
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="productlist.php" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Tabela Produkteve
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pos.php" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    POS

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Raportet e Shitjes
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="orderlist.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Raporti i Shitjes Ditore</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="week.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Raporti i Shitjes Javore</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="month.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Raporti i Shitjes Mujore</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="registration.php" class="nav-link">
                                <i class="nav-icon fas fa-plus-square"></i>
                                <p>
                                    Regjistrimet
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="changepassword.php" class="nav-link">
                                <i class="nav-icon fas fa-user-lock"></i>
                                <p>
                                    Ndrysho Fjalkalimin
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../logout.php" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    DIL
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
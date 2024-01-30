<?php
include_once "include/db.php";
session_start();
if (isset($_POST['btn_login'])) {
    $email = $_POST['txt_emaili'];
    $pasword = $_POST['txt_fjalkalimi'];

    $select = $pdo->prepare("SELECT * FROM tbl_user WHERE useremail = '$email' ");
    $select->execute();

    $row = $select->fetch(PDO::FETCH_ASSOC);

    if (is_array($row)) {
        $db_pass = $row['userpassword'];
        if(password_verify($pasword,$db_pass)) {
            // header('Location:admin/dashboard.php');
            if ($row['useremail'] == $email and $row['role'] == 'Admin') {
                $_SESSION['status'] = "Jeni identifikuar si Administrator";
                $_SESSION['status_code'] = "sussess";
                header('refresh:1;admin/dashboard.php');

                $_SESSION['userid'] = $row['userid'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['useremail'] = $row['useremail'];
                $_SESSION['role'] = $row['role'];
            } else if ($row['useremail'] == $email and $row['role'] == 'Punetor') {
                echo $success = "U Identifikuat si User!";
                header('refresh:1;user/pos.php');
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['useremail'] = $row['useremail'];
                $_SESSION['role'] = $row['role'];
            }
        } else {
            // echo $success = "Emaili/Fjalkalimi gabim!";

            $_SESSION['status'] = "Emaili/Fjalkalimin nuk e keni shtypur!";
            $_SESSION['status_code'] = "error";
        }
    
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS Sistem | Identifikimi</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="index.php"><b>POS</b>Sistem</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Identifikimi ne Sistem</p>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="txt_emaili" placeholder="Emaili">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="txt_fjalkalimi" placeholder="Fjalkalimi">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <a href="forgot-password.html">Ke harruar fjalkalimin?</a>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" name="btn_login">Kyqu</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="plugins/toastr/toastr.min.js"></script>


    <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
        <script>
            $(function() {
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 5000
                        });                       
                            Toast.fire({
                                icon: '<?php echo $_SESSION['status_code'];?>',
                                title: '<?php echo $_SESSION['status'];?>'
                            })
            });
        </script>
    <?php
        unset($_SESSION['status']);
    }
    ?>
</body>

</html>
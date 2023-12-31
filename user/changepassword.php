<?php
include_once '../include/db.php';
session_start();
if (isset($_POST['ndryshoFjalkalimin'])) {
    $fv = $_POST['fjalkalimiVjeter'];
    $fr = $_POST['fjalkalimiRi'];
    $frP = $_POST['fjalkalimiRiP'];


    $email = $_SESSION['useremail'];

    $select = $pdo->prepare("SELECT * from tbl_user where useremail ='$email'");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    //$useremail_db = $row['usermail'];
    $fjalkalimi_db = $row['userpassword'];


    if($fv == $fjalkalimi_db) 
    {
        if($fr == $frP) 
        {
            $update = $pdo->prepare("UPDATE tbl_user set userpassword=:pass where useremail=:email");
            $update->bindParam(':pass',$fr);
            $update->bindParam(':email',$email);

            if($update->execute()){
                $_SESSION['status'] = "Fjalkalimi u ndryshua me sukses!";
                $_SESSION['status_code'] = "success";
            }else{
                $_SESSION['status'] = "Diqka shkoj gabim,Fjalkalimi nuk u Ndryshua!";
                $_SESSION['status_code'] = "error";

            }
            // $_SESSION['status'] = "Fjalkalimi i ri Pershtatet";
            // $_SESSION['status_code'] = "success";
        }else
        {
            $_SESSION['status'] = "Fjalkalimi Ri nuk Pershtatet";
            $_SESSION['status_code'] = "error";
        }
        // $_SESSION['status'] = "Fjalkalimi Pershtatet";
        // $_SESSION['status_code'] = "success";
    }else 
    {
        $_SESSION['status'] = "Fjalkalimi nuk Pershtatet";
        $_SESSION['status_code'] = "error";
    }
}

include_once "includes/header.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="#">Ballina</a></li>
                        <li class="breadcrumb-item active">Admin Dashboard</li> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Ndrysho Fjalklimin</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="" method="post">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Fjalkalimi i Vjeter</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword3" name="fjalkalimiVjeter" placeholder="Fjalkalimi i Vjeter">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Fjalkalimi i Ri</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword3" name="fjalkalimiRi" placeholder="Fjalkalimi Ri">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Fjalkalimi i Ri Perseri</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword3" name="fjalkalimiRiP" placeholder="Fjalkalimi i Ri Perseri">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" name="ndryshoFjalkalimin" class="btn btn-info">Ndrysho Fjalkalimin</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
<!-- /.control-sidebar -->
<?php
include_once "../includes/footer.php";
?>
<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
?>
    <script>
                Swal.fire({
                icon: '<?php echo $_SESSION['status_code']; ?>',
                title: '<?php echo $_SESSION['status']; ?>'
            });
        
    </script>
<?php
    unset($_SESSION['status']);
}
?>
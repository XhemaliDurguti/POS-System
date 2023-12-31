<?php
include_once '../include/db.php';
session_start();


include_once "includes/header.php";
error_reporting(0);

$id =$_GET['id'];

if(isset($id)) {
    $delete= $pdo->prepare("delete from tbl_user where userid = ".$id);
    if($delete->execute()){
        $_SESSION['status'] = "Punetori eshte fshir nga lista me sukses!";
        $_SESSION['status_code'] = "success";
    }else {
        $_SESSION['status'] = "Diqka shkoj gabim gjate fshirjes se punetorit!!!";
        $_SESSION['status_code'] = "error";
    }
}




if (isset($_POST['btnsave'])) {
    $username = $_POST['txtusername'];
    $useremail = $_POST['txtemail'];
    $userpass = $_POST['txtpassword'];
    $userrole = $_POST['txtselect_option'];


    if (isset($_POST['txtemail'])) {
        $select = $pdo->prepare("select useremail from tbl_user where useremail = '$useremail'");
        $select->execute();

        if($select->rowCount()>0){
            $_SESSION['status'] = "Punetori me kete email eshte i regjistruar me heret!!";
            $_SESSION['status_code'] = "warning";
        }else {
            $insert = $pdo->prepare("insert into tbl_user(username, useremail, userpassword,role)values(:name,:email,:pass,:role)");
            // $insert = $pdo->prepare("INSERT INTO tbl_user(userid, username, useremail, userpassword,role) values(:name,:email,:pass,:role)");
            $insert->bindParam(':name', $username);
            $insert->bindParam(':email', $useremail);
            $insert->bindParam(':pass', $userpass);
            $insert->bindParam(':role', $userrole);
            if ($insert->execute()) {
                $_SESSION['status'] = "Punetori u Regjistrua me Sukses!";
                $_SESSION['status_code'] = "success";
            } else {
                $_SESSION['status'] = "Diqka shkoj gabim,Provoni Perseri!";
                $_SESSION['status_code'] = "error";
            }
        }
    }
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0">Regjistrimi i Punetoreve</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <!-- <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Ballina</a></li>
                        <li class="breadcrumb-item active">Admin Dashboard</li>
                    </ol> -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Regjistrimi i Punetoreve</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <form action="" method="post">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Username</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Shtyp username" name="txtusername" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Shtyp email" name="txtemail" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Fjalkalimi</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Fjalkalimi" name="txtpassword" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Roli</label>
                                                <select class="form-control" name="txtselect_option" required>
                                                    <option value="" disabled selected>Cakto Rolin</option>
                                                    <option>Admin</option>
                                                    <option>Punetor</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" name="btnsave">Regjistro</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Username</td>
                                                <td>Email</td>
                                                <td>Roli</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $select = $pdo->prepare("SELECT * FROM tbl_user order by userid desc");
                                            $select->execute();

                                            while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                                echo '
                                                        <tr>
                                                            <td>' . $row->userid . '</td>
                                                            <td>' . $row->username . '</td>
                                                            <td>' . $row->useremail . '</td>
                                                            <td>' . $row->role . '</td>
                                                            <td>
                                                                <a href="registration.php?id='.$row->userid.'" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    ';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
<!-- /.control-sidebar -->
<?php
include_once "includes/footer.php";
?>
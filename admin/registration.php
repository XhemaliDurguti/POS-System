<?php
include_once '../include/db.php';
session_start();


include_once "includes/header.php";
error_reporting(0);

$id = $_GET['id'];

if (isset($id)) {
    $delete = $pdo->prepare("delete from tbl_user where userid = " . $id);
    if ($delete->execute()) {
        $_SESSION['status'] = "Punetori eshte fshir nga lista me sukses!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Diqka shkoj gabim gjate fshirjes se punetorit!!!";
        $_SESSION['status_code'] = "error";
    }
}




if (isset($_POST['btnsave'])) {
    $emri = $_POST['txtemri'];
    $mbiemri = $_POST['txtmbiemri'];
    $username = $_POST['txtusername'];
    $useremail = $_POST['txtemail'];
    $userpass = $_POST['txtpassword'];
    $userrole = $_POST['txtselect_option'];

    $hashP = password_hash($userpass, PASSWORD_DEFAULT);

    if (isset($_POST['txtemail'])) {
        $select = $pdo->prepare("select useremail from tbl_user where useremail = '$useremail'");
        $select->execute();

        if ($select->rowCount() > 0) {
            $_SESSION['status'] = "Punetori me kete email eshte i regjistruar me heret!!";
            $_SESSION['status_code'] = "warning";
        } else {
            $insert = $pdo->prepare("insert into tbl_user(fName,lName,username, useremail, userpassword,role)values(:fname,:lname,:name,:email,:pass,:role)");
            $insert->bindParam(':fname', $emri);
            $insert->bindParam(':lname', $mbiemri);
            $insert->bindParam(':name', $username);
            $insert->bindParam(':email', $useremail);
            $insert->bindParam(':pass', $hashP);
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
if(isset($_POST['btnUpdate'])) {
    $userid = $_POST['userid'];
    $emri = $_POST['txtemri'];
    $mbiemri = $_POST['txtmbiemri'];
    $username = $_POST['txtusername'];
    $useremail = $_POST['txtemail'];
    $userpass = $_POST['txtpassword'];
    $userrole = $_POST['txtselect_option'];

    $update_user = $pdo->prepare("update tbl_user set fName =:emri,lName=:mbiemri,username=:username,useremail=:email,userpassword=:password,role=:roli where userid = $userid");
    $update_user->bindParam(':emri',$emri);
    $update_user->bindParam(':mbiemri',$mbiemri);
    $update_user->bindParam(':username',$username);
    $update_user->bindParam(':email',$useremail);
    $update_user->bindParam(':password',$userpass);
    $update_user->bindParam(':roli',$userrole);

    if($update_user->execute()) {
        $_SESSION['status'] = "Te Dhenat u ndryshuan me sukses!!";
        $_SESSION['status_code'] = "success";
    }else {
        $_SESSION['status'] = "Diqka Shkoj gabim!";
        $_SESSION['status_code'] = "warning";
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
                            <form action="" method="post">

                                <div class="row">
                                    <div class="col-md-4">
                                        <?php
                                        if (isset($_POST['btnedit'])) {
                                            $select_user = $pdo->prepare("select * from tbl_user where userid =".$_POST['btnedit']);
                                            $select_user->execute();
                                            $row = $select_user->fetch(PDO::FETCH_OBJ);
                                            ?>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Emri</label>
                                                        <input type="hidden" class="form-control" name="userid" value="<?php echo $row->userid;?>">
                                                        <input type="text" class="form-control" id="username"  name="txtemri" value="<?php echo $row->fName;?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Mbiemri</label>
                                                        <input type="text" class="form-control" id="username" name="txtmbiemri" value="<?php echo $row->lName;?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control" id="username" name="txtusername" value="<?php echo $row->username ;?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1" name="txtemail" value="<?php echo $row->useremail;?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Fjalkalimi</label>
                                                        <input type="password" class="form-control" name="txtpassword" value="<?php echo $row->userpassword ;?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Roli</label>
                                                        <select class="form-control" name="txtselect_option">

                                                            <option value="" disabled selected>Cakto Rolin</option>
                                                            <option value="Admin"<?php if($row->role == 'Admin') echo 'selected'?>>Admin</option>
                                                            <option value="Punetor" <?php if($row->role == 'Punetor') echo 'selected';?>>Punetor</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-warning" name="btnUpdate">Ndrysho</button>
                                        </div>
                                        <?php
                                        } else {
                                        ?>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Emri</label>
                                                        <input type="text" class="form-control" id="username" placeholder="Shtyp emri" name="txtemri">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Mbiemri</label>
                                                        <input type="text" class="form-control" id="username" placeholder="Shtyp mbiemrin" name="txtmbiemri">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control" id="username" placeholder="Shtyp username" name="txtusername" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Shtyp email" name="txtemail">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Fjalkalimi</label>
                                                        <input type="password" class="form-control" placeholder="Fjalkalimi" name="txtpassword">
                                                        <!-- <input type="password" class="form-control" name="txtpassword" placeholder="Fjalklimi"/> -->
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Roli</label>
                                                        <select class="form-control" name="txtselect_option">
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
                                    <?php
                                        }
                                        ?>


                                    </div>
                                    <div class="col-md-8">
                                        <table class="table table-striped table-hover" id="table_worker">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <td>Emri</td>
                                                    <td>Mbiemri</td>
                                                    <td>Username</td>
                                                    <td>Email</td>
                                                    <td>Fjalkalimi</td>
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
                                                            <td>' . $row->fName . '</td>
                                                            <td>' . $row->lName . '</td>
                                                            
                                                            <td>' . $row->username . '</td>
                                                            <td>' . $row->useremail . '</td>
                                                            <td>' . str_repeat('*', strlen(substr($row->userpassword, 0, 4))) . '</td>';
                                                    if ($row->role == "Admin") {
                                                        echo '<td><span class="badge badge-success">' . $row->role . '</span></td>';
                                                    } else if ($row->role == "Punetor") {
                                                        echo '<td><span class="badge badge-info">' . $row->role . '</span></td>';
                                                    }
                                                    echo '
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="submit" class="btn btn-primary btn-xs" value="' . $row->userid . '" name="btnedit"><i class="fa fa-edit"></i></button>
                                                                    <a href="registration.php?id=' . $row->userid . '" class="btn btn-danger btn-xs"><i class="fa fa-trash-alt"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    ';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
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
<script>
    $(document).ready(function() {
        $('#table_worker').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
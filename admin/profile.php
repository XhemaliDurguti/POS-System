<?php
include_once "../include/db.php";
session_start();
include_once "includes/header.php";

$id = $_SESSION['userid'];
$select_user = $pdo->prepare("select * from tbl_user where userid = $id");
$select_user->execute();
$row = $select_user->fetch(PDO::FETCH_ASSOC);

$emri       = $row['fName'];
$mbiemri    = $row['lName'];
$username   = $row['username'];
$useremail  = $row['useremail'];
$fjalkalimi = $row['userpassword'];
$role       = $row['role'];

if (isset($_POST['updateProfile'])) {
    $txtname        = $_POST['txtemri'];
    $txtmbiemri     = $_POST['txtmbiemri'];
    $txtusername    = $_POST['txtusername'];
    $txtemaili      = $_POST['txtemaili'];
    $txtfjalkalimi  = $_POST['txtfjalkalimi'];
    $txtfjalkalimip    = $_POST['txtfjalkalimiagain'];

    if($txtfjalkalimi == $txtfjalkalimip) {
        $update_profile = $pdo->prepare("update tbl_user set username=:user,userpassword=:pass where userid= $id");
        $update_profile->bindParam(':user', $username);
        $update_profile->bindParam(':pass', $fjalkalimi);

        if($update_profile->execute()){
            $_SESSION['status'] = "Te Dhenat u ndryshuan me sukses!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Diqka shkoj gabim,Te dhenat nuk u Ndryshua!";
            $_SESSION['status_code'] = "error";
        }

    }else {
        $_SESSION['status'] = "Fjalkalimi Ri nuk Pershtatet";
        $_SESSION['status_code'] = "error";
    }
    
}
?>
<div class="content-wrapper">
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Profili</h5>
                    </div>
                    <form action="" method="POST" class="form-horizontal">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Emri</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="txtemri" value="<?php echo $emri; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Mbiemri</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="txtmbiemri" value="<?php echo $mbiemri; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="txtusername" value="<?php echo $username; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Emaili</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="txtemaili" value="<?php echo $useremail; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Roli</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="txtfjalkalimi" value="<?php echo $role; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Fjalkalimi</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="txtfjalkalimi" value="<?php echo $fjalkalimi; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Fjalkalimi Perseri</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="txtfjalkalimiagain" value="<?php echo $fjalkalimi; ?>">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success" name="updateProfile">Ndrysho Profilin</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Foto Profilit</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-8">
                            <img src="../dist/img/avatar3.png" alt="" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
include_once "includes/footer.php";
?>
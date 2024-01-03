<?php
include_once '../include/db.php';
session_start();
include_once 'includes/header.php';

//Regjistrimi i Zbritjes
if (isset($_POST['btnsave'])) {
    $zperqindje = $_POST['txtzbritjaP'];
    $zmoney = $_POST['txtzbritjaM'];
    $zbritja = $_POST['txtzbritja'];


    if (empty($zperqindje)) {
        $_SESSION['status'] = "Nuk i keni plotesuar hapisrat e kerkuara!";
        $_SESSION['status_code'] = "warning";
    } else {
        $insert = $pdo->prepare("insert into tbl_zbritja(zbritjaPerqind,zbritjaPare,VleraZbritjes)values(:zp,:zm,:zbritja)");
        $insert->bindParam(':zp', $zperqindje);
        $insert->bindParam(':zm', $zmoney);
        $insert->bindParam(':zbritja', $zbritja);

        if ($insert->execute()) {
            $_SESSION['status'] = "Zbritja u Regjistrua me sukses!!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Diqka shkoj gabim provoni perseri!!";
            $_SESSION['status_code'] = "error";
        }
    }
}

if (isset($_POST['btnupdate'])) {
    $zid = $_POST['zid'];
    $zperqindje = $_POST['txtzbritjaP'];
    $zmoney = $_POST['txtzbritjaM'];
    $zbritja = $_POST['txtzbritja'];

    if (empty($zperqindje)) {
        $_SESSION['status'] = "Nuk i keni plotesuar hapisrat e kerkuara!";
        $_SESSION['status_code'] = "warning";
    } else {
        $update = $pdo->prepare("update tbl_zbritja set zbritjaPerqind=:zp,zbritjaPare=:zm,VleraZbritjes=:vz where zid =" . $zid);
        $update->bindParam(':zp', $zperqindje);
        $update->bindParam(':zm', $zmoney);
        $update->bindParam(':vz', $zbritja);

        if ($update->execute()) {
            $_SESSION['status'] = "Zbritja u ndryshua me sukses!!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Diqka shkoj gabim provoni perseri!!";
            $_SESSION['status_code'] = "error";
        }
    }
}
?>
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
    <div class="content">
        <div class="container-fluid">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h5 class="m-0">Zbritjet Ofertat</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <?php
                            if (isset($_POST['btnedit'])) {
                                $select = $pdo->prepare("select * from tbl_zbritja where zid = " . $_POST['btnedit']);
                                $select->execute();
                                if ($select) {
                                    $row = $select->fetch(PDO::FETCH_OBJ);
                                    echo '<div class="col-md-4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Zbritja(%)</label>
                                        <input type="hidden" class="form-control" placeholder="zid" name="zid" value="' . $row->zid . '"/>
                                        <input type="text" class="form-control" placeholder="Vlera Zbritjes ne %" value="' . $row->zbritjaPerqind . '"name="txtzbritjaP">
                                    </div>
                                    <div class="form-group">
                                        <label>Zbritja ne Pare</label>
                                        <input type="hidden" class="form-control" placeholder="id" name="catid" />
                                        <input type="text" class="form-control" placeholder="Vlera Zbritjes ne Kesh" name="txtzbritjaM" value="' . $row->zbritjaPare . '">
                                    </div>
                                    <div class="form-group">
                                        <label>Zbritja</label>
                                        <input type="hidden" class="form-control" placeholder="id" name="catid" />
                                        <input type="text" class="form-control" placeholder="Zbritja Finale" name="txtzbritja" value="' . $row->VleraZbritjes . '">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info" name="btnupdate">Ndrysho Zbritjen</button>
                                </div>

                            </div>';
                                }
                            } else {
                                echo '<div class="col-md-4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Zbritja(%)</label>
                                        <input type="text" class="form-control" placeholder="Vlera Zbritjes ne %" name="txtzbritjaP">
                                    </div>
                                    <div class="form-group">
                                        <label>Zbritja ne Pare</label>
                                        <input type="hidden" class="form-control" placeholder="id" name="catid" />
                                        <input type="text" class="form-control" placeholder="Vlera Zbritjes ne Kesh" name="txtzbritjaM">
                                    </div>
                                    <div class="form-group">
                                        <label>Zbritja</label>
                                        <input type="hidden" class="form-control" placeholder="id" name="catid" />
                                        <input type="text" class="form-control" placeholder="Zbritja Finale" name="txtzbritja">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning" name="btnsave">Regjistro Zbritjen</button>
                                </div>

                            </div>';
                            }
                            ?>

                            <div class="col-md-8">
                                <table id="tbl_discount" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Zbritja(%)</td>
                                            <td>Zbritja ne Para</td>
                                            <td>Zbritja</td>
                                            <td>Actions</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select = $pdo->prepare("SELECT * FROM tbl_zbritja order by zid desc");
                                        $select->execute();

                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            echo '
                                                        <tr>
                                                            <td>' . $row->zid . '</td>
                                                            <td>' . $row->zbritjaPerqind . ' %</td>
                                                            <td>' . $row->zbritjaPare . ' &#8364;</td>
                                                            <td>' . $row->VleraZbritjes . ' &#8364;</td>
                                                            <td>
                                                                <button type="submit" class="btn btn-primary" value="' . $row->zid . '" name="btnedit">Edit</button>
                                                            </td>
                                                        </tr>
                                                    ';
                                        }
                                        ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td>#</td>
                                            <td>Zbritja(%)</td>
                                            <td>Zbritja ne Para</td>
                                            <td>Zbritja</td>
                                            <td>Actions</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'includes/footer.php';
?>
<script>
    $(document).ready(function() {
        $('#tbl_discount').DataTable();
    });
</script>
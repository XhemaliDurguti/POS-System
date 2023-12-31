<?php
include_once '../include/db.php';
session_start();

include_once 'includes/header.php';


//Per regjistrim te Kategoris 
if (isset($_POST['btnsave'])) {
    $category = $_POST['txtkategoria'];

    if (empty($category)) {
        $_SESSION['status'] = "Emri i kategoris i zbrazet!!";
        $_SESSION['status_code'] = "warning";
    } else {
        $insert = $pdo->prepare("insert into tbl_category(category) values(:cat)");
        $insert->bindParam(':cat', $category);

        if ($insert->execute()) {
            $_SESSION['status'] = "Kategoria u Regjistrua me sukses!!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Diqka shkoj gabim provoni perseri!!";
            $_SESSION['status_code'] = "error";
        }
    }
}

//Per ndryshim te kategoris
if (isset($_POST['btnupdate'])) {
    $category = $_POST['txtkategoria'];
    $catid = $_POST['catid'];

    if (empty($category)) {
        $_SESSION['status'] = "Emri i kategoris i zbrazet!!";
        $_SESSION['status_code'] = "warning";
    } else {
        $update = $pdo->prepare("update tbl_category set category = :cat where catid=" . $catid);
        $update->bindParam(':cat', $category);

        if ($update->execute()) {
            $_SESSION['status'] = "Kategoria u ndryshua me sukses!!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Diqka shkoj gabim provoni perseri!!";
            $_SESSION['status_code'] = "error";
        }
    }
}

//Per fshirjen e Kategoris
if (isset($_POST['btndelete'])) {
    $delete = $pdo->prepare("delete from tbl_category where catid=" . $_POST['btndelete']);

    if ($delete->execute()) {
        $_SESSION['status'] = "Kategoria eshte fshire me sukses!!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Diqka shkoj gabim provoni perseri!!";
        $_SESSION['status_code'] = "error";
    }
} else {
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
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h5 class="m-0">Regjistrimi i Kategorive</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <?php
                            if (isset($_POST['btnedit'])) {
                                $select = $pdo->prepare("SELECT * FROM tbl_category where catid =" . $_POST['btnedit']);
                                $select->execute();
                                if ($select) {
                                    $row = $select->fetch(PDO::FETCH_OBJ);
                                    echo '<div class="col-md-4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Emri Kategoris</label>
                                        <input type="hidden" class="form-control" placeholder="id" name="catid" value="' . $row->catid . '"/>
                                        <input type="text" class="form-control" placeholder="Emri i Kategoris" name="txtkategoria" value="' . $row->category . '">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info" name="btnupdate">Ndrysho Kategorin</button>
                                </div>

                            </div>';
                                }
                            } else {
                                echo '<div class="col-md-4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Emri Kategoris</label>
                                        <input type="text" class="form-control" placeholder="Emri i Kategoris" name="txtkategoria">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning" name="btnsave">Regjistro Kategorin</button>
                                </div>

                            </div>';
                            }
                            ?>

                            <div class="col-md-8">
                                <table id="tbl_category" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Kategoria</td>
                                            <td>Ndrysho</td>
                                            <td>Fshije</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select = $pdo->prepare("SELECT * FROM tbl_category order by catid desc");
                                        $select->execute();

                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            echo '
                                                        <tr>
                                                            <td>' . $row->catid . '</td>
                                                            <td>' . $row->category . '</td>
                                                            <td>
                                                                <button type="submit" class="btn btn-primary" value="' . $row->catid . '" name="btnedit">Edit</button>
                                                            </td>
                                                            <td>
                                                                <button type="submit" class="btn btn-danger" value="' . $row->catid . '" name="btndelete">Fshije</button>
                                                            </td>
                                                        </tr>
                                                    ';
                                        }
                                        ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td>#</td>
                                            <td>Kategoria</td>
                                            <td>Ndrysho</td>
                                            <td>Fshije</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
        $('#tbl_category').DataTable();
    });
</script>
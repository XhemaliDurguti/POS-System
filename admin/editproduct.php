<?php
include_once '../include/db.php';
session_start();
include_once "includes/header.php";
$id = $_GET['id'];

$select = $pdo->prepare("select * from tbl_product where pid=$id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

$id_db = $row['pid'];
$barcode_db = $row['barcode'];
$product_db = $row['product'];
$category_db = $row['category'];
$desc_db = $row['description'];
$stock_db = $row['stock'];
$pprice_db = $row['purchaseprice'];
$ssprice_db = $row['salesprice'];
$image_db = $row['image'];


if (isset($_POST['btneditproduct'])) {
    $emri = $_POST['txtprodukti'];
    $cate = $_POST['txtcat'];
    $desc = $_POST['txtdesc'];
    $stock = $_POST['txtstock'];
    $purchaseprice = $_POST['txtpurchaseprice'];
    $salesprice = $_POST['txtsalesprice'];
    // $image = $_POST['productimage'];

    $f_name = $_FILES['myfile']['name'];
    
    if(!empty($f_name)){
        $f_tmp = $_FILES['myfile']['tmp_name'];

        $f_size = $_FILES['myfile']['size'];

        $f_extension = explode('.', $f_name);
        $f_extension = strtolower(end($f_extension));

        $f_newfile = uniqid() . '.' . $f_extension;
        $store = "../productimage/" . $f_newfile;

        if ($f_extension == 'jpg' || $f_extension == 'png' || $f_extension == 'gif') {
            if ($f_size >= 1000000) {
                $_SESSION['status'] = "Madhesia e Fotos eshte e madhe!";
                $_SESSION['status_code'] = "warning";
            } else {
                if (move_uploaded_file($f_tmp, $store)) {
                    $f_newfile;
                    $update = $pdo->prepare("update tbl_product set product=:product,category =:cate,description=:desc,stock=:stock,purchaseprice=:pprice,salesprice=:sprice,image=:image where pid = $id");
                    $update->bindParam(':product', $emri);
                    $update->bindParam(':cate', $cate);
                    $update->bindParam(':desc', $desc);
                    $update->bindParam(':stock', $stock);
                    $update->bindParam(':pprice', $purchaseprice);
                    $update->bindParam(':sprice', $salesprice);
                    $update->bindParam(':image', $f_newfile);

                    if ($update->execute()) {
                        $_SESSION['status'] = "Te Dhenat e Produktit bashk me Foton u ndryshuan me sukses!";
                        $_SESSION['status_code'] = "success";
                    } else {
                        $_SESSION['status'] = "Diqka Shkoj gabim!";
                        $_SESSION['status_code'] = "warning";
                    }
                }
            }
        }

    }else {
        $update=$pdo->prepare("update tbl_product set product=:product,category =:cate,description=:desc,stock=:stock,purchaseprice=:pprice,salesprice=:sprice,image=:image where pid = $id");
        $update->bindParam(':product',$emri);
        $update->bindParam(':cate',$cate);
        $update->bindParam(':desc',$desc);
        $update->bindParam(':stock',$stock);
        $update->bindParam(':pprice',$purchaseprice);
        $update->bindParam(':sprice',$salesprice);
        $update->bindParam(':image',$image_db);

        if($update->execute()){
            $_SESSION['status'] ="Te Dhenat e Produktit u ndryshuan me sukses!";
            $_SESSION['status_code'] = "success";
        }else{
            $_SESSION['status'] = "Diqka Shkoj gabim!";
            $_SESSION['status_code'] = "warning";
        }
    }
}


$select = $pdo->prepare("select * from tbl_product where pid=$id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

$id_db = $row['pid'];
$barcode_db = $row['barcode'];
$product_db = $row['product'];
$category_db = $row['category'];
$desc_db = $row['description'];
$stock_db = $row['stock'];
$pprice_db = $row['purchaseprice'];
$ssprice_db = $row['salesprice'];
$image_db = $row['image'];

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0">Admin Dashboard</h1> -->
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
                <div class="col-lg-12">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Ndrysho Produktin</h5>
                        </div>
                        <form action="" method="post" name="formeditproduct" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Barcodi</label>
                                            <input type="text" class="form-control" value="<?php echo $barcode_db; ?>" name="txtbarcodi" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Produkti</label>
                                            <input type="text" class="form-control" value="<?php echo $product_db; ?>" name="txtprodukti" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kategoria</label>
                                            <select name="txtcat" class="form-control">
                                                <option value="" disabled selected>Kategoria Produktit</option>
                                                <?php
                                                $select = $pdo->prepare("select * from tbl_category order by catid desc");
                                                $select->execute();

                                                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                                                    extract($row);
                                                ?>
                                                    <option <?php
                                                            if ($row['category'] == $category_db) {
                                                            ?> selected="selected" <?php
                                                                                }
                                                                                    ?>>
                                                        <?php echo $row['category']; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pershkrimi</label>
                                            <textarea class="form-control" placeholder="Pershkrimi Produktit" rows="4" name="txtdesc" required><?php echo $desc_db; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sasia ne Depo</label>
                                            <input type="number" min="1" step="any" class="form-control" value="<?php echo $stock_db; ?>" name="txtstock" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Cmimi Blerjes</label>
                                            <input type="number" min="1" step="any" class="form-control" value="<?php echo $pprice_db; ?>" name="txtpurchaseprice" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Cmimi Shitjes</label>
                                            <input type="number" min="1" step="any" class="form-control" value="<?php echo $ssprice_db; ?>" name="txtsalesprice" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Foto Produktit</label><br/>
                                            <image src="../productimage/<?php echo $image_db?>" class="img-rounded" width="50px" height="50px" /><br/>
                                            <input type="file" class="input-group" name="myfile">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success" name="btneditproduct">Ndrysho Produktin</button>
                                </div>
                            </div>
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
include_once "includes/footer.php";
?>
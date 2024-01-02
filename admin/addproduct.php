<?php
include_once '../include/db.php';
session_start();

include_once 'includes/header.php';

if (isset($_POST['btnsave'])) {
    $barcode = $_POST['txtbarcodi'];
    $emri = $_POST['txtprodukti'];
    $cate = $_POST['txtcat'];
    $desc = $_POST['txtdesc'];
    $stock = $_POST['txtstock'];
    $purchaseprice = $_POST['txtpurchaseprice'];
    $salesprice = $_POST['txtsalesprice'];
   // $image = $_POST['productimage'];

    $f_name = $_FILES['myfile']['name'];
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
                $productimage = $f_newfile;
                if(empty($barcode)) {
                    $_SESSION['status'] = "Barcodi i zbrazet!!";
                    $_SESSION['status_code'] = "warning";
                }else {
                    $insert = $pdo->prepare("insert into tbl_product(barcode,product,category,description,stock,purchaseprice,salesprice,image)values(:barcode,:product,:cate,:desc,:stock,:pprice,:sprice,:img)");
                    $insert->bindParam(':barcode',$barcode);
                    $insert->bindParam(':product',$emri);
                    $insert->bindParam(':cate',$cate);
                    $insert->bindParam(':desc',$desc);
                    $insert->bindParam(':stock',$stock);
                    $insert->bindParam(':pprice',$purchaseprice);
                    $insert->bindParam(':sprice',$salesprice);
                    $insert->bindParam(':img', $productimage);

                    if($insert->execute()){
                        $_SESSION['status'] = "Produkti u Regjistrua me Sukses!";
                        $_SESSION['status_code'] = "success";
                    }else {
                        $_SESSION['status'] = "Gjate regjistrimi te produktit diqka shkoj gabim provoni perseri!";
                        $_SESSION['status_code'] = "warning";
                    }

                }
            }
        }
    } else {
        $_SESSION['status'] = "Foto duhet te jete ne formatin jpg,png ose gif";
        $_SESSION['status_code'] = "warning";
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
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Regjistrimi i Produkteve</h5>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Barcodi</label>
                                            <input type="text" class="form-control" placeholder="Shtyp Barkodin e Produktit" name="txtbarcodi" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Produkti</label>
                                            <input type="text" class="form-control" placeholder="Shtyp Emrin e Produktit" name="txtprodukti" required>
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
                                                    <option><?php echo $row['category']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pershkrimi</label>
                                            <textarea class="form-control" placeholder="Pershkrimi Produktit" rows="4" name="txtdesc" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sasia ne Depo</label>
                                            <input type="number" min="1" step="any" class="form-control" placeholder="Shtyp sasin ne Depo" name="txtstock" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Cmimi Blerjes</label>
                                            <input type="number" min="1" step="any" class="form-control" placeholder="Shtyp cmimin e blrejes" name="txtpurchaseprice" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Cmimi Shitjes</label>
                                            <input type="number" min="1" step="any" class="form-control" placeholder="Shtyp cmimin e shitjes" name="txtsalesprice" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Foto Produktit</label>
                                            <input type="file" class="input-group" name="myfile" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name="btnsave">Regjistro Produktin</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'includes/footer.php';
?>
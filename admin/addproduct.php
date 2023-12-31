<?php
include_once '../include/db.php';
session_start();

include_once 'includes/header.php';
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
                        <form action="" method="post">
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
                                            <input type="number" min="1" step="any" class="form-control" placeholder="Shtyp sasin ne Depo" name="txt_stock" required>
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
                                            <input type="file" class="input-group" name="productimage" required>
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
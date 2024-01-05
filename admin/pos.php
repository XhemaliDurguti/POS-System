<?php
include_once '../include/db.php';
session_start();


include_once "includes/header.php";
?>
<style type="text/css">
    .tableFixedHead {
        overflow: scroll;
        height: 520px;
    }

    .tableFixedHead thead th {
        position: sticky;
        top: 0;
        z-index: 1;
    }

    table {
        border-collapse: collapse;
        width: 100px;
    }

    th,
    td {
        padding: 8px 16px;
    }

    th {
        background: #eee;
    }
</style>
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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">POS Sistemi i Shitjes</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Skano Barkodin">
                                    </div>
                                    <select class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>

                                    <hr />
                                    <div class="tableFixedHead">
                                        <table id="producttable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Produkti</th>
                                                    <th>Depo</th>
                                                    <th>Cmimi</th>
                                                    <th>Sasia</th>
                                                    <th>Nen Totali</th>
                                                    <th>Fshije</th>
                                                </tr>
                                            </thead>
                                            <tbody class="details" id="itemtable">
                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                    <td>183</td>
                                                    <td>John Doe</td>
                                                    <td>11-7-2014</td>
                                                    <td>Approved</td>
                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                    <td>Approved</td>
                                                </tr>
                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                    <td>183</td>
                                                    <td>John Doe</td>
                                                    <td>11-7-2014</td>
                                                    <td>Approved</td>
                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                    <td>Approved</td>
                                                </tr>
                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                    <td>183</td>
                                                    <td>John Doe</td>
                                                    <td>11-7-2014</td>
                                                    <td>Approved</td>
                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                    <td>Approved</td>
                                                </tr>
                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                    <td>183</td>
                                                    <td>John Doe</td>
                                                    <td>11-7-2014</td>
                                                    <td>Approved</td>
                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                    <td>Approved</td>
                                                </tr>
                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                    <td>183</td>
                                                    <td>John Doe</td>
                                                    <td>11-7-2014</td>
                                                    <td>Approved</td>
                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                    <td>Approved</td>
                                                </tr>
                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                    <td>183</td>
                                                    <td>John Doe</td>
                                                    <td>11-7-2014</td>
                                                    <td>Approved</td>
                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                    <td>Approved</td>
                                                </tr>
                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                    <td>183</td>
                                                    <td>John Doe</td>
                                                    <td>11-7-2014</td>
                                                    <td>Approved</td>
                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                    <td>Approved</td>
                                                </tr>
                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                    <td>183</td>
                                                    <td>John Doe</td>
                                                    <td>11-7-2014</td>
                                                    <td>Approved</td>
                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                    <td>Approved</td>
                                                </tr>
                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                    <td>183</td>
                                                    <td>John Doe</td>
                                                    <td>11-7-2014</td>
                                                    <td>Approved</td>
                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                    <td>Approved</td>
                                                </tr>
                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                    <td>183</td>
                                                    <td>John Doe</td>
                                                    <td>11-7-2014</td>
                                                    <td>Approved</td>
                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                    <td>Approved</td>
                                                </tr>
                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                    <td>183</td>
                                                    <td>John Doe</td>
                                                    <td>11-7-2014</td>
                                                    <td>Approved</td>
                                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                                    <td>Approved</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Nentotali</span>
                                        </div>
                                        <input type="text" class="form-control" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text">&#8364;</span>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Zbritja</span>
                                        </div>
                                        <input type="text" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Zbritja</span>
                                        </div>
                                        <input type="text" class="form-control" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text">&#8364;</span>
                                        </div>
                                    </div>

                                    <hr style="height:2px;border-width:0;color:black;background-color:black;">

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">TOTALI</span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg total" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text">&#8364;</span>
                                        </div>
                                    </div>

                                    <hr style="height:2px;border-width:0;color:black;background-color:black;">

                                    <div class="icheck-success d-inline">
                                        <input type="radio" name="r3" checked id="radioSuccess1">
                                        <label for="radioSuccess1">
                                            Para
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="r3" id="radioSuccess2">
                                        <label for="radioSuccess2">
                                            KARTEL
                                        </label>
                                    </div>
                                    <div class="icheck-danger d-inline">
                                        <input type="radio" name="r3" id="radioSuccess3">
                                        <label for="radioSuccess3">
                                            BORXH
                                        </label>
                                    </div>

                                    <hr style="height:2px;border-width:0;color:black;background-color:black;">

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Para kesh</span>
                                        </div>
                                        <input type="text" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">&#8364;</span>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Kusuri</span>
                                        </div>
                                        <input type="text" class="form-control" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text">&#8364;</span>
                                        </div>
                                    </div>

                                    <hr style="height:2px;border-width:0;color:black;background-color:black;">

                                    <input type="button" value="Save Order" class="btn btn-primary">
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
<script>
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>
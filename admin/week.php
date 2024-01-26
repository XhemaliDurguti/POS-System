<?php
include_once '../include/db.php';
session_start();
include_once 'includes/header.php';
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
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Raporti i Shitjes Javore</b></h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="tbl_ordertoday">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Nr Faktures</td>
                                        <td>Data Faktures</td>
                                        <td>Nentotali</td>
                                        <td>Zbritja(%)</td>
                                        <td>Zbritja(E)</td>
                                        <td>Para ne Dor</td>
                                        <td>Kusuri</td>
                                        <td>Totali</td>
                                        <td>Kesh</td>
                                        <td>Veprimet</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $select = $pdo->prepare("select * from tbl_invoice where week(order_date,1) = week(now(),1) and dayofweek(order_date)");
                                    $select->execute();
                                    while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                        echo '<tr>
                                                <td>' . $i++ . '</td>
                                                <td>' . $row->invoice_id . '</td>
                                                <td>' . $row->order_date . '</td>
                                                <td>' . $row->subtotal . ' &euro;</td>
                                                <td>' . $row->zbritjaPerqindje . '%</td>
                                                <td>' . $row->zbritja . '&euro;</td>
                                                <td>' . $row->kesh . '&euro;</td>
                                                <td>' . $row->kusuri . '&euro;</td>
                                                <td>' . $row->totali . '&euro;</td>';
                                        if ($row->mPageses == 'Para') {
                                            echo '<td><span class="badge badge-success">' . $row->mPageses . '</span></td>';
                                        } else if ($row->mPageses == 'Kartel') {
                                            echo '<td><span class="badge badge-primary">' . $row->mPageses . '</span></td>';
                                        } else {
                                            echo '<td><span class="badge badge-danger">' . $row->mPageses . '</span></td>';
                                        }

                                        echo '
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="printbill.php?id=' . $row->invoice_id . '" class="btn btn-primary" role="button"><span class="fa fa-print" style="color:#ffffff" data-toggle="tooltip" title="Printo Fakturen"></span></a>
                                                        <a href="editorderpos.php?id=' . $row->invoice_id . '" class="btn btn-success" role="button"><span class="fa fa-edit" style="color:#ffffff" data-toggle="tooltip" title="Ndrysho Fakturen"></span></a>
                                                    </div>
                                                </td>
                                            </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
        $('#tbl_ordertoday').DataTable({
            "order": [
                [0, "desc"]
            ]
        });
    });

    $(document).ready(function() {
        $('[data-toggle=" tooltip"]').tooltip();
    });
</script>
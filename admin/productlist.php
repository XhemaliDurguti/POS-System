<?php
include_once '../include/db.php';
session_start();


include_once "includes/header.php";
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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Lista e Produkteve</h5>
                        </div>
                        <div class="card-body">
                            <table id="tbl_product" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Barkodi</td>
                                        <td>Produkti</td>
                                        <td>Kategoria</td>
                                        <td>Pershkrimi</td>
                                        <td>Sasia ne Depo</td>
                                        <td>Cmimi Blerjes</td>
                                        <td>Cmimi Shitjes</td>
                                        <td>Foto</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select = $pdo->prepare("SELECT * FROM tbl_product order by pid desc");
                                    $select->execute();

                                    while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                        echo '
                                                        <tr>
                                                            <td>' . $row->pid . '</td>
                                                            <td>' . $row->barcode . '</td>
                                                            <td>' . $row->product . '</td>
                                                            <td>' . $row->category . '</td>
                                                            <td>' . $row->description . '</td>
                                                            <td>' . $row->stock . '</td>
                                                            <td>' . $row->purchaseprice . '</td>
                                                            <td>' . $row->salesprice . '</td>
                                                            <td><image src="../productimage/' . $row->image . '" class="img-rounded" width="40" height="40"></td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <a href="printbarcode.php?id=' . $row->pid . '" class="btn btn-dark btn-xs" role="button"><span class="fa fa-barcode" style="color:#ffffff" data-toggle="tooltip" title="Printo Barcodin"></span></a>
                                                                    <a href="viewproduct.php?id=' . $row->pid . '" class="btn btn-warning btn-xs" role="button"><span class="fa fa-eye" style="color:#ffffff" data-toggle="tooltip" title="View Produkt"></span></a>
                                                                    <a href="editproduct.php?id=' . $row->pid . '" class="btn btn-success btn-xs" role="button"><span class="fa fa-edit" style="color:#ffffff" data-toggle="tooltip" title="Ndrysho Produktin"></span></a>
                                                                    <button id=' . $row->pid . ' class="btn btn-danger btn-xs btndelete"><span class="fa fa-trash-alt" style="color:#ffffff" data-toggle="tooltip" title="Fshije"></span></button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    ';
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>#</td>
                                        <td>Barkodi</td>
                                        <td>Produkti</td>
                                        <td>Kategoria</td>
                                        <td>Pershkrimi</td>
                                        <td>Sasia ne Depo</td>
                                        <td>Cmimi Blerjes</td>
                                        <td>Cmimi Shitjes</td>
                                        <td>Foto</td>
                                        <td>Action</td>
                                    </tr>
                                </tfoot>
                            </table>
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
    $(document).ready(function() {
        $('#tbl_product').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    $(document).ready(function() {
        $('.btndelete').click(function() {
            var tdt = $(this);
            var id = $(this).attr("id");


            Swal.fire({
                title: "Deshironi ta Fshini Produktin?",
                text: "Produkti i Fshire nuk mund te kthehet!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "PO Fshije"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: 'productdelete.php',
                        type: 'post',
                        data: {
                            pidd: id
                        },
                        success: function(data) {
                            tdh.parents('tr').hide();
                        }
                    });
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });

        });
    });
</script>
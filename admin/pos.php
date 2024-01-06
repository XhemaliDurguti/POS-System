<?php
include_once '../include/db.php';
session_start();


include_once "includes/header.php";

function fill_product($pdo)
{
    $output = '';
    $select = $pdo->prepare("select * from tbl_product order by product desc");
    $select->execute();

    $result = $select->fetchAll();
    foreach ($result as $row) {
        $output .= '<option value="' . $row["pid"] . '">' . $row["product"] . '</option>';
    }
    return $output;
}


$select = $pdo->prepare("select * from tbl_zbritja where zid = 1");
$select->execute();
$row = $select->fetch(PDO::FETCH_OBJ);

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
                                        <input type="text" class="form-control" placeholder="Skano Barkodin" id="txtbarcode_id">
                                    </div>
                                    <select class="form-control select2" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        <option>Percakto Produktin</option>
                                        <?php echo fill_product($pdo); ?>
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
                                        <input type="text" class="form-control" id="nentotali" readonly>
                                        <div class=" input-group-append">
                                        <span class="input-group-text">&#8364;</span>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Zbritja</span>
                                    </div>
                                    <input type="text" class="form-control" value="<?php echo $row->zbritjaPerqind; ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Zbritja</span>
                                    </div>
                                    <input type="text" class="form-control" value="<?php echo $row->zbritjaPare; ?>" readonly>
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

    //Kerkimi permes Scan Barcode
    var productarr = [];
    $(function() {
        $('#txtbarcode_id').on('change', function() {
            var barcode = $("#txtbarcode_id").val();

            $.ajax({
                url: "getproduct.php",
                method: "get",
                dataType: "json",
                data: {
                    id: barcode
                },
                success: function(data) {


                    if (jQuery.inArray(data["pid"], productarr) !== -1) {
                        var actualqty = parseInt($('#qty_id' + data["pid"]).val()) + 1;
                        $('#qty_id' + data["pid"]).val(actualqty);

                        var saleprice = parseInt(actualqty) * data["salesprice"];
                        // console.log(saleprice);
                        $('#saleprice_id' + data["pid"]).html(saleprice);
                        $('#saleprice_idd' + data["pid"]).val(saleprice);

                        $("#txtbarcode_id").val("");
                        calculate();
                    } else {
                        addrow(data["pid"], data["product"], data["salesprice"], data["stock"], data["barcode"]);
                        productarr.push(data["pid"]);
                        $("#txtbarcode_id").val();

                        function addrow(pid, product, saleprice, stock, barcode) {
                            var tr = '<tr>' +
                                '<td style="text-align:left;vertical-align:middle; font-size:17px;"><class="form-control product_c" name="product_arr[]"<span class="badge badge-dark">' + product + '</span><input type="hidden" class="form-control pid" name="pid_arr[]" value="' + pid + '"> </td>' +
                                '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-primary stocklbl" name="stock_arr[]" id="stock_id' + pid + '">' + stock + '</span><input type="hidden" class="form-control stock_c" name="stock_c_arr[]" id="stock_idd' + pid + '" value="' + stock + '"></td>' +
                                '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-primary price" name="price_arr[]" id="price_id' + pid + '">' + saleprice + '</span><input type="hidden" class="form-control price_c" name="price_c_arr[]" id="price_idd' + pid + '" value="' + saleprice + '"></td>' +
                                '<td><input type="text" class="form-control qty" name="quantity_arr[]" id="qty_id' + pid + '" value="' + 1 + '" size="1"></td>' +
                                '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-danger totalamt" name="netamt_arr[]" id="saleprice_id' + pid + '">' + saleprice + '</span><input type="hidden" class="form-control saleprice" name="saleprice_arr[]" id="saleprice_idd' + pid + '" value="' + saleprice + '"></td>' +
                                '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><center><name="remove" class="btnremove" data-id="' + pid + '"><span class="fas fa-trash" style="color:red;"></span></center></td>' +
                                '<tr';
                            $('.details').append(tr);

                        } //end function addrow
                    }
                }
            })
        })
    });
    //Kerkimi i Produktit permes Dropdown 
    var productarr = [];
    $(function() {
        $('.select2').on('change', function() {
            var productid = $(".select2").val();

            $.ajax({
                url: "getproduct.php",
                method: "get",
                dataType: "json",
                data: {
                    id: productid
                },
                success: function(data) {


                    if (jQuery.inArray(data["pid"], productarr) !== -1) {
                        var actualqty = parseInt($('#qty_id' + data["pid"]).val()) + 1;
                        $('#qty_id' + data["pid"]).val(actualqty);

                        var saleprice = parseInt(actualqty) * data["salesprice"];
                        // console.log(saleprice);
                        $('#saleprice_id' + data["pid"]).html(saleprice);
                        $('#saleprice_idd' + data["pid"]).val(saleprice);

                        $("#txtbarcode_id").val("");
                        calculate();
                    } else {
                        addrow(data["pid"], data["product"], data["salesprice"], data["stock"], data["barcode"]);
                        productarr.push(data["pid"]);
                        $("#txtbarcode_id").val();

                        function addrow(pid, product, saleprice, stock, barcode) {
                            var tr = '<tr>' +
                                '<td style="text-align:left;vertical-align:middle; font-size:17px;"><class="form-control product_c" name="product_arr[]"<span class="badge badge-dark">' + product + '</span><input type="hidden" class="form-control pid" name="pid_arr[]" value="' + pid + '"> </td>' +
                                '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-primary stocklbl" name="stock_arr[]" id="stock_id' + pid + '">' + stock + '</span><input type="hidden" class="form-control stock_c" name="stock_c_arr[]" id="stock_idd' + pid + '" value="' + stock + '"></td>' +
                                '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-primary price" name="price_arr[]" id="price_id' + pid + '">' + saleprice + '</span><input type="hidden" class="form-control price_c" name="price_c_arr[]" id="price_idd' + pid + '" value="' + saleprice + '"></td>' +
                                '<td><input type="text" class="form-control qty" name="quantity_arr[]" id="qty_id' + pid + '" value="' + 1 + '" size="1"></td>' +
                                '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-danger totalamt" name="netamt_arr[]" id="saleprice_id' + pid + '">' + saleprice + '</span><input type="hidden" class="form-control saleprice" name="saleprice_arr[]" id="saleprice_idd' + pid + '" value="' + saleprice + '"></td>' +
                                '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><center><name="remove" class="btnremove" data-id="' + pid + '"><span class="fas fa-trash" style="color:red;"></span></center></td>' +
                                '<tr';
                            $('.details').append(tr);
                            calculate();

                        } //end function addrow
                    }
                }
            })
        })
    });
    $("#itemtable").delegate(".qty", "keyup change", function() {
        // console.log("hello Qty");
        var quantity = $(this);
        var tr = $(this).parent().parent();

        if ((quantity.val() - 0) > (tr.find(".stock_c").val() - 0)) {
            Swal.fire("Kujdes!", "Sasia me e madhe se ne depo", "warning");
            quantity.val(1);

            tr.find(".totalamt").text(quantity.val() * tr.find(".price").text());
            tr.find(".saleprice").val(quantity.val() * tr.find(".price").text());

        } else {
            tr.find(".totalamt").text(quantity.val() * tr.find(".price").text());
            tr.find(".saleprice").val(quantity.val() * tr.find(".price").text());
        }
    });

    function calculate() {
        var nentotali = 0;
        var zbritja = 0;
        var zbritjaP = 0;
        var totali = 0;
        var paid_amt = 0;
        var due = 0;


        $(".saleprice").each(function() {
            nentotali = nentotali + ($(this).val() * 1);
        });

        $("#nentotali").val(nentotali.toFixed(2));
    }
</script>
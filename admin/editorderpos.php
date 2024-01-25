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

$id = $_GET['id'];

$select = $pdo->prepare("select * from tbl_invoice where invoice_id=$id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
//var_dump($row);
$order_date = date('Y-m-d', strtotime($row['order_date']));

$db_subtotal = $row['subtotal'];
$db_totali = $row['totali'];
$db_zbritjap = $row['zbritjaPerqindje'];
$db_zbritja = $row['zbritja'];
$db_mpages = $row['mPageses'];
$db_kesh = $row['kesh'];
$db_kusuri = $row['kusuri'];


$select = $pdo->prepare("select * from tbl_invoice_details where invoice_id = $id");
$select->execute();
$row_invoice_details = $select->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['btnupdateOrder'])) {
    echo 'Faktura u Ndryshua';
}
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
                    <form action="" method="post">
                        <div class="card card-danger card-outline">
                            <div class="card-header">
                                <h5 class="m-0">Ndryshimi i Faktures</h5>
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
                                            <input type="text" class="form-control" name="nentotali" id="nentotali" value="<?php echo $db_subtotal; ?>" readonly>
                                            <div class=" input-group-append">
                                                <span class="input-group-text">&#8364;</span>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Zbritja</span>
                                            </div>
                                            <input type="text" class="form-control" name="zbritja_p" id="zbritja_p" value="<?php echo $db_zbritjap; ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Zbritja</span>
                                            </div>
                                            <input type="text" class="form-control" name="zbritja_m" id="zbritja_m" value="<?php echo $db_zbritja; ?>" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">&#8364;</span>
                                            </div>
                                        </div>

                                        <hr style="height:2px;border-width:0;color:black;background-color:black;">

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">TOTALI</span>
                                            </div>
                                            <input type="text" class="form-control form-control-lg total" name="grandTotal" id="grandTotal" value="<?php echo $db_totali; ?>" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">&#8364;</span>
                                            </div>
                                        </div>

                                        <hr style="height:2px;border-width:0;color:black;background-color:black;">

                                        <div class="icheck-success d-inline">
                                            <input type="radio" name="rb" value="Para" id="radioSuccess1" value="Para" <?php echo ($db_mpages == 'Para') ? 'checked' : '' ?>>
                                            <label for="radioSuccess1">
                                                Para
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" name="rb" id="radioSuccess2" value="Kartel" <?php echo ($db_mpages == 'Kartel') ? 'checked' : '' ?>>
                                            <label for="radioSuccess2">
                                                KARTEL
                                            </label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" name="rb" id="radioSuccess3" value="Borxh" <?php echo ($db_mpages == 'Borxh') ? 'checked' : '' ?>>
                                            <label for="radioSuccess3">
                                                BORXH
                                            </label>
                                        </div>

                                        <hr style="height:2px;border-width:0;color:black;background-color:black;">

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Para kesh</span>
                                            </div>
                                            <input type="text" class="form-control" name="txtpaid" id="txtpaid" value="<?php echo $db_kesh; ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text">&#8364;</span>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Kusuri</span>
                                            </div>
                                            <input type="text" class="form-control" name="txt_kusuri" id="txt_kusuri" value="<?php echo $db_kusuri; ?>" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">&#8364;</span>
                                            </div>
                                        </div>

                                        <hr style="height:2px;border-width:0;color:black;background-color:black;">

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-info" name="btnupdateOrder">Ndrysho Fakturen</button>
                                        </div>
                                        <!-- <input type="button" value="Save Order" class="btn btn-primary" name="btnSave"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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


    $(window).on('load', function() {
        $('#txtbarcode_id').focus();
    });

    //Kerkimi permes Scan Barcode
    var productarr = [];

    $.ajax({
        url: "getorderproduct.php",
        method: "get",
        dataType: "json",
        data: {
            id: <?php echo $_GET['id']; ?>
        },
        success: function(data) {
            $.each(data, function(key, data) {
                if (data && data.barcode !== undefined) {
                    if (jQuery.inArray(data["product_id"], productarr) !== -1) {
                        var actualqty = parseInt($('#qty_id' + data["product_id"]).val()) + 1;
                        // var stock = data["stock"];

                        $('#qty_id' + data["product_id"]).val(actualqty);

                        var saleprice = parseInt(actualqty) * data["salesprice"];
                        // console.log(saleprice.toFixed(2));
                        $('#saleprice_id' + data["product_id"]).html(saleprice.toFixed(2));
                        $('#saleprice_idd' + data["product_id"]).val(saleprice);

                        $("#txtbarcode_id").val("");
                        calculate(0, 0);
                    } else {
                        addrow(data["product_id"], data["product_name"], data["salesprice"], data["stock"], data["qty"], data["barcode"]);
                        productarr.push(data["product_id"]);
                        $("#txtbarcode_id").val();

                        function addrow(product_id, product_name, saleprice, stock, qty, barcode) {
                            var tr = '<tr>' +
                                '<input type="hidden" class="form-control barcode" name="barcode_arr[]" id="barcode_id' + barcode + '" value="' + barcode + '">' +
                                '<td style="text-align:left;vertical-align:middle; font-size:17px;"><class="form-control product_c" name="product_arr[]"<span class="badge badge-dark">' + product_name + '</span><input type="hidden" class=form-control product_c" name="product_arr[]" value="' + product_name + '"><input type="hidden" class="form-control pid" name="pid_arr[]" value="' + product_id + '"> </td>' +
                                '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-primary stocklbl" name="stock_arrr[]" id="stock_id' + product_id + '">' + stock + '</span><input type="hidden" class="form-control stock_c" name="stock_c_arr[]" id="stock_idd' + product_id + '" value="' + stock + '"></td>' +
                                '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-primary price" name="price_arr[]" id="price_id' + product_id + '">' + saleprice + '</span><input type="hidden" class="form-control price_c" name="price_c_arr[]" id="price_idd' + product_id + '" value="' + saleprice + '"></td>' +
                                '<td><input type="text" class="form-control qty" name="quantity_arr[]" id="qty_id' + product_id + '" value="' + qty + ' " size="1"></td>' +
                                '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-danger totalamt" name="netamt_arr[]" id="saleprice_id' + product_id + '">' + qty * saleprice + '</span><input type="hidden" class="form-control saleprice" name="saleprice_arr[]" id="saleprice_idd' + product_id + '" value="' + qty * saleprice + '"></td>' +

                                //Remove button//
                                '<td><center><button type="button" name="remove" class="btn btn-danger btn-sm btnremove" data-id="' + product_id + '"><span class="fas fa-trash"></span></button></center></td>'
                            '<tr';
                            $('.details').append(tr);
                            calculate(0, 0);
                            $('#txtbarcode_id').val("");
                        } //end function addrow

                    };
                } else {
                    Swal.fire({
                        title: 'Gabim!',
                        text: 'Sasia ne depo eshte Zero, Perndryshe Produkti nuk eshte i regjistruar!',
                        icon: 'error',
                        // timer: 2000,
                        // buttons: false,
                    })
                    $('#txtbarcode_id').val("");
                }
            });
        },
        error: function() {
            alert("Gabim barcodi");
        }
    });
    //Perfundimi i pjeses per thirje
    $('#txtbarcode_id').keypress(function(e) {
        var key = e.keyCode || e.which;

        if (key == 13) {
            var barcode = $("#txtbarcode_id").val();
            $.ajax({
                url: "getproduct.php",
                method: "get",
                dataType: "json",
                data: {
                    id: barcode
                },
                success: function(data) {
                    if (data && data.barcode !== undefined) {
                        if (jQuery.inArray(data["pid"], productarr) !== -1) {
                            var actualqty = parseInt($('#qty_id' + data["pid"]).val()) + 1;
                            // var stock = data["stock"];

                            $('#qty_id' + data["pid"]).val(actualqty);

                            var saleprice = parseInt(actualqty) * data["salesprice"];
                            // console.log(saleprice.toFixed(2));
                            $('#saleprice_id' + data["pid"]).html(saleprice.toFixed(2));
                            $('#saleprice_idd' + data["pid"]).val(saleprice);

                            $("#txtbarcode_id").val("");
                            calculate(0, 0);
                        } else {
                            addrow(data["pid"], data["product"], data["salesprice"], data["stock"], data["barcode"]);
                            productarr.push(data["pid"]);
                            $("#txtbarcode_id").val();

                            function addrow(pid, product, saleprice, stock, barcode) {
                                var tr = '<tr>' +
                                    '<input type="hidden" class="form-control barcode" name="barcode_arr[]" id="barcode_id' + barcode + '" value="' + barcode + '">' +
                                    '<td style="text-align:left;vertical-align:middle; font-size:17px;"><class="form-control product_c" name="product_arr[]"<span class="badge badge-dark">' + product + '</span><input type="hidden" class=form-control product_c" name="product_arr[]" value="' + product + '"><input type="hidden" class="form-control pid" name="pid_arr[]" value="' + pid + '"> </?>' +
                                    '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-primary stocklbl" name="stock_arrr[]" id="stock_id' + pid + '">' + stock + '</span><input type="hidden" class="form-control stock_c" name="stock_c_arr[]" id="stock_idd' + pid + '" value="' + stock + '"></td>' +
                                    '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-primary price" name="price_arr[]" id="price_id' + pid + '">' + saleprice + '</span><input type="hidden" class="form-control price_c" name="price_c_arr[]" id="price_idd' + pid + '" value="' + saleprice + '"></td>' +
                                    '<td><input type="text" class="form-control qty" name="quantity_arr[]" id="qty_id' + pid + '" value="' + 1 + '" size="1"></td>' +
                                    '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-danger totalamt" name="netamt_arr[]" id="saleprice_id' + pid + '">' + saleprice + '</span><input type="hidden" class="form-control saleprice" name="saleprice_arr[]" id="saleprice_idd' + pid + '" value="' + saleprice + '"></td>' +
                                    //Remove button//
                                    // '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><center><name="remove" class="btnremove" data-id="' + pid + '"><span class="fas fa-trash" style="color:red;"></span></center></td>' +
                                    '<td><center><button type="button" name="remove" class="btn btn-danger btn-sm btnremove" data-id="' + pid + '"><span class="fas fa-trash"></span></button></center></td>'
                                '<tr';
                                $('.details').append(tr);
                                calculate(0, 0);
                                $('#txtbarcode_id').val("");
                            } //end function addrow
                        };
                    } else {
                        Swal.fire({
                            title: 'Gabim!',
                            text: 'Sasia ne depo eshte Zero, Perndryshe Produkti nuk eshte i regjistruar!',
                            icon: 'error',
                        })
                        $('#txtbarcode_id').val("");
                        // $('#txtbarcode_id').focus(); 
                    }

                },
                error: function() {
                    alert("Gabim barcodi");
                }
            });
            e.preventDefault();
            return false;
        }
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
                        $('#saleprice_id' + data["pid"]).html(saleprice.toFixed(2));
                        $('#saleprice_idd' + data["pid"]).val(saleprice);

                        $("#txtbarcode_id").val("");
                        calculate(0, 0);
                    } else {
                        addrow(data["pid"], data["product"], data["salesprice"], data["stock"], data["barcode"]);
                        productarr.push(data["pid"]);
                        $("#txtbarcode_id").val();

                        function addrow(pid, product, saleprice, stock, barcode) {
                            var tr = '<tr>' +
                                '<input type="hidden" class="form-control barcode" name="barcode_arr[]" id="barcode_id' + barcode + '" value="' + barcode + '">' +
                                '<td style="text-align:left;vertical-align:middle; font-size:17px;"><class="form-control product_c" name="product_arr[]"<span class="badge badge-dark">' + product + '</span><input type="hidden" class=form-control product_c" name="product_arr[]" value="' + product + '"><input type="hidden" class="form-control pid" name="pid_arr[]" value="' + pid + '"> </td>' +
                                '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-primary stocklbl" name="stock_arrr[]" id="stock_id' + pid + '">' + stock + '</span><input type="hidden" class="form-control stock_c" name="stock_c_arr[]" id="stock_idd' + pid + '" value="' + stock + '"></td>' +
                                '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-primary price" name="price_arr[]" id="price_id' + pid + '">' + saleprice + '</span><input type="hidden" class="form-control price_c" name="price_c_arr[]" id="price_idd' + pid + '" value="' + saleprice + '"></td>' +
                                '<td><input type="text" class="form-control qty" name="quantity_arr[]" id="qty_id' + pid + '" value="' + 1 + '" size="1"></td>' +
                                '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><span class="badge badge-danger totalamt" name="netamt_arr[]" id="saleprice_id' + pid + '">' + saleprice + '</span><input type="hidden" class="form-control saleprice" name="saleprice_arr[]" id="saleprice_idd' + pid + '" value="' + saleprice + '"></td>' +
                                //Remove button//
                                // '<td style = "text-align:left;vertical-align:middle; font-size:17px;"><center><name="remove" class="btnremove" data-id="' + pid + '"><span class="fas fa-trash" style="color:red;"></span></center></td>' +
                                '<td><center><button type="button" name="remove" class="btn btn-danger btn-sm btnremove" data-id="' + pid + '"><span class="fas fa-trash"></span></button></center></td>'
                            '<tr';
                            $('.details').append(tr);
                            calculate(0, 0);

                        } //end function addrow
                    }
                }
            })
        })
    });

    //Kalkulimi mbasi e vendos sasin e produktit ne tabel
    $("#itemtable").delegate(".qty", "keyup change", function() {
        var quantity = $(this);
        var tr = $(this).parent().parent();

        if ((quantity.val() - 0) > (tr.find(".stock_c").val() - 0)) {
            Swal.fire("Kujdes!", "Sasia me e madhe se ne depo", "warning");
            quantity.val(1);

            var result = parseFloat(quantity.val() * tr.find(".price").text());

            tr.find(".totalamt").text(result.toFixed(2));
            tr.find(".saleprice").val(result);
            calculate(0, 0);
        } else {
            var result = parseFloat(quantity.val() * tr.find(".price").text());
            tr.find(".totalamt").text(result.toFixed(2));
            tr.find(".saleprice").val(result);
            calculate(0, 0);
        }
    });
    //Kalkulimi i totalit
    //Kalkulimi i totalit
    function calculate(dis, paid) {
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
        zbritja = (zbritjaP / 100) * nentotali;
        totali = nentotali - zbritja;
        // $("#grandTotal").val(totali.toFixed(2));


    }
    $("#txt_paid").keyup(function() {
        var paid = $(this).val();
        var discount = $("#zbritja_m").val();
        calculate(discount, paid);
    });
    //Kalkulimi i zbritjes nga totali si dhe shfaqja e totalit per pages -zbritja
    $("#zbritja_p").on("keyup change", function() {
        // if (event.keyCode == 13) {
        var nentotali = parseFloat($("#nentotali").val());
        var zbritja_p = parseFloat($("#zbritja_p").val());
        var due = (zbritja_p / 100) * nentotali;
        var pagesa = nentotali - due
        // console.log(result);
        var discont = nentotali - pagesa;
        $("#zbritja_m").val(discont.toFixed(2));
        $("#grandTotal").val(pagesa.toFixed(2));
        // } else {}
    });
    //Kalukilimi i totalit me pagesen kesh te cilen e bane klienti
    $("#txtpaid").on("keyup change", function() {
        // if (event.keyCode == 13) {
        var totali = parseFloat($("#grandTotal").val());
        var pagesa = parseFloat($(this).val());

        if (pagesa < totali) {
            Swal.fire({
                title: 'Gabim!',
                text: 'Pagesa nuk mund te jete me e vogel se Totali!',
                icon: 'error',
                // timer: 2000,
                // buttons: false,
            })
            $("#txtpaid").val('');
            $("#txt_kusuri").val('');
        } else {
            var result = pagesa - totali;

            $("#txt_kusuri").val(result.toFixed(2));
        }
        // }
    });

    //Buttoni per fshirjen e produkteve ne tabel mbas skenimit 
    $(document).on('click', '.btnremove', function() {
        var removed = $(this).attr("data-id");
        productarr = jQuery.grep(productarr, function(value) {
            return value != removed;
            calculate(0, 0);
        });
        $(this).closest('tr').remove();
        calculate(0, 0);
        $("#txtpaid").val('');
        $("#txt_kusuri").val('');
    });
</script>
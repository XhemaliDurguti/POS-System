<?php 
    //Thirja e FPDF Liraris
    require('../fpdf/fpdf.php');

    include_once '../include/db.php';
    
    //Marrja e id Faktures nga Linku
    $id = $_GET["id"];

    //Marrja e te dhenave ne tabelen Fakture permes ID
    $select=$pdo->prepare("SELECT * FROM tbl_invoice WHERE invoice_id=$id");
    $select->execute();
    $row=$select->fetch(PDO::FETCH_OBJ);
    //Create pdf object
    $pdf = new FPDF('P','mm',array(80,200));



    //Krijimi i Faqes te re ne PDF
    $pdf->AddPage();

    //Caktimi i Fontit ne titull
    $pdf->SetFont('Arial','B',16);
    //Titulli i Faktures
    $pdf->Cell(60,8,'POS Sistemi',1,1,'C');

    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(60,5,'Nr Tel: 049-123-123',0,1,'C');
    $pdf->Cell(60,5,'POS Sistem',0,1,'C');
    //Line
    $pdf->Line(7,28,72,28);
    $pdf->Ln(1);

    $pdf->SetFont('Arial','BI',8);
    $pdf->Cell(20,4,'Faktura Nr:',0,0,'');

    $pdf->SetFont('Courier', 'BI', 8);
    $pdf->Cell(40, 4, $row->invoice_id, 0, 1, '');

    $pdf->SetFont('Arial','BI',8);
    $pdf->Cell(20,4,'Data:',0,0,'');

    $pdf->SetFont('Courier', 'BI', 8);
    $pdf->Cell(40, 4, $row->order_date, 0, 1, '');


    $pdf->SetX(7);
    $pdf->SetFont('Courier','B',8);
    $pdf->Cell(34,5,'Produkti',1,0,'L');
    $pdf->Cell(11, 5, 'Sasia', 1, 0, 'C');
    $pdf->Cell(12, 5, 'Cmimi', 1, 0, 'C');
    $pdf->Cell(12, 5, 'Totali', 1, 1, 'C');


    $select=$pdo->prepare("select * from tbl_invoice_details  where invoice_id = $id");
    $select->execute();
    // $row=$select->fetch(PDO::FETCH_OBJ);

    while($product=$select->fetch(PDO::FETCH_OBJ))
    {
        $pdf->SetX(7);
        $pdf->SetFont('Helvetica','B',8);
        $pdf->Cell(34,5,$product->product_name,1,0,'L');
        $pdf->Cell(11, 5, $product->qty, 1, 0, 'C');
        $pdf->Cell(12, 5, $product->cmimiShitjes, 1, 0, 'C');
        $pdf->Cell(12, 5, $product->subtotal, 1, 1, 'C');
    }

    $pdf->SetX(7);
    $pdf->SetFont('Courier','B',8);
    $pdf->Cell(45,5,'',0,0,'L');
    $pdf->Cell(12,5,'Totali',1,0,'C');
    $pdf->Cell(12,5,$row->subtotal,1,1,'C');

    $pdf->SetX(7);
    $pdf->SetFont('Courier', 'B', 6);
    $pdf->Cell(45, 5, '', 0, 0, 'L');
    $pdf->Cell(12, 5, 'Para Kesh', 1, 0, 'C');
    $pdf->Cell(12, 5, $row->kesh, 1, 1, 'C');

    $pdf->SetX(7);
    $pdf->SetFont('Courier', 'B', 8);
    $pdf->Cell(45, 5, '', 0, 0, 'L');
    $pdf->Cell(12, 5, 'Kusuri', 1, 0, 'C');
    $pdf->Cell(12, 5, $row->kusuri, 1, 1, 'C'); 

    $pdf->Output();
    
?>
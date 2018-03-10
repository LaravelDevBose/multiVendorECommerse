<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class InvoiceController extends Controller
{
	

	public function pdfInvoiceDownload($orderId, $type)
	{	
		if($type == 'V') {$type = '';}
		$orderProducts = DB::table('products')
                        ->join('order_details', 'products.id', '=', 'order_details.productId')
                        ->join('sizes', 'order_details.sizes', '=', 'sizes.id')
                        ->join('primary_colors', 'order_details.priColor', '=', 'primary_colors.id')
                        ->where('order_details.orderId', $orderId)
                        ->select('products.productCode', 'order_details.*', 'sizes.sizeTitle','primary_colors.colorName')
                        ->get()->toarray();


        $pdf = app('FPDF');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->invoiceData($orderId,$orderProducts);
		$pdf->PdfHeader();
		$pdf->OrderId();
		$pdf->DeleveryInfo();
		$pdf->OrderTitle();
		$pdf->Orderdetails();
		$pdf->OrderTotal();
		$pdf->PdfFooter();
		$pdf->SetFont('Arial','B',16);

		$pdf->Output($type);
		exit;

		

	}

	public function shopPdfInvoiceDownload($orderId, $type)
	{	
		if($type == 'V') {$type = '';}
		$orderProducts = DB::table('products')
                        ->join('order_details', 'products.id', '=', 'order_details.productId')
                        ->join('sizes', 'order_details.sizes', '=', 'sizes.id')
                        ->join('primary_colors', 'order_details.priColor', '=', 'primary_colors.id')
                        ->where('order_details.orderId', $orderId)
                        ->where('order_details.ownerId', Auth::User()->shopId)
                        ->select('products.productCode', 'order_details.*', 'sizes.sizeTitle','primary_colors.colorName')
                        ->get()->toarray();


        $pdf = app('FPDF');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->invoiceData($orderId,$orderProducts);
		$pdf->PdfHeader();
		$pdf->OrderId();
		$pdf->DeleveryInfo();
		$pdf->OrderTitle();
		$pdf->Orderdetails();
		$pdf->OrderTotal();
		$pdf->PdfFooter();
		$pdf->SetFont('Arial','B',16);

		$pdf->Output($type);
		exit;

		

	}
    
	

}

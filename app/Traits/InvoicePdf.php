<?php

namespace App\Traits;
use App\ShippingDetail;
use App\PaymentDetail;
use App\TransportLocation;
use App\Order;
use App\User;
use App\Shop;
use DB;
use DateTime;
trait InvoicePdf{


    protected $orderId;
    protected $orderInfo;
    protected $orderDate;
    protected $paymentDetail;
    protected $shippingInfo;
    protected $userInfo;
    protected $orderProducts;
    protected $houseNo;
    protected $roadNo;
    protected $block;
    protected $upzTha;
    protected $disName;
    protected $divName;

    function invoiceData($orderId,$orderProducts){

    	$this->orderId = $orderId;

    	$this->orderInfo = Order::where('id', $this->orderId)->first();
        $this->paymentDetail = PaymentDetail::where('id',$this->orderInfo->paymentId)->first();
        $this->shippingInfo = ShippingDetail::where('id', $this->orderInfo->shippingId)->first();
        $this->userInfo = User::where('id', $this->orderInfo->consumerId)->select('name', 'email','avater','phoneNo')->first();

        $this->orderProducts = $orderProducts;
        
        $date = new DateTime($this->shippingInfo->created_at);
        $this->orderDate = date_format($date, 'd M Y');

        $this->houseNo = ($this->shippingInfo->houseNo) ? $this->shippingInfo->houseNo.', ' : ' ';
    	$this->roadNo = ($this->shippingInfo->roadNo) ? $this->shippingInfo->roadNo.', ' : ' ';
    	$this->block = ($this->shippingInfo->block) ? $this->shippingInfo->block.',' : ' ';
    	$this->upzTha = TransportLocation::where('id',$this->shippingInfo->areaId)->value('areaName');
    	$this->disName = TransportLocation::where('id',$this->shippingInfo->districtId)->value('areaName');
    	$this->divName = TransportLocation::where('id',$this->shippingInfo->divisionId)->value('areaName');
    }
   
	 function PdfHeader()
    {	
    	

        $this->SetFont('Arial','',10);
        $this->Cell(0,10,'Dispatch to:',0,1,'L');
        
        $this->SetFont('Arial','',14);
        $this->Cell(0,6, $this->userInfo->name,0,1);
        $this->Cell(0,6, $this->houseNo.$this->roadNo.$this->block,0,1);
        $this->Cell(0,6,$this->shippingInfo->areaName,0,1);
        $this->Cell(0,6,$this->upzTha.'-'.$this->shippingInfo->zipCode,0,1);
        $this->Cell(0,6,$this->disName.' , '.$this->divName ,0,1);
        $this->Ln(2);
        $this->Cell(0,0,'',1,1);
        $this->Ln(2);
    }

     function OrderId()
    {
       
        $this->SetFont('Arial','',12);
        $this->Cell(0,7,'Order ID: '.$this->orderInfo->invoiceId,0,1);
        $this->SetFont('Arial','',10);
        $this->Cell(0,5,'Thank you for Buying from Analogue Seduction on Amaxon Marketplace',0,1);

        
    }

     function DeleveryInfo()
    {   
        $this->y = $this->GetY();
        $this->Rect(10,$this->y+5, 190, 38);
        
        $this->SetFont('Arial','',10);
        // $this->SetLeftMargin(20);
        $this->Ln(8);
        $this->Cell(6,5.3, '',0,0);
        $this->Cell(80,5.3, 'Detivery address:',0,0);
        $this->Cell(30,5.3, 'Order Date: ',0,0);
        $this->Cell(0,5.3, $this->orderDate,0,1);

        $this->Cell(6,5.3, '',0,0);
        $this->Cell(80,5.3, $this->userInfo->name,0,0);
        $this->Cell(30,5.3, 'Delivery Service: ',0,0);
        $this->Cell(0,5.3, 'Standard',0,1);

        $this->Cell(6,5.3, '',0,0);
        $this->Cell(80,5.3, $this->houseNo.$this->roadNo.$this->block,0,0);
        $this->Cell(30,5.3, 'Buyer Name: ',0,0);
        $this->Cell(0,5.3, $this->userInfo->name,0,1);

        $this->Cell(6,5.3, '',0,0);
        $this->Cell(80,5.3, $this->shippingInfo->areaName,0,0);
        $this->Cell(30,5.3, '',0,0);
        $this->Cell(0,5.3,  '',0,1);

        $this->Cell(6,5.3, '',0,0);
        $this->Cell(80,5.3, $this->upzTha.'-'.$this->shippingInfo->zipCode,0,0);
        $this->Cell(30,5.3, '',0,0);
        $this->Cell(0,5.3, '',0,1);

        $this->Cell(6,5.3, '',0,0);
        $this->Cell(80,5.3, $this->disName.' , '.$this->divName ,0,0);
        $this->Cell(30,5.3, '',0,0);
        $this->Cell(0,5.3, '',0,1);
        $this->Ln(8);

       
    }

     function OrderTitle(){

        $this->Cell(2.5,0,'', 0, 0);
        
        $this->SetFont('Arial','',11);
        $this->Cell(20,10, 'Quantity',1,0,'C');
        $this->Cell(115,10, 'Product Details',1,0,'C');
        $this->Cell(25,10, 'Price ',1,0,'C');
        $this->Cell(25,10, 'Sub-Total ',1,1,'C');

        $this->y = $this->GetY();
    }

     function Orderdetails(){

        
        foreach($this->orderProducts as $product) { 
            $this->Cell(2.5,0,'', 0, 0);
            $this->SetFont('Arial','',11);
            $this->Cell(20,30,$product->productQuantity,1,0,'C');
            $this->product($product);
            $this->Rect(147.5,$this->y-23, 25, 30);
            $this->Cell(25,-18, $product->productPrice ,0,0,'C');
            $this->Rect(172.5,$this->y-23, 25, 30);
            $this->Cell(25,-18, $product->productQuantity*$product->productPrice,0,0,'C');
            $this->Cell(.01,7,'', 0, 1);
            $this->y = $this->GetY();
        }
        

        
    }

     function product($product){
        $this->Rect(32.5,$this->y, 115, 30);
        $this->SetFont('Times','',11);
        $this->Cell(115,8, $product->productName,0,1,'L');
        $this->SetFont('Arial','',9);
        $this->Cell(22.5,0,'', 0, 0);
        $this->Cell(115,5, 'Product Code: '.$product->productCode,0,1,'L');
        $this->Cell(22.5,0,'', 0, 0);
        $this->Cell(115,5, 'Size: '.$product->sizeTitle,0,1,'L');
        $this->Cell(22.5,0,'', 0, 0);
        $this->Cell(115,5, 'Color: '.$product->colorName,0,1,'L');
        $this->Cell(22.5,0,'', 0, 0);
        $shopName = 'DORPON';
        if($product->ownerId !=0 ){
    		$shopName = Shop::where('id',$product->ownerId)->value('shopName');
        }
        $this->Cell(115,5, 'Shop Name: '.$shopName ,0,0,'L');
    }

     function OrderTotal(){


        $orderSubTotal = 'Tk.'.number_format($this->orderInfo->totalAmmount-$this->orderInfo->deliveryPrice);
        $deliveryAmt = 'Tk.'.number_format($this->orderInfo->deliveryPrice);

        
        $w1 = $this->GetStringWidth($orderSubTotal)+3;
        $w2 = $this->GetStringWidth($deliveryAmt)+3;
        $w = 190-( $w1 + $w2);
    

        $this->Rect(12.5,$this->y, 185, 16);
        $this->SetFont('Arial','',11);
        $this->Ln(2);

        $this->Cell(150,7, 'Order : ',0,0,'R');
        $this->Cell(30,7, $orderSubTotal ,0,1,'R');

        $this->Cell(150,7, 'Delivery : ',0,0,'R');
        $this->Cell(30,7, $deliveryAmt ,0,1,'R');

        $this->Rect(12.5,$this->y, 185, 12);
        $this->SetFont('Times','',15);
        $this->Cell(2.5,0,'', 0, 0);
        $this->Ln(3);
        $this->Cell(145,7, 'Order Tolal : ',0,0,'R');
        $this->Cell(35,7, number_format($this->orderInfo->totalAmmount) ,0,1,'R');
        $this->Ln(8);
    }


    // Page footer
     function PdfFooter()
    {   
        $btmFst = 'Thanks for buying on Amazon Marketplace.To  provide feedback for the seller please visit';
        $siteUrl = 'www.mydorpon.com';
        $btmSec = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id cum nisi voluptatem odit dolores, qui inventore";
        $btmTrd = "voluptate, vitae repudiandae voluptatibus.";

        $this->SetLeftMargin(10);
        $this->SetFont('Arial','',10.9);
        $this->Cell(154,5, $btmFst ,0,0);
        $this->SetTextColor(12,29,150);
        $this->Cell(0,5, $siteUrl ,0,1);
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, $btmSec ,0,1);
        $this->Cell(0,5, $btmTrd ,0,1);
        
    }

     function Footer(){
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','B',10);
        // Page number
        $this->Cell(0,5, $this->PageNo() ,0,0,'R');
    }
}
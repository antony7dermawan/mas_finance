<?php
defined('BASEPATH') or exit('No direct script access allowed');

class c_faktur_penjualan_print4 extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_t_ak_faktur_penjualan_rincian');
    $this->load->model('m_t_ak_faktur_penjualan_diskon');
    $this->load->model('m_t_ak_faktur_penjualan_pph');
    $this->load->model('m_t_ak_faktur_penjualan');
    $this->load->model('m_t_ak_faktur_penjualan_print_setting');
  }

  public function index($id,$pks_id)
  {
    $pdf = new \TCPDF();
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->AddPage('P', 'mm', 'A4');
    $pdf->SetAutoPageBreak(true, 0);

 
        // Add Header
    
    #.............................paper head
    

    


    $pdf->SetFont('','',10);

    $read_select = $this->m_t_ak_faktur_penjualan->select_by_id($id);
    foreach ($read_select as $key => $value) 
    {
      $pelanggan=$value->PELANGGAN;
      $tgl_faktur=$value->DATE;


      $no_faktur=$value->NO_FAKTUR;
      $keterangan_header=$value->KETERANGAN;
      $no_faktur_pajak=$value->NO_FAKTUR_PAJAK;
      $no_kontrak=$value->NO_KONTRAK;
      $keterangan_footer=$value->KET_2;
      $attention=$value->ATTENTION;
      $department=$value->DEPARTMENT;
      $telp_no=$value->TELP_NO;
      $po_no=$value->PO_NO;
      $dn_no=$value->DN_NO;



      $alamat=$value->ALAMAT;
      $npwp=$value->NPWP;
      $nik=$value->NIK;
      $no_telp_pelanggan=$value->NO_TELP;



      $sum_total_tagihan=$value->SUM_TOTAL_TAGIHAN - $value->SUM_VALUE_DISKON;



      $sum_total_tagihan_ppn =0;
      if($value->SUM_TOTAL_TAGIHAN_PPN>0)
      {
        $sum_total_tagihan_ppn = round(0.1 * $sum_total_tagihan);
      }

      $sum_value_diskon=$value->SUM_VALUE_DISKON;
      $sum_value_pph=$value->SUM_VALUE_PPH;
    }

    

    $total_row_1_bon = 12;

    $sum_qty_spb = 0;

    $dpp = 0;
    $ppn = 0;
    $pph_22 = 0;
    $total_tagihan = 0;
    $read_select = $this->m_t_ak_faktur_penjualan_rincian->select($id);
    foreach ($read_select as $key => $value) 
    {
      $rmd=(float)($key/$total_row_1_bon);
      $rmd=($rmd-(int)$rmd)*$total_row_1_bon;

      if($key==0 or ($key>=$total_row_1_bon and $rmd==0))
      {
        if($key>=$total_row_1_bon and $rmd==0)
        {
          $pdf->SetPrintHeader(false);
          $pdf->SetPrintFooter(false);
          $pdf->AddPage();
        }
        

        $pdf->SetFont('','UB',24);
        $pdf->Cell( 190,5,'TAGIHAN','',1,'C');
        
        

        $pdf->Cell( 190,5,'','',1,'C');
        

        $pdf->SetFont('','',10);
        $pdf->Cell( 10,5,'Kpd','0',0,'L');
        $pdf->MultiCell(70, 8,':  '.substr($pelanggan, 0, 50), '0', 'L',0,1);


        $pdf->Cell( 10,5,'Di','0',0,'L');
        $pdf->MultiCell(60, 4,':  '.substr($alamat, 0, 200), '0', 'L',0,1);



        $x_value = $pdf->GetX();
        $y_value =33;
        $pdf->SetXY($x_value, $y_value);
        
        $pdf->SetFont('','B',12);


        $pdf->Cell(90, 4, "", 0, 0, 'L');
        $pdf->Cell(100, 4,'INVOICE', 1, 1, 'C');
        $pdf->SetFont('','',10);
        $pdf->Cell(90, 4, "", 0, 0, 'L');
        $pdf->Cell(30, 4, "No. Inv", 1, 0, 'L');
        $pdf->Cell(70, 4,':  '.$no_faktur, 1, 1, 'L');
        
        $pdf->Cell(90, 4, "", 0, 0, 'L');
        $pdf->Cell(30, 4, "Tanggal", 1, 0, 'L');
        $pdf->Cell(70, 4,':  '.date('d-m-Y', strtotime($tgl_faktur)), 1, 1, 'L');
      


   

        $pdf->Cell( 190,5,'','',1,'C');

        $pdf->SetFont('','B',10);
        $size[0]=10;
        $size[1]=95;
        $size[2]=25;
        $size[3]=25;
        $size[4]=35;
        
        $pdf->Cell( $size[0],8,'No.','1',0,'C');
        $pdf->Cell( $size[1],8,'Keterangan','1',0,'C');
        $pdf->Cell( $size[2],8,'Unit','1',0,'C');
        $pdf->Cell( $size[3],8,'Price/Unit','1',0,'C');
        $pdf->Cell( $size[4],8,'Jumlah (Rp)','1',1,'C');


        if($keterangan_header!='')
        {
          $pdf->SetFont('','',9);
          $pdf->MultiCell($size[0], 8, '', 'L', 'C',0,0);
          $pdf->MultiCell($size[1], 8, substr($keterangan_header, 0, 100), 'L', 'L',0,0);

          $pdf->MultiCell($size[2], 8, '', 'L', 'R',0,0);
          $pdf->MultiCell($size[3], 8, '', 'L', 'R',0,0);

          $pdf->MultiCell($size[4], 8, '' , 'LR', 'R',0,1);
        }
        
      
      }
      
      $qty_spb=0;

      if($value->SUM_VALUE_KEBUN>0)
      {
        $qty_spb=$value->SUM_VALUE_KEBUN;
      }
      if($value->SUM_PC>0)
      {
        $qty_spb=$value->SUM_PC;
      }
      if($value->SUM_TONASE>0)
      {
        $qty_spb=$value->SUM_TONASE;
      }

      
      
      $value_spb = $value->SUM_TOTAL_SPB;

      $price = 0;
      if($qty_spb>0)
      {
        $price = $value_spb/$qty_spb;
      }
      

      $pdf->SetFont('','',9);
      $pdf->MultiCell($size[0], 8, $key+1, 'L', 'C',0,0);
      $pdf->MultiCell($size[1], 8, (substr($value->KET, 0, 100)), 'L', 'L',0,0);

      $pdf->MultiCell($size[2], 8, number_format(($qty_spb),2,'.',','), 'L', 'R',0,0);
      $pdf->MultiCell($size[3], 8, number_format(($price),2,'.',','), 'L', 'R',0,0);

      $pdf->MultiCell($size[4], 8, number_format(($value_spb),2,'.',',') , 'LR', 'R',0,1);


      $dpp = $dpp+floatval($value->SUM_TOTAL_SPB);
  
    }

    if($key<$total_row_1_bon)
    {
      $added_row = $total_row_1_bon-$key;
    }
    if($key>=$total_row_1_bon)
    {
      $added_row = $total_row_1_bon-$rmd;
    }


    for($i=0;$i<=$added_row;$i++)
    {
      $pdf->Cell( $size[0],6,'','L',0,'C');
      $pdf->Cell( $size[1],6,'','L',0,'L');
      $pdf->Cell( $size[2],6,'','L',0,'C');
      $pdf->Cell( $size[3],6,'','L',0,'C');
      $pdf->Cell( $size[4],6,'','LR',1,'C');
    }







    $read_select = $this->m_t_ak_faktur_penjualan_diskon->select($id);
    foreach ($read_select as $key => $value) 
    { 
      $qty_diskon = $value->QTY;
      $harga_diskon = $value->HARGA;

      $value_diskon = $value->VALUE_DISKON;
      $pdf->SetFont('','',9);
      $pdf->MultiCell($size[0], 8, '', 'L', 'C',0,0);
      $pdf->MultiCell($size[1], 8, (substr($value->KETERANGAN, 0, 50)), 'L', 'L',0,0);

      if($qty_diskon==1)
      {
        $pdf->MultiCell($size[2], 8, '', 'L', 'C',0,0);
        $pdf->MultiCell($size[3], 8, '', 'L', 'R',0,0);
      }
      if($qty_diskon!=1)
      {
        $pdf->MultiCell($size[2], 8, '('.number_format(($qty_diskon),2,'.',',').')', 'L', 'R',0,0);
        $pdf->MultiCell($size[3], 8, '('.number_format(($harga_diskon),2,'.',',').')', 'L', 'R',0,0);
      }
      $pdf->MultiCell($size[4], 8, '('.number_format(($value_diskon),2,'.',',').')' , 'LR', 'R',0,1);
    }



        if($keterangan_footer!='')
        {
          $pdf->SetFont('','',9);
          $pdf->MultiCell($size[0], 8, '', 'L', 'C',0,0);
          $pdf->MultiCell($size[1], 8, substr($keterangan_footer, 0, 100), 'L', 'L',0,0);

          $pdf->MultiCell($size[2], 8, '', 'L', 'C',0,0);
          $pdf->MultiCell($size[3], 8, '', 'L', 'R',0,0);

          $pdf->MultiCell($size[4], 8, '' , 'LR', 'R',0,1);
        }







    $pdf->SetFont('','B',9);
    $pdf->Cell( $size[0]+$size[1],8,'','LT',0,'R');
    $pdf->Cell( $size[2]+$size[3],8,'Sub Total','LT',0,'L');

    $pdf->Cell( $size[4],8,number_format(($sum_total_tagihan),2,'.',','),'LTR',1,'R');



    if($sum_total_tagihan_ppn>0)
    {
      $pdf->SetFont('','',9);
      $pdf->Cell( $size[0]+$size[1],8,'','L',0,'R');
      $pdf->Cell( $size[2]+$size[3],8,'PPN 10%','L',0,'L');

      $pdf->Cell( $size[4],8,number_format(($sum_total_tagihan_ppn),2,'.',','),'LR',1,'R');
    }


    if($sum_value_pph>0)
    {
      $read_select = $this->m_t_ak_faktur_penjualan_pph->select($id);
      foreach ($read_select as $key => $value) 
      {
        $pdf->SetFont('','',9);
        $pdf->Cell( $size[0]+$size[1],8,'','L',0,'R');
        $pdf->Cell( $size[2]+$size[3],8,$value->KETERANGAN,'L',0,'L');

        $pdf->Cell( $size[4],8,'('.number_format(($sum_value_pph),2,'.',',').')','LR',1,'R');
      }
    }


    $total_pembayaran = $sum_total_tagihan + $sum_total_tagihan_ppn - $sum_value_pph - $sum_value_diskon;
    $pdf->SetFont('','B',9);
    $pdf->Cell( $size[0]+$size[1],8,'','L',0,'R');
    $pdf->Cell( $size[2]+$size[3],8,'Total Pembayaran','L',0,'L');

    $pdf->Cell( $size[4],8,number_format(($total_pembayaran),2,'.',','),'LTR',1,'R');
    


    $pdf->Cell( $size[0]+$size[1]+$size[2]+$size[3]+$size[4],2,'','T',1,'R');
    $pdf->SetFont('','IU',9);

    $pdf->MultiCell(190 ,10,'Terbilang:'.ucwords($this->terbilang($total_pembayaran)).' Rupiah',1,'L');




    $pdf->Cell( 185,4,'','0',1,'R');

    $pdf->SetFont('','',10);
    $read_select = $this->m_t_ak_faktur_penjualan_print_setting->select_id(10);
    foreach ($read_select as $key => $value) 
    {
      $setting_value=$value->SETTING_VALUE;
    }


    $pdf->Cell( 185,4,$setting_value,'0',1,'R');

    $pdf->Cell( 185,4,'','0',1,'R');
    $pdf->Cell( 185,4,'','0',1,'R');
    $pdf->Cell( 185,4,'','0',1,'R');
    $pdf->Cell( 185,4,'','0',1,'R');



    $x_value = $pdf->GetX();
    $y_value = $pdf->GetY()+5;


    $pdf->SetXY($x_value, $y_value);

    $pdf->SetFont('','U',10);
    $read_select = $this->m_t_ak_faktur_penjualan_print_setting->select_id(11);
    foreach ($read_select as $key => $value) 
    {
      $setting_value=$value->SETTING_VALUE;
    }

    $pdf->Cell( 180,4,$setting_value,'0',1,'R');








    $pdf->Output("faktur_penjualan_".$no_faktur.".pdf");
  }



  
function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = $this->penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
      $temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . $this->penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . $this->penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }

  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim($this->penyebut($nilai));
    } else {
      $hasil = trim($this->penyebut($nilai));
    }         
    return $hasil;
  }
  



}

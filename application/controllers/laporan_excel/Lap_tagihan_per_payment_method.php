<?php

      use PhpOffice\PhpSpreadsheet\Spreadsheet;
      use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
      use PhpOffice\PhpSpreadsheet\Helper\Sample;
      use PhpOffice\PhpSpreadsheet\IOFactory;
      use PhpOffice\PhpSpreadsheet\RichText\RichText;
      use PhpOffice\PhpSpreadsheet\Shared\Date;
      use PhpOffice\PhpSpreadsheet\Style\Alignment;
      use PhpOffice\PhpSpreadsheet\Style\Border;
      use PhpOffice\PhpSpreadsheet\Style\Color;
      use PhpOffice\PhpSpreadsheet\Style\Fill;
      use PhpOffice\PhpSpreadsheet\Style\Font;
      use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
      use PhpOffice\PhpSpreadsheet\Style\Protection;
      use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
      use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
      use PhpOffice\PhpSpreadsheet\Worksheet\ColumnDimension;
      use PhpOffice\PhpSpreadsheet\Worksheet;

      class Lap_tagihan_per_payment_method extends CI_Controller{

            public function __construct()
            {
                parent::__construct();

                $this->load->model('m_t_t_t_penjualan_jasa_3');
                $this->load->model('m_t_ak_faktur_penjualan');
                $this->load->model('m_t_ak_faktur_penjualan_rincian');
                

            }



            public function index($date_from_laporan,$date_to_laporan,$id,$id2,$payment_method_id)
            {
              $this->session->set_userdata('t_ak_faktur_penjualan_delete_logic', '0');

              $total_day=intval(((round(abs(strtotime($date_from_laporan) - strtotime($date_to_laporan)) / (60*60*24),0))+1)/2);


                $date=date_create($date_from_laporan);
                date_add($date,date_interval_create_from_date_string("{$total_day} days"));
                $month_int = intval(date_format($date,"m"));


                  $spreadsheet = new Spreadsheet();


                  $alp='A';
                  $total_colom=28;
                  for($x=0;$x<=$total_colom;$x++)
                  {
                    $spreadsheet->getActiveSheet()
                          ->getColumnDimension($alp)
                          ->setAutoSize(true);
                    $last_colom_alp = $alp;
                    $alp++;
                  }


                  $row=1;

                  $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                  $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':J'.$row);
                  $sheet = $spreadsheet->getActiveSheet();
                  $sheet->setCellValue('A'.$row, 'PT. MITRA ANGKUTAN SEJATI');
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


                  $row=$row+1;
                  $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                  $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':J'.$row);
                  $sheet = $spreadsheet->getActiveSheet();
                  $sheet->setCellValue('A'.$row, 'Laporan Tagihan Invoice per Payment Method');
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');

                  $row=$row+1;
                  $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                  $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':J'.$row);
                  $sheet = $spreadsheet->getActiveSheet();
                  $sheet->setCellValue('A'.$row, 'Dari '.date('d-m-Y', strtotime($date_from_laporan)).' Sampai '.date('d-m-Y', strtotime($date_to_laporan)));
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');

                  


                  $row=$row+1;


                  $alpa='A';
                  $sheet->setCellValue($alpa.$row, 'No');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'INVOICE');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'NAMA PELANGGAN');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'FP');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'NO.DO');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'TGL INV');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Keterangan Atas');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');



                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Keterangan Bawah');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Keterangan Semua DO');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Tonase');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, '@');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;

                  $sheet->setCellValue($alpa.$row, 'Claim');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'DPP');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'PPN');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'PPh 23');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'PIUTANG');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Potong BBM,dll');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'by tt');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'DANA MASUK');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'SISA TAGIHAN');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'STT');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');



                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'TGL LNS');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');








                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Created By');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Updated By');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                 



                        $alp='A';
                        $total_alp=23;
                        for($n=0;$n<=$total_alp;$n++)
                        {
                              $area = $alp.$row;
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                              $alp++;
                        }

                  $data_logic = 0;
                  $key=0;

                  $sales_id = 0;

                  $read_select = $this->m_t_ak_faktur_penjualan->select_by_date_payment_method($date_from_laporan,$date_to_laporan,$payment_method_id);
                  foreach ($read_select as $key => $value) 
                  {   
                        $data_logic = 1;
                        $r_id[$key]=$value->ID;
                        $r_time[$key]=$value->TIME;
                        $r_pelanggan[$key]=$value->PELANGGAN;



                        $r_no_faktur[$key]=$value->NO_FAKTUR;
                        $r_no_faktur_pajak[$key]=$value->NO_FAKTUR_PAJAK;
                        $r_no_do[$key]='';
                        $r_date[$key]=$value->DATE;
                        $r_ket_atas[$key]=$value->KETERANGAN;
                        $r_ket_bawah[$key]=$value->KET_2;
                        $r_sum_value_kebun[$key]=$value->SUM_VALUE_KEBUN;

                        $r_sum_total_tagihan[$key]=$value->SUM_TOTAL_TAGIHAN;
                        $r_sum_total_tagihan_ppn[$key]=$value->SUM_TOTAL_TAGIHAN_PPN;
                        $r_sum_value_diskon[$key]=$value->SUM_VALUE_DISKON;
                        $r_sum_value_pph[$key]=$value->SUM_VALUE_PPH;
                        $r_payment_t[$key]=$value->PAYMENT_T;


                        $r_date_pelunasan[$key]=$value->DATE_PELUNASAN;






                        $r_created_by[$key]=$value->CREATED_BY;
                        $r_updated_by[$key]=$value->UPDATED_BY;
                  }
                  $total_data = $key;



                  $sum_all_target_party=0;
                  $sum_all_value_kebun=0;
                  $sum_all_value_pabrik=0;
                  $sum_all_sisa=0;
                  $sum_all_susut=0;

                  if($data_logic==1)
                  {
                  for($i=0;$i<=$total_data;$i++)
                  {
                            $row=$row+1;

                            $alpa='A';
                            $sheet->setCellValue($alpa.$row, $i+1);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_no_faktur[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');



                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_pelanggan[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                          
                            

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_no_faktur_pajak[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                            $no_do_lap_ini = '';
                            $ket_do_lap_ini = '';
                            $read_select_in = $this->m_t_ak_faktur_penjualan_rincian->select($r_id[$i]);
                            foreach ($read_select_in as $key_in => $value_in) 
                            {
                              if($key_in==0)
                              {
                                $no_do_lap_ini = $value_in->NO_DO;
                                $ket_do_lap_ini = $value_in->KET;
                              }
                              if($key_in>0)
                              {
                                $no_do_lap_ini = $no_do_lap_ini .' | '.$value_in->NO_DO;
                                $ket_do_lap_ini = $ket_do_lap_ini .' | '.$value_in->KET;
                              }
                              
                            }

                            //tambahan  
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $no_do_lap_ini);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_date[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_ket_atas[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_ket_bawah[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $ket_do_lap_ini);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_sum_value_kebun[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');



                            $value_harga=0;
                            if($r_sum_value_kebun[$i]>0)
                            {
                              $value_harga=$r_sum_total_tagihan[$i]/$r_sum_value_kebun[$i];
                            }

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $value_harga);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_sum_value_diskon[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_sum_total_tagihan[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');



                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_sum_total_tagihan_ppn[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_sum_value_pph[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');



                            $jumlah_piutang = $r_sum_total_tagihan[$i] + $r_sum_total_tagihan_ppn[$i] - $r_sum_value_pph[$i];


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $jumlah_piutang);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_sum_value_diskon[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');



                            $alpa++;
                            $sheet->setCellValue($alpa.$row, ''); //ga ngerti
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');
                            
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_payment_t[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');


                            $sisa_tagihan = $jumlah_piutang - $r_payment_t[$i];
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $sisa_tagihan);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');



                             $status_lunas = 'Lunas';
                            if($sisa_tagihan > 0)
                            {
                              $status_lunas = 'Belum Lunas';
                            }

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $status_lunas);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_date_pelunasan[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');



                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_created_by[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_updated_by[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');




                        

                        


                       

                          $spreadsheet->getActiveSheet()
                                  ->getStyle('F'.$row.':S'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

                          
                  }


                        

                  

                  }#end of data logic ==1



                  $writer = new Xlsx($spreadsheet);
                  $filename = 'Lap_tagihan_per_payment_method';
                  
                  header('Content-Type: application/vnd.ms-excel');
                  header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                  header('Cache-Control: max-age=0');
      
                  $writer->save('php://output');
            }
      }
?>

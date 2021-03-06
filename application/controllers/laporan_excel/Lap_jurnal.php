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

      class Lap_jurnal extends CI_Controller{

            public function __construct()
            {
                parent::__construct();

                $this->load->model('m_t_ak_jurnal');
                

            }



            public function index($date_from_laporan,$date_to_laporan,$sub_id)
            {
              

              $total_day=intval(((round(abs(strtotime($date_from_laporan) - strtotime($date_to_laporan)) / (60*60*24),0))+1)/2);


                $date=date_create($date_from_laporan);
                date_add($date,date_interval_create_from_date_string("{$total_day} days"));
                $month_int = intval(date_format($date,"m"));


                  $spreadsheet = new Spreadsheet();


                  $alp='A';
                  $total_colom=23;
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
                  $sheet->setCellValue('A'.$row, 'PT MITRA ANGKUTAN SEJATI');
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


                  $row=$row+1;
                  $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                  $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':J'.$row);
                  $sheet = $spreadsheet->getActiveSheet();
                  $sheet->setCellValue('A'.$row, 'Laporan Jurnal');
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
                  $sheet->setCellValue($alpa.$row, 'No Voucer');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Date');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'NO AKUN');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Nama Akun');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');








                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'KETERANGAN');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'JENIS KENDARAAN');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'NO POLISI');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'NAMA SUPIR');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'GANDENGAN/EKOR');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'JARAK');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'LOKASI');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'PELANGGAN');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'DEPARTMEN/JENIS');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'NO.DO');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'NO SPB');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'DARI');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Tujuan');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'OTY JURNAL');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'HARGA JURNAL');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');








                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Debit');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Kredit');
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
                  $total_debit = 0;
                  $total_kredit = 0;


                  $read_select = $this->m_t_ak_jurnal->select($date_from_laporan,$date_to_laporan);
                  foreach ($read_select as $key => $value) 
                  {   
                    $data_logic = 1;
                        if ($value->NO_AKUN_3 != '') {
                          $no_akun[$key] = $value->NO_AKUN_3;
                        } elseif ($value->NO_AKUN_2 != '') {
                          $no_akun[$key] = $value->NO_AKUN_2;
                        } else {
                          $no_akun[$key] = $value->NO_AKUN_1;
                        }

                        $total_debit = intval($value->DEBIT) + $total_debit;
                        $total_kredit = intval($value->KREDIT) + $total_kredit;


                        $no_voucer[$key] = $value->NO_VOUCER;
                        $r_date[$key] = date('d-m-Y', strtotime($value->DATE)) . " / " . date('H:i', strtotime($value->TIME));
                        $nama_akun[$key] = $value->NAMA_AKUN;
                        $debit[$key] = $value->DEBIT;
                        $kredit[$key] = $value->KREDIT;


                        $created_id[$key] = $value->CREATED_ID;
                        $r_created_by[$key]=$value->CREATED_BY;
                        $r_updated_by[$key]=$value->UPDATED_BY;

                    $no_polisi[$key]=$value->NO_POLISI.' / '.$value->NO_UNIT;
                    $supir[$key]=$value->SUPIR;
                    $from_nama_kota[$key]=$value->FROM_NAMA_KOTA;
                    $to_nama_kota[$key]=$value->TO_NAMA_KOTA;
                    $pelanggan[$key]=$value->PELANGGAN;
                    $date_muat[$key]=$value->DATE_MUAT;
                    $no_do_pendapatan[$key]=$value->NO_DO_PENDAPATAN;
                    $no_invoice_pendapatan[$key]=$value->NO_INVOICE_PENDAPATAN;
                    $no_spb_pendapatan[$key]=$value->NO_SPB_PENDAPATAN;
                    $lokasi[$key]=$value->LOKASI;

                    $catatan[$key]=$value->CATATAN;

                    $jenis_kendaraan[$key]=$value->JENIS_KENDARAAN;
                    $gandengan[$key]=$value->GANDENGAN;
                    $jarak[$key]=0;

                    $departmen[$key]=$value->DEPARTEMEN;
                    $qty_jurnal[$key]=$value->QTY_JURNAL;
                    $harga_jurnal[$key]=$value->HARGA_JURNAL;




                  }
                  $total_data = $key;




                  if($data_logic==1)
                  {
                  for($i=0;$i<=$total_data;$i++)
                  {
                            $row=$row+1;

                            $alpa='A';
                            $sheet->setCellValue($alpa.$row, $i+1);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $no_voucer[$i] );
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_date[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $no_akun[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $nama_akun[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');





                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $catatan[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $jenis_kendaraan[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $no_polisi[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $supir[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $gandengan[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $jarak[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $lokasi[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $pelanggan[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $departmen[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $no_do_pendapatan[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $no_spb_pendapatan[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $from_nama_kota[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $to_nama_kota[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $qty_jurnal[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $harga_jurnal[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                          





                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $debit[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $kredit[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_created_by[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_updated_by[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                    
                        if ( $i > 0 and $created_id[$i] != $created_id[($i - 1)]) 
                        {
                          $alp='A';
                          $total_alp=23;
                          for($n=0;$n<=$total_alp;$n++)
                          {
                                $area = $alp.$row;
                                $spreadsheet->getActiveSheet()->getStyle($area)
                                          ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                
                                
                                $alp++;
                          }
                        }

                          $spreadsheet->getActiveSheet()
                                  ->getStyle('S'.$row.':V'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

                          
                        
                        
                  }


                  $row = $row + 1;
                         
                           

                            $sheet->setCellValue('U'.$row, $total_debit);
                            $sheet->getStyle('U'.$row)->getAlignment()->setHorizontal('center');

                            $sheet->setCellValue('V'.$row, $total_kredit);
                            $sheet->getStyle('V'.$row)->getAlignment()->setHorizontal('center');

                        $alp='A';
                        $total_alp=23;
                        for($n=0;$n<=$total_alp;$n++)
                        {
                              $area = $alp.$row;
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                              $spreadsheet->getActiveSheet()->getStyle($area)
                                        ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                              
                              $alp++;
                        }

                          $spreadsheet->getActiveSheet()
                                  ->getStyle('U'.$row.':V'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                  

                  }#end of data logic ==1



                  $writer = new Xlsx($spreadsheet);
                  $filename = 'lap_jurnal';
                  
                  header('Content-Type: application/vnd.ms-excel');
                  header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                  header('Cache-Control: max-age=0');
      
                  $writer->save('php://output');
            }
      }
?>

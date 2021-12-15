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

      class Lap_neraca_bulanan extends CI_Controller{

            public function __construct()
            {
                parent::__construct();

                $this->load->model('m_t_m_d_no_polisi');
                

            }



            public function index($date_from_laporan,$date_to_laporan)
            {
                $total_day=intval(((round(abs(strtotime($date_from_laporan) - strtotime($date_to_laporan)) / (60*60*24),0))+1)/2);


                $date=date_create($date_from_laporan);
                date_add($date,date_interval_create_from_date_string("{$total_day} days"));
                $month_int = intval(date_format($date,"m"));
                

                  $spreadsheet = new Spreadsheet();


                  $alp='A';
                  $total_colom=11;
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
                  $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':L'.$row);
                  $sheet = $spreadsheet->getActiveSheet();
                  $sheet->setCellValue('A'.$row, 'PT. MITRA ANGKUTAN SEJATI');
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


                  $row=$row+1;
                  $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                  $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':L'.$row);
                  $sheet = $spreadsheet->getActiveSheet();
                  $sheet->setCellValue('A'.$row, 'Laporan Neraca Bulanan');
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');

                  $row=$row+1;
                  $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                  $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':L'.$row);
                  $sheet = $spreadsheet->getActiveSheet();
                  $sheet->setCellValue('A'.$row, 'Dari '.date('d-m-Y', strtotime($date_from_laporan)).' Sampai '.date('d-m-Y', strtotime($date_to_laporan)));
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


             





                  $row=$row+1;
                  $alpa='A';
                  $sheet->setCellValue($alpa.$row, 'No');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'No Polisi');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Jenis Kendaraan');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Nama Supir');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Lokasi');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Total Jarak (Km)');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');



                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Hasil');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');



                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Spare Part');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Uang Jalan');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;

                  $sheet->setCellValue($alpa.$row, 'Gaji Supir');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Biaya Lainnya');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Hasil');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  




                  // $alpa++;
                  // $sheet->setCellValue($alpa.$row, 'Created By');
                  // $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  // $alpa++;
                  // $sheet->setCellValue($alpa.$row, 'Updated By');
                  // $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                 



                        $alp='A';
                        $total_alp=11;
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

                 

                  $read_select = $this->m_t_m_d_no_polisi->select_neraca_bulanan();
                  foreach ($read_select as $key => $value) 
                  {   
                        $data_logic = 1;
                        $r_no_polisi[$key]=$value->NO_POLISI;
                        $r_jenis_kendaraan[$key]=$value->JENIS_KENDARAAN;
                        $r_supir[$key]='';
                        $r_lokasi[$key]='';



                        $r_bruto_kebun[$key]=$value->SUM_JARAK_KM;
                        $r_tara_kebun[$key]=$value->SUM_SUB_TOTAL;
                        $r_value_kebun[$key]=$value->SUM_SPARE_PART;
                        $r_bruto_pabrik[$key]=$value->SUM_UANG_JALAN;
                        $r_tara_pabrik[$key]=$value->SUM_GAJI_SUPIR;
                        $r_value_pabrik[$key]=$value->SUM_BIAYA_LAINNYA;

                       
                  }
                  $total_data = $key;



                  $sum_value_pabrik=0;
                  $sum_value_kebun=0;
                

                  if($data_logic==1)
                  {
                  for($i=0;$i<=$total_data;$i++)
                  {
                            $row=$row+1;

                            $alpa='A';
                            $sheet->setCellValue($alpa.$row, $i+1);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_no_spb[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');



                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_date_muat[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                          
                            

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_date_bongkar[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_no_polisi[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_bruto_kebun[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_tara_kebun[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_value_kebun[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_bruto_pabrik[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_tara_pabrik[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_value_pabrik[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');



                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_ket[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');

                           


                            // $alpa++;
                            // $sheet->setCellValue($alpa.$row, $r_created_by[$i]);
                            // $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            // $alpa++;
                            // $sheet->setCellValue($alpa.$row, $r_updated_by[$i]);
                            // $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $sum_value_kebun = $sum_value_kebun + $r_value_kebun[$i];
                            $sum_value_pabrik = $sum_value_pabrik + $r_value_pabrik[$i];


                        

                        


                       

                          $spreadsheet->getActiveSheet()
                                  ->getStyle('D'.$row.':L'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

                          
                  }

                  $row=$row+1;



                  $alp='A';
                  $total_alp=11;
                  for($n=0;$n<=$total_alp;$n++)
                  {
                    $area = $alp.$row;
                    $spreadsheet->getActiveSheet()->getStyle($area)
                                ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                              
                    $alp++;
                  }



                  $alpa='H';
                  $sheet->setCellValue($alpa.$row, $sum_value_kebun);
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');


                  $alpa='K';
                  $sheet->setCellValue($alpa.$row, $sum_value_pabrik);
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('right');

                  $spreadsheet->getActiveSheet()
                                  ->getStyle('H'.$row.':L'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);


                        

                  

                  }#end of data logic ==1



                  $writer = new Xlsx($spreadsheet);
                  $filename = 'Lap_rekapitulasi';
                  
                  header('Content-Type: application/vnd.ms-excel');
                  header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                  header('Cache-Control: max-age=0');
      
                  $writer->save('php://output');
            }
      }
?>

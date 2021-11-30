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

      class Lap_do_global extends CI_Controller{

            public function __construct()
            {
                parent::__construct();

                $this->load->model('m_t_t_t_penjualan_jasa_3');
                

            }



            public function index($date_from_laporan,$date_to_laporan)
            {
              $this->session->set_userdata('t_t_t_penjualan_jasa_1_delete_logic', '0');

              $total_day=intval(((round(abs(strtotime($date_from_laporan) - strtotime($date_to_laporan)) / (60*60*24),0))+1)/2);


                $date=date_create($date_from_laporan);
                date_add($date,date_interval_create_from_date_string("{$total_day} days"));
                $month_int = intval(date_format($date,"m"));


                  $spreadsheet = new Spreadsheet();


                  $alp='A';
                  $total_colom=21;
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
                  $sheet->setCellValue('A'.$row, 'Laporan DO GLOBAL');
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
                  $sheet->setCellValue($alpa.$row, 'NO. DO');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'TGL DO');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'NO.KONTRAK');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'TUJUAN BONGKAR');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'PARTY');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'KEBUN');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'BONGKAR');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'SISA');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;

                  $sheet->setCellValue($alpa.$row, 'SUSUT');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, '% SUSUT');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'KET');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'NO. INVOICE');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'tonase inv');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'sisa  tonase');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');



                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Created By');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Updated By');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                 



                        $alp='A';
                        $total_alp=16;
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

                  $read_select = $this->m_t_t_t_penjualan_jasa_3->select_by_date($date_from_laporan,$date_to_laporan,1);
                  foreach ($read_select as $key => $value) 
                  {   
                    $data_logic = 1;
                        $r_id[$key]=$value->ID;
                        $r_date[$key]=$value->DATE;
                        $r_time[$key]=$value->TIME;
                        $r_no_do[$key]=$value->NO_DO;
                        
                        $r_no_kontrak[$key]=$value->NO_KONTRAK;

                        $r_pelanggan[$key]=$value->PELANGGAN;
                        $r_target_party[$key]=$value->TARGET_PARTY;
                        $r_sum_value_kebun[$key]=$value->SUM_VALUE_KEBUN;
                        $r_sum_value_pabrik[$key]=$value->SUM_VALUE_PABRIK;
                        
                        $r_sisa[$key] = $value->TARGET_PARTY-$value->SUM_VALUE_KEBUN;
                        $r_susut[$key] = $value->SUM_VALUE_KEBUN-$value->SUM_VALUE_PABRIK;


                        if($value->SUM_VALUE_KEBUN>0)
                        {
                          $r_susut_percentage[$key] = (($value->SUM_VALUE_KEBUN-$value->SUM_VALUE_PABRIK)/$value->SUM_VALUE_KEBUN)*100;
                        }

                        if($value->SUM_VALUE_KEBUN<=0)
                        {
                          $r_susut_percentage[$key] = 0;
                        }
                        

                        if($r_sisa[$key]<=0)
                        {
                          $r_ket[$key]='LEBIH ANGKUT';
                        }
                        if($r_sisa[$key]>0)
                        {
                          $r_ket[$key]='SELESAI ANGKUT';
                        }



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
                            $sheet->setCellValue($alpa.$row, $r_no_do[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, date('d-m-y', strtotime($r_date[$i])).'/'.date('H:i', strtotime($r_time[$i])));
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                            

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_no_kontrak[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_pelanggan[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_target_party[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_sum_value_kebun[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_sum_value_pabrik[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_sisa[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_susut[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_susut_percentage[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_ket[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, '');
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_sum_value_kebun[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_sisa[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');




                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_created_by[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_updated_by[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');




                        

                        



                        $sum_all_target_party=$sum_all_target_party + $r_target_party[$i];
                        $sum_all_value_kebun=$sum_all_value_kebun + $r_sum_value_kebun[$i];
                        $sum_all_value_pabrik=$sum_all_value_pabrik + $r_sum_value_pabrik[$i];
                        $sum_all_sisa= $sum_all_sisa + $r_sisa[$i];
                        $sum_all_susut= $sum_all_susut + $r_susut[$i];

                       

                          $spreadsheet->getActiveSheet()
                                  ->getStyle('F'.$row.':O'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

                          
                  }


                  $row = $row + 1;
                        

                        $alpa='F';

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $sum_all_target_party);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $sum_all_value_kebun);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $sum_all_value_pabrik);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $sum_all_sisa);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $sum_all_susut);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');







                        $alp='A';
                        $total_alp=16;
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
                                  ->getStyle('F'.$row.':O'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                  

                  }#end of data logic ==1



                  $writer = new Xlsx($spreadsheet);
                  $filename = 'Lap_DO_Global';
                  
                  header('Content-Type: application/vnd.ms-excel');
                  header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                  header('Cache-Control: max-age=0');
      
                  $writer->save('php://output');
            }
      }
?>

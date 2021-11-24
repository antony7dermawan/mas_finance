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

      class Lap_trial_balance extends CI_Controller{

            public function __construct()
            {
                parent::__construct();

                $this->load->model('m_ak_m_coa');
                

            }



            public function index($date_from_laporan,$date_to_laporan)
            {
             

              $total_day=intval(((round(abs(strtotime($date_from_laporan) - strtotime($date_to_laporan)) / (60*60*24),0))+1)/2);


                $date=date_create($date_from_laporan);
                date_add($date,date_interval_create_from_date_string("{$total_day} days"));
                $month_int = intval(date_format($date,"m"));


                  $spreadsheet = new Spreadsheet();


                  $alp='A';
                  $total_colom=18;
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
                  $sheet->setCellValue('A'.$row, 'Laporan Trial Balance');
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');

                  $row=$row+1;
                  $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                  $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':J'.$row);
                  $sheet = $spreadsheet->getActiveSheet();
                  $sheet->setCellValue('A'.$row, 'Dari '.date('d-m-Y', strtotime($date_from_laporan)).' Sampai '.date('d-m-Y', strtotime($date_to_laporan)));
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');

                  


                  $row=$row+1;
                  $sheet->setCellValue('A'.$row, 'No Akun');
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');
                  $sheet->setCellValue('B'.$row, 'Nama Akun');
                  $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('center');
                  $sheet->setCellValue('C'.$row, 'Saldo Debit Awal');
                  $sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('center');
                  $sheet->setCellValue('D'.$row, 'Saldo Kredit Awal');
                  $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('center');
                  $sheet->setCellValue('E'.$row, 'Debit');
                  $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('center');
                  $sheet->setCellValue('F'.$row, 'Kredit');
                  $sheet->getStyle('F'.$row)->getAlignment()->setHorizontal('center');
                  $sheet->setCellValue('G'.$row, 'Saldo Akhir');
                  $sheet->getStyle('G'.$row)->getAlignment()->setHorizontal('center');
                  

                        $alp='A';
                        $total_alp=6;
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
                  $read_select = $this->m_ak_m_coa->select_trial_balance($date_from_laporan,$date_to_laporan);
                  foreach ($read_select as $key => $value) 
                  {   
                    $data_logic = 1;
                        $r_id[$key]=$value->ID;
                        
                        
                        $r_nama_akun[$key]=$value->NAMA_AKUN;

                        if ($value->NO_AKUN_3 != '') {
                          $r_no_akun[$key] = $value->NO_AKUN_3;
                        } elseif ($value->NO_AKUN_2 != '') {
                          $r_no_akun[$key] = $value->NO_AKUN_2;
                        } else {
                          $r_no_akun[$key] = $value->NO_AKUN_1;
                        }

                        $r_sum_debit_awal[$key]=floatval($value->SUM_DEBIT_AWAL);
                        $r_sum_kredit_awal[$key]=floatval($value->SUM_KREDIT_AWAL);
                        $r_sum_debit[$key]=floatval($value->SUM_DEBIT);
                        $r_sum_kredit[$key]=floatval($value->SUM_KREDIT);

                    if($value->DB_K_ID==1)
                    {
                      $saldo_akhir[$key] = ($value->SUM_DEBIT - $value->SUM_KREDIT)+($value->SUM_DEBIT_AWAL - $value->SUM_KREDIT_AWAL);
                    }
                    if($value->DB_K_ID==2)
                    {
                      $saldo_akhir[$key] = ($value->SUM_KREDIT - $value->SUM_DEBIT)+($value->SUM_KREDIT_AWAL - $value->SUM_DEBIT_AWAL);
                    }
                  }
                  $total_data = $key;



                  $sum_sum_total_harga=0;

                  if($data_logic==1)
                  {
                    for($i=0;$i<=$total_data;$i++)
                    {
                              $row=$row+1;
                              $sheet->setCellValue('A'.$row, $r_no_akun[$i]);
                              $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');
                              $sheet->setCellValue('B'.$row, $r_nama_akun[$i]);
                              $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('left');
                              $sheet->setCellValue('C'.$row, $r_sum_debit_awal[$i]);
                              $sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('right');
                              $sheet->setCellValue('D'.$row, $r_sum_kredit_awal[$i]);
                              $sheet->getStyle('D'.$row)->getAlignment()->setHorizontal('right');
                              $sheet->setCellValue('E'.$row, $r_sum_debit[$i]);
                              $sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('right');
                              $sheet->setCellValue('F'.$row, $r_sum_kredit[$i]);
                              $sheet->getStyle('F'.$row)->getAlignment()->setHorizontal('right');
                              $sheet->setCellValue('G'.$row, $saldo_akhir[$i]);
                              $sheet->getStyle('G'.$row)->getAlignment()->setHorizontal('right');




                            $spreadsheet->getActiveSheet()
                                    ->getStyle('C'.$row.':G'.$row)
                                    ->getNumberFormat()
                                    ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                          
                    }


                  }#end of data logic ==1



                  $writer = new Xlsx($spreadsheet);
                  $filename = 'lap_trial_balance';
                  
                  header('Content-Type: application/vnd.ms-excel');
                  header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                  header('Cache-Control: max-age=0');
      
                  $writer->save('php://output');
            }
      }
?>

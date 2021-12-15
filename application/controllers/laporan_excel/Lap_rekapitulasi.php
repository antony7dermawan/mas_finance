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

      class Lap_rekapitulasi extends CI_Controller{

            public function __construct()
            {
                parent::__construct();

                $this->load->model('m_t_t_t_penjualan_jasa_3');
                $this->load->model('m_t_t_t_penjualan_jasa_rincian_3');
                

            }



            public function index($penjualan_jasa_id)
            {
                
                $read_select = $this->m_t_t_t_penjualan_jasa_3->select_by_id($penjualan_jasa_id);
                foreach ($read_select as $key => $value) 
                {
                  $no_kontrak = $value->NO_KONTRAK;
                  $no_do = $value->NO_DO;
                  $date_do = $value->DATE;
                  $target_party = $value->TARGET_PARTY;
                  $pelanggan = $value->PELANGGAN;
                }

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
                  $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':F'.$row);
                  $sheet = $spreadsheet->getActiveSheet();
                  $sheet->setCellValue('A'.$row, 'PT. MITRA ANGKUTAN SEJATI');
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');


                  $row=$row+1;
                  $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                  $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':F'.$row);
                  $sheet = $spreadsheet->getActiveSheet();
                  $sheet->setCellValue('A'.$row, 'Jl. S.M Amin (Arengka II)');
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                  $row=$row+1;
                  $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                  $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':F'.$row);
                  $sheet = $spreadsheet->getActiveSheet();
                  $sheet->setCellValue('A'.$row, 'No.226 (Samping Simp.Tiga Dara) Pekanbaru');
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');

                  $row=$row+1;
                  $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                  $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':F'.$row);
                  $sheet = $spreadsheet->getActiveSheet();
                  $sheet->setCellValue('A'.$row, 'Telp. (0761) 565226 Fax. (0761)565366');
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('left');



                  $row=$row+1;
                  $spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
                  $spreadsheet->getActiveSheet()->mergeCells('A'.$row.':L'.$row);
                  $sheet = $spreadsheet->getActiveSheet();
                  $sheet->setCellValue('A'.$row, 'REKAPITULASI ANGKUTAN MKS');
                  $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');


                  $row=$row+1;
                  $alpa='A';
                  $sheet->setCellValue($alpa.$row, 'No.Kontrak');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                  $alpa='C';
                  $sheet->setCellValue($alpa.$row, ':'.$no_kontrak);
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');



                  $row=$row+1;
                  $alpa='A';
                  $sheet->setCellValue($alpa.$row, 'No.DO');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                  $alpa='C';
                  $sheet->setCellValue($alpa.$row, ':'.$no_do);
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');



                  $row=$row+1;
                  $alpa='A';
                  $sheet->setCellValue($alpa.$row, 'Tanggal DO');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                  $alpa='C';
                  $sheet->setCellValue($alpa.$row, ':'.$date_do);
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                  $row=$row+1;
                  $alpa='A';
                  $sheet->setCellValue($alpa.$row, 'Party');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                  $alpa='C';
                  $sheet->setCellValue($alpa.$row, ':'.$target_party);
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');



                  $row=$row+1;
                  $alpa='A';
                  $sheet->setCellValue($alpa.$row, 'Pelanggan');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                  $alpa='C';
                  $sheet->setCellValue($alpa.$row, ':'.$pelanggan);
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


             





                  $row=$row+1;
                  $alpa='A';
                  $sheet->setCellValue($alpa.$row, 'No');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'No SPB');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Tgl Muat');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Tgl Bongkar');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'No Polisi');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Bruto (Kebun)');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');



                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Tara (Kebun)');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');



                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Netto (Kebun)');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Bruto (Pabrik)');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;

                  $sheet->setCellValue($alpa.$row, 'Tara (Pabrik)');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Netto (Pabrik)');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Susut (Kg)');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Keterangan');
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

                 

                  $read_select = $this->m_t_t_t_penjualan_jasa_rincian_3->select($penjualan_jasa_id);
                  foreach ($read_select as $key => $value) 
                  {   
                        $data_logic = 1;
                        $r_no_spb[$key]=$value->NO_SPB;
                        $r_date_muat[$key]=$value->DATE_MUAT;
                        $r_date_bongkar[$key]=$value->DATE_BONGKAR;



                        $r_no_polisi[$key]=$value->NO_POLISI;

                        $r_bruto_kebun[$key]=$value->BRUTO_KEBUN;
                        $r_tara_kebun[$key]=$value->TARA_KEBUN;
                        $r_value_kebun[$key]=$value->VALUE_KEBUN;
                        $r_bruto_pabrik[$key]=$value->BRUTO_PABRIK;
                        $r_tara_pabrik[$key]=$value->TARA_PABRIK;
                        $r_value_pabrik[$key]=$value->VALUE_PABRIK;
                        $r_value_pabrik[$key]=$value->VALUE_PABRIK;
                        $r_value_susut[$key]=$value->VALUE_SUSUT;

                        $r_ket[$key]=$value->KET;







                        $r_created_by[$key]=$value->CREATED_BY;
                        $r_updated_by[$key]=$value->UPDATED_BY;
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
                            $sheet->setCellValue($alpa.$row, $r_value_susut[$i]);
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

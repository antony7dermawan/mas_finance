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
                  $total_colom=38;
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
                  $sheet->setCellValue($alpa.$row, 'Total Jarak (Km)');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Trip');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'PENDAPATAN');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');



                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'BEBAN UANG JLN');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'BEBAN MOBILISASI');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;

                  $sheet->setCellValue($alpa.$row, 'BEBAN MOBILISASI GABUNGAN');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'PINJAMAN SUPIR');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'GAJI/UPAH');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'BEBAN SPAREPART');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'OPS LAPANGAN');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'BEBAN PAJAK KENDARAAN (STNK)');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'BEBAN VEE');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'BEBAN KAPAL');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'BEBAN CKB');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'BEBAN APS');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'BEBAN RENTAL');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Beban Mekanik');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Beban Tukang Las');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Beban Tukang Wayar');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Beban Tukang Ban');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Beban Tukang Pispot');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Perbaikan & Pemeliharaan Kendaraan Truck ');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Beban GPS Kendaraan');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Beban Pengobatan ');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Beban Pengawalan');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Beban Asuransi Kendaraan ');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Beban Asuransi Alat Berat');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Tunjangan Hari Raya');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Tunjangan Bonus Kerajinan');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Tunjangan Pesangon');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Tunjangan Cuti Dan Ongkos Naik');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'Tunjangan Rumah');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'BEBAN LEMBUR');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'GRAN TOTAL');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  $alpa++;
                  $sheet->setCellValue($alpa.$row, 'SISA HASIL');
                  $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                  




                  // $alpa++;
                  // $sheet->setCellValue($alpa.$row, 'Created By');
                  // $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');


                  // $alpa++;
                  // $sheet->setCellValue($alpa.$row, 'Updated By');
                  // $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');
                 



                        $alp='A';
                        $total_alp=38;
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

                 $sum_pendapatan = 0;
                 $sum_bb_uj = 0;
                 $sum_pinj_supir = 0;
                 $sum_gaji_up = 0;

                 $sum_tj_raya = 0;
                 $sum_grand_total = 0;
                 $sum_sisa_hasil = 0;

                  $read_select = $this->m_t_m_d_no_polisi->select_neraca_bulanan($date_from_laporan,$date_to_laporan);
                  foreach ($read_select as $key => $value) 
                  {     

                      


                        $data_logic = 1;
                        $r_no_polisi[$key]=$value->NO_POLISI;
                        $r_jenis_kendaraan[$key]=$value->JENIS_KENDARAAN;
                        $r_supir[$key]='';
                        $r_lokasi[$key]='';



                        $r_sum_jarak_km[$key]=intval($value->SUM_JARAK_KM);
                        $r_sum_sub_total[$key]=intval($value->SUM_SUB_TOTAL);
                        $r_sum_trip[$key]=intval($value->SUM_TRIP);



                        $r_SUM_6110101[$key]=intval($value->SUM_DEBIT_6110101 - $value->SUM_KREDIT_6110101);
                        $r_SUM_6110109[$key]=intval($value->SUM_DEBIT_6110109 - $value->SUM_KREDIT_6110109);
                        $r_SUM_6110102[$key]=intval($value->SUM_DEBIT_6110102 - $value->SUM_KREDIT_6110102);


                        $r_SUM_1310002[$key]=intval($value->SUM_DEBIT_1310002 - $value->SUM_KREDIT_1310002);
                        $r_SUM_6210104[$key]=intval($value->SUM_DEBIT_6210104 - $value->SUM_KREDIT_6210104);
                        $r_SUM_6110103[$key]=intval($value->SUM_DEBIT_6110103 - $value->SUM_KREDIT_6110103);
                        $r_SUM_6310104[$key]=intval($value->SUM_DEBIT_6310104 - $value->SUM_KREDIT_6310104);
                        $r_SUM_6510106[$key]=intval($value->SUM_DEBIT_6510106 - $value->SUM_KREDIT_6510106);
                        $r_SUM_6110108[$key]=intval($value->SUM_DEBIT_6110108 - $value->SUM_KREDIT_6110108);
                        $r_SUM_6110104[$key]=intval($value->SUM_DEBIT_6110104 - $value->SUM_KREDIT_6110104);
                        $r_SUM_6110107[$key]=intval($value->SUM_DEBIT_6110107 - $value->SUM_KREDIT_6110107);
                        $r_SUM_6110106[$key]=intval($value->SUM_DEBIT_6110106 - $value->SUM_KREDIT_6110106);
                        $r_SUM_6110105[$key]=intval($value->SUM_DEBIT_6110105 - $value->SUM_KREDIT_6110105);
                        $r_SUM_6900001[$key]=intval($value->SUM_DEBIT_6900001 - $value->SUM_KREDIT_6900001);
                        $r_SUM_6900002[$key]=intval($value->SUM_DEBIT_6900002 - $value->SUM_KREDIT_6900002);
                        $r_SUM_6900003[$key]=intval($value->SUM_DEBIT_6900003 - $value->SUM_KREDIT_6900003);
                        $r_SUM_6900004[$key]=intval($value->SUM_DEBIT_6900004 - $value->SUM_KREDIT_6900004);
                        $r_SUM_6900005[$key]=intval($value->SUM_DEBIT_6900005 - $value->SUM_KREDIT_6900005);
                        $r_SUM_6610103[$key]=intval($value->SUM_DEBIT_6610103 - $value->SUM_KREDIT_6610103);
                        $r_SUM_6610106[$key]=intval($value->SUM_DEBIT_6610106 - $value->SUM_KREDIT_6610106);
                        $r_SUM_6230004[$key]=intval($value->SUM_DEBIT_6230004 - $value->SUM_KREDIT_6230004);
                        $r_SUM_6810100[$key]=intval($value->SUM_DEBIT_6810100 - $value->SUM_KREDIT_6810100);
                        $r_SUM_6510401[$key]=intval($value->SUM_DEBIT_6510401 - $value->SUM_KREDIT_6510401);
                        $r_SUM_6510402[$key]=intval($value->SUM_DEBIT_6510402 - $value->SUM_KREDIT_6510402);
                        $r_SUM_6210105[$key]=intval($value->SUM_DEBIT_6210105 - $value->SUM_KREDIT_6210105);
                        $r_SUM_6210112[$key]=intval($value->SUM_DEBIT_6210112 - $value->SUM_KREDIT_6210112);
                        $r_SUM_6210107[$key]=intval($value->SUM_DEBIT_6210107 - $value->SUM_KREDIT_6210107);
                        $r_SUM_6210108[$key]=intval($value->SUM_DEBIT_6210108 - $value->SUM_KREDIT_6210108);
                        $r_SUM_6210109[$key]=intval($value->SUM_DEBIT_6210109 - $value->SUM_KREDIT_6210109);
                        $r_SUM_6210110[$key]=intval($value->SUM_DEBIT_6210110 - $value->SUM_KREDIT_6210110);




   

                        $r_grand_total[$key]=intval($r_SUM_1310002[$key]+$r_SUM_6210104[$key]+$r_SUM_6110103[$key]+$r_SUM_6310104[$key]+$r_SUM_6510106[$key]+$r_SUM_6110108[$key]+$r_SUM_6110104[$key]+$r_SUM_6110107[$key]+$r_SUM_6110106[$key]+$r_SUM_6110105[$key]+$r_SUM_6900001[$key]+$r_SUM_6900002[$key]+$r_SUM_6900003[$key]+$r_SUM_6900004[$key]+$r_SUM_6900005[$key]+$r_SUM_6610103[$key]+$r_SUM_6610106[$key]+$r_SUM_6230004[$key]+$r_SUM_6810100[$key]+$r_SUM_6510401[$key]+$r_SUM_6510402[$key]+$r_SUM_6210105[$key]+$r_SUM_6210112[$key]+$r_SUM_6210107[$key]+$r_SUM_6210108[$key]+$r_SUM_6210109[$key]+$r_SUM_6210110[$key]);

                        $sisa_hasil[$key]=intval($r_sum_sub_total[$key]-$r_SUM_6110101[$key]-$r_SUM_6110109[$key]-$r_SUM_6110102[$key]-$r_grand_total[$key]);




                        $sum_pendapatan = $sum_pendapatan + $r_sum_sub_total[$key];
                        $sum_bb_uj = $sum_bb_uj + $r_SUM_6110101[$key];
                        $sum_pinj_supir = $sum_pinj_supir + $r_SUM_1310002[$key];
                        $sum_gaji_up = $sum_gaji_up + $r_SUM_6210104[$key];

                        $sum_tj_raya = $sum_tj_raya + $r_SUM_6210105[$key];
                        $sum_grand_total = $sum_grand_total + $r_grand_total[$key];
                        $sum_sisa_hasil = $sum_sisa_hasil + $sisa_hasil[$key];

                      

                       
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
                            $sheet->setCellValue($alpa.$row, $r_no_polisi[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_jenis_kendaraan[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_supir[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_sum_jarak_km[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_sum_trip[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_sum_sub_total[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6110101[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

         
                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6110109[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6110102[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_1310002[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6210104[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6110103[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6310104[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6510106[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6110108[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6110104[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6110107[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6110106[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6110105[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6900001[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6900002[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6900003[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6900004[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6900005[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6610103[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6610106[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6230004[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6810100[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6510401[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6510402[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6210105[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6210112[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6210107[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6210108[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6210109[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_SUM_6210110[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');


                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $r_grand_total[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');

                            $alpa++;
                            $sheet->setCellValue($alpa.$row, $sisa_hasil[$i]);
                            $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('left');





                           


                            // $alpa++;
                            // $sheet->setCellValue($alpa.$row, $r_created_by[$i]);
                            // $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                            // $alpa++;
                            // $sheet->setCellValue($alpa.$row, $r_updated_by[$i]);
                            // $sheet->getStyle($alpa.$row)->getAlignment()->setHorizontal('center');

                       


                        

                        


                       

                          $spreadsheet->getActiveSheet()
                                  ->getStyle('D'.$row.':AM'.$row)
                                  ->getNumberFormat()
                                  ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

                          
                  }

                  $row=$row+1;



                  $alp='A';
                  $total_alp=38;
                  for($n=0;$n<=$total_alp;$n++)
                  {
                    $area = $alp.$row;
                    $spreadsheet->getActiveSheet()->getStyle($area)
                                ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                              
                    $alp++;
                  }

   

                    $sheet->setCellValue('F'.$row, 'Total');
                    $sheet->setCellValue('G'.$row, $sum_pendapatan);
                    $sheet->getStyle('G'.$row)->getAlignment()->setHorizontal('left');
                    $sheet->setCellValue('H'.$row, $sum_bb_uj);
                    $sheet->getStyle('H'.$row)->getAlignment()->setHorizontal('left');

                    $sheet->setCellValue('K'.$row, $sum_pinj_supir);
                    $sheet->getStyle('K'.$row)->getAlignment()->setHorizontal('left');

                    $sheet->setCellValue('L'.$row, $sum_gaji_up);
                    $sheet->getStyle('L'.$row)->getAlignment()->setHorizontal('left');

                    $sheet->setCellValue('AF'.$row, $sum_tj_raya);
                    $sheet->getStyle('AF'.$row)->getAlignment()->setHorizontal('left');

                    $sheet->setCellValue('AL'.$row, $sum_grand_total);
                    $sheet->getStyle('AL'.$row)->getAlignment()->setHorizontal('left');

                    $sheet->setCellValue('AM'.$row, $sum_sisa_hasil);
                    $sheet->getStyle('AM'.$row)->getAlignment()->setHorizontal('left');




                    $spreadsheet->getActiveSheet()
                                    ->getStyle('G'.$row.':AM'.$row)
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

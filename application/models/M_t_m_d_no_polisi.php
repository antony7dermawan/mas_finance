<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_t_m_d_no_polisi extends CI_Model {
    
  

public function update($data, $id)
{
    $this->db->where('ID', $id);
    return $this->db->update('T_M_D_NO_POLISI', $data);
}

public function select_id($id)
{
  $this->db->select('ID');
  $this->db->from('T_M_D_NO_POLISI');
  $this->db->where('NO_POLISI', $id);
  $akun = $this->db->get ();
  return $akun->result ();
}


  public function select_option()
  {
    $this->db->select('*');
    $this->db->from('T_M_D_NO_POLISI');
    $this->db->where("MARK_FOR_DELETE=false");
    $this->db->order_by("ID", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  } 




  public function select_neraca_bulanan($from_date,$to_date)
  {
    $this->db->select('T_M_D_NO_POLISI.ID');
    $this->db->select('T_M_D_NO_POLISI.NO_POLISI');
    $this->db->select('T_M_D_NO_POLISI.NO_UNIT');
    $this->db->select('T_M_D_NO_POLISI.CREATED_BY');
    $this->db->select('T_M_D_NO_POLISI.UPDATED_BY');
    $this->db->select('T_M_D_NO_POLISI.MARK_FOR_DELETE');
    $this->db->select('T_M_D_JENIS_KENDARAAN.JENIS_KENDARAAN');



    $this->db->select('SUM_SUB_TOTAL');
    $this->db->select('SUM_TRIP');
    $this->db->select('SUM_JARAK_KM');



    $this->db->select('SUM_DEBIT_6110101');
    $this->db->select('SUM_KREDIT_6110101');


    $this->db->select('SUM_DEBIT_6110109');
    $this->db->select('SUM_KREDIT_6110109');


    $this->db->select('SUM_DEBIT_6110102');
    $this->db->select('SUM_KREDIT_6110102');

    $this->db->select('SUM_DEBIT_1310002');
    $this->db->select('SUM_KREDIT_1310002');


    $this->db->select('SUM_DEBIT_6210104');
    $this->db->select('SUM_KREDIT_6210104');


    $this->db->select('SUM_DEBIT_6110103');
    $this->db->select('SUM_KREDIT_6110103');


    $this->db->select('SUM_DEBIT_6310104');
    $this->db->select('SUM_KREDIT_6310104');

    $this->db->select('SUM_DEBIT_6510106');
    $this->db->select('SUM_KREDIT_6510106');

    $this->db->select('SUM_DEBIT_6110108');
    $this->db->select('SUM_KREDIT_6110108');

    $this->db->select('SUM_DEBIT_6110104');
    $this->db->select('SUM_KREDIT_6110104');

    $this->db->select('SUM_DEBIT_6110107');
    $this->db->select('SUM_KREDIT_6110107');

    $this->db->select('SUM_DEBIT_6110106');
    $this->db->select('SUM_KREDIT_6110106');

    $this->db->select('SUM_DEBIT_6110105');
    $this->db->select('SUM_KREDIT_6110105');

    $this->db->select('SUM_DEBIT_6900001');
    $this->db->select('SUM_KREDIT_6900001');

    $this->db->select('SUM_DEBIT_6900002');
    $this->db->select('SUM_KREDIT_6900002');


    $this->db->select('SUM_DEBIT_6900003');
    $this->db->select('SUM_KREDIT_6900003');

    $this->db->select('SUM_DEBIT_6900004');
    $this->db->select('SUM_KREDIT_6900004');

    $this->db->select('SUM_DEBIT_6900005');
    $this->db->select('SUM_KREDIT_6900005');

    $this->db->select('SUM_DEBIT_6610103');
    $this->db->select('SUM_KREDIT_6610103');

    $this->db->select('SUM_DEBIT_6610106');
    $this->db->select('SUM_KREDIT_6610106');

    $this->db->select('SUM_DEBIT_6230004');
    $this->db->select('SUM_KREDIT_6230004');


    $this->db->select('SUM_DEBIT_6810100');
    $this->db->select('SUM_KREDIT_6810100');

    $this->db->select('SUM_DEBIT_6510401');
    $this->db->select('SUM_KREDIT_6510401');


    $this->db->select('SUM_DEBIT_6510402');
    $this->db->select('SUM_KREDIT_6510402');

    $this->db->select('SUM_DEBIT_6210105');
    $this->db->select('SUM_KREDIT_6210105');

    $this->db->select('SUM_DEBIT_6210112');
    $this->db->select('SUM_KREDIT_6210112');

    $this->db->select('SUM_DEBIT_6210107');
    $this->db->select('SUM_KREDIT_6210107');

    $this->db->select('SUM_DEBIT_6210108');
    $this->db->select('SUM_KREDIT_6210108');

    $this->db->select('SUM_DEBIT_6210109');
    $this->db->select('SUM_KREDIT_6210109');

    $this->db->select('SUM_DEBIT_6210110');
    $this->db->select('SUM_KREDIT_6210110');

    $this->db->from('T_M_D_NO_POLISI');


    $this->db->join('T_M_D_JENIS_KENDARAAN', 'T_M_D_JENIS_KENDARAAN.ID = T_M_D_NO_POLISI.JENIS_KENDARAAN_ID', 'left');


    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6210110\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5557 group by \"NO_POLISI_ID\") as t_sum_64", 'T_M_D_NO_POLISI.ID = t_sum_64.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6210110\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5557 group by \"NO_POLISI_ID\") as t_sum_65", 'T_M_D_NO_POLISI.ID = t_sum_65.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6210109\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5288 group by \"NO_POLISI_ID\") as t_sum_62", 'T_M_D_NO_POLISI.ID = t_sum_62.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6210109\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5288 group by \"NO_POLISI_ID\") as t_sum_63", 'T_M_D_NO_POLISI.ID = t_sum_63.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6210108\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5287 group by \"NO_POLISI_ID\") as t_sum_60", 'T_M_D_NO_POLISI.ID = t_sum_60.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6210108\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5287 group by \"NO_POLISI_ID\") as t_sum_61", 'T_M_D_NO_POLISI.ID = t_sum_61.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6210107\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5286 group by \"NO_POLISI_ID\") as t_sum_58", 'T_M_D_NO_POLISI.ID = t_sum_58.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6210107\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5286 group by \"NO_POLISI_ID\") as t_sum_59", 'T_M_D_NO_POLISI.ID = t_sum_59.NO_POLISI_ID', 'left');


    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6210112\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5285 group by \"NO_POLISI_ID\") as t_sum_54", 'T_M_D_NO_POLISI.ID = t_sum_54.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6210112\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5285 group by \"NO_POLISI_ID\") as t_sum_55", 'T_M_D_NO_POLISI.ID = t_sum_55.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6210105\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5282 group by \"NO_POLISI_ID\") as t_sum_52", 'T_M_D_NO_POLISI.ID = t_sum_52.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6210105\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5282 group by \"NO_POLISI_ID\") as t_sum_53", 'T_M_D_NO_POLISI.ID = t_sum_53.NO_POLISI_ID', 'left');


    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6510402\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5431 group by \"NO_POLISI_ID\") as t_sum_50", 'T_M_D_NO_POLISI.ID = t_sum_50.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6510402\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5431 group by \"NO_POLISI_ID\") as t_sum_51", 'T_M_D_NO_POLISI.ID = t_sum_51.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6510401\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5430 group by \"NO_POLISI_ID\") as t_sum_48", 'T_M_D_NO_POLISI.ID = t_sum_48.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6510401\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5430 group by \"NO_POLISI_ID\") as t_sum_49", 'T_M_D_NO_POLISI.ID = t_sum_49.NO_POLISI_ID', 'left');


    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6810100\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5467 group by \"NO_POLISI_ID\") as t_sum_46", 'T_M_D_NO_POLISI.ID = t_sum_46.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6810100\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5467 group by \"NO_POLISI_ID\") as t_sum_47", 'T_M_D_NO_POLISI.ID = t_sum_47.NO_POLISI_ID', 'left');


    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6230004\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5319 group by \"NO_POLISI_ID\") as t_sum_44", 'T_M_D_NO_POLISI.ID = t_sum_44.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6230004\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5319 group by \"NO_POLISI_ID\") as t_sum_45", 'T_M_D_NO_POLISI.ID = t_sum_45.NO_POLISI_ID', 'left');


    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6610106\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5443 group by \"NO_POLISI_ID\") as t_sum_42", 'T_M_D_NO_POLISI.ID = t_sum_42.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6610106\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5443 group by \"NO_POLISI_ID\") as t_sum_43", 'T_M_D_NO_POLISI.ID = t_sum_43.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6610103\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5440 group by \"NO_POLISI_ID\") as t_sum_40", 'T_M_D_NO_POLISI.ID = t_sum_40.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6610103\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5440 group by \"NO_POLISI_ID\") as t_sum_41", 'T_M_D_NO_POLISI.ID = t_sum_41.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6900005\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5559 group by \"NO_POLISI_ID\") as t_sum_38", 'T_M_D_NO_POLISI.ID = t_sum_38.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6900005\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5559 group by \"NO_POLISI_ID\") as t_sum_39", 'T_M_D_NO_POLISI.ID = t_sum_39.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6900004\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5474 group by \"NO_POLISI_ID\") as t_sum_36", 'T_M_D_NO_POLISI.ID = t_sum_36.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6900004\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5474 group by \"NO_POLISI_ID\") as t_sum_37", 'T_M_D_NO_POLISI.ID = t_sum_37.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6900003\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5473 group by \"NO_POLISI_ID\") as t_sum_34", 'T_M_D_NO_POLISI.ID = t_sum_34.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6900003\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5473 group by \"NO_POLISI_ID\") as t_sum_35", 'T_M_D_NO_POLISI.ID = t_sum_35.NO_POLISI_ID', 'left');


    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6900002\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5472 group by \"NO_POLISI_ID\") as t_sum_32", 'T_M_D_NO_POLISI.ID = t_sum_32.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6900002\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5472 group by \"NO_POLISI_ID\") as t_sum_33", 'T_M_D_NO_POLISI.ID = t_sum_33.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6900001\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5471 group by \"NO_POLISI_ID\") as t_sum_30", 'T_M_D_NO_POLISI.ID = t_sum_30.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6900001\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5471 group by \"NO_POLISI_ID\") as t_sum_31", 'T_M_D_NO_POLISI.ID = t_sum_31.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6110105\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5255 group by \"NO_POLISI_ID\") as t_sum_28", 'T_M_D_NO_POLISI.ID = t_sum_28.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6110105\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5255 group by \"NO_POLISI_ID\") as t_sum_29", 'T_M_D_NO_POLISI.ID = t_sum_29.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6110106\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5256 group by \"NO_POLISI_ID\") as t_sum_26", 'T_M_D_NO_POLISI.ID = t_sum_26.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6110106\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5256 group by \"NO_POLISI_ID\") as t_sum_27", 'T_M_D_NO_POLISI.ID = t_sum_27.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6110107\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5257 group by \"NO_POLISI_ID\") as t_sum_24", 'T_M_D_NO_POLISI.ID = t_sum_24.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6110107\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5257 group by \"NO_POLISI_ID\") as t_sum_25", 'T_M_D_NO_POLISI.ID = t_sum_25.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6110104\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5254 group by \"NO_POLISI_ID\") as t_sum_22", 'T_M_D_NO_POLISI.ID = t_sum_22.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6110104\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5254 group by \"NO_POLISI_ID\") as t_sum_23", 'T_M_D_NO_POLISI.ID = t_sum_23.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6110108\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5258 group by \"NO_POLISI_ID\") as t_sum_20", 'T_M_D_NO_POLISI.ID = t_sum_20.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6110108\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5258 group by \"NO_POLISI_ID\") as t_sum_21", 'T_M_D_NO_POLISI.ID = t_sum_21.NO_POLISI_ID', 'left');


     $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6510106\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5410 group by \"NO_POLISI_ID\") as t_sum_18", 'T_M_D_NO_POLISI.ID = t_sum_18.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6510106\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5410 group by \"NO_POLISI_ID\") as t_sum_19", 'T_M_D_NO_POLISI.ID = t_sum_19.NO_POLISI_ID', 'left');


    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6310104\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5326 group by \"NO_POLISI_ID\") as t_sum_16", 'T_M_D_NO_POLISI.ID = t_sum_16.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6310104\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5326 group by \"NO_POLISI_ID\") as t_sum_17", 'T_M_D_NO_POLISI.ID = t_sum_17.NO_POLISI_ID', 'left');


    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6110103\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5253 group by \"NO_POLISI_ID\") as t_sum_14", 'T_M_D_NO_POLISI.ID = t_sum_14.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6110103\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5253 group by \"NO_POLISI_ID\") as t_sum_15", 'T_M_D_NO_POLISI.ID = t_sum_15.NO_POLISI_ID', 'left');



    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6210104\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5281 group by \"NO_POLISI_ID\") as t_sum_12", 'T_M_D_NO_POLISI.ID = t_sum_12.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6210104\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5281 group by \"NO_POLISI_ID\") as t_sum_13", 'T_M_D_NO_POLISI.ID = t_sum_13.NO_POLISI_ID', 'left');


    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_1310002\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=4544 group by \"NO_POLISI_ID\") as t_sum_10", 'T_M_D_NO_POLISI.ID = t_sum_10.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_1310002\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=4544 group by \"NO_POLISI_ID\") as t_sum_11", 'T_M_D_NO_POLISI.ID = t_sum_11.NO_POLISI_ID', 'left');



    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6110102\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5252 group by \"NO_POLISI_ID\") as t_sum_8", 'T_M_D_NO_POLISI.ID = t_sum_8.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6110102\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5252 group by \"NO_POLISI_ID\") as t_sum_9", 'T_M_D_NO_POLISI.ID = t_sum_9.NO_POLISI_ID', 'left');


    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6110109\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5560 group by \"NO_POLISI_ID\") as t_sum_6", 'T_M_D_NO_POLISI.ID = t_sum_6.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6110109\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5560 group by \"NO_POLISI_ID\") as t_sum_7", 'T_M_D_NO_POLISI.ID = t_sum_7.NO_POLISI_ID', 'left');



    $this->db->join("(select \"NO_POLISI_ID\",sum(\"SUB_TOTAL\")\"SUM_SUB_TOTAL\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\" where \"DATE_BONGKAR\">='{$from_date}' and \"DATE_BONGKAR\"<='{$to_date}' and \"MARK_FOR_DELETE\"=false group by \"NO_POLISI_ID\") as t_sum_1", 'T_M_D_NO_POLISI.ID = t_sum_1.NO_POLISI_ID', 'left');


    $this->db->join("(select \"NO_POLISI_ID\",sum(\"JARAK_KM\")\"SUM_JARAK_KM\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\" where \"DATE_BONGKAR\">='{$from_date}' and \"DATE_BONGKAR\"<='{$to_date}' and \"MARK_FOR_DELETE\"=false group by \"NO_POLISI_ID\") as t_sum_2", 'T_M_D_NO_POLISI.ID = t_sum_2.NO_POLISI_ID', 'left');

    
    $this->db->join("(select \"NO_POLISI_ID\",count(\"ID\")\"SUM_TRIP\" from \"T_T_T_PENJUALAN_JASA_RINCIAN\" where \"DATE_BONGKAR\">='{$from_date}' and \"DATE_BONGKAR\"<='{$to_date}' and \"MARK_FOR_DELETE\"=false group by \"NO_POLISI_ID\") as t_sum_3", 'T_M_D_NO_POLISI.ID = t_sum_3.NO_POLISI_ID', 'left');


    $this->db->join("(select \"NO_POLISI_ID\",sum(\"DEBIT\")\"SUM_DEBIT_6110101\" from \"T_AK_JURNAL\" where  \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5251 group by \"NO_POLISI_ID\") as t_sum_4", 'T_M_D_NO_POLISI.ID = t_sum_4.NO_POLISI_ID', 'left');

    $this->db->join("(select \"NO_POLISI_ID\",sum(\"KREDIT\")\"SUM_KREDIT_6110101\" from \"T_AK_JURNAL\" where \"DATE\">='{$from_date}' and \"DATE\"<='{$to_date}' and \"COA_ID\"=5251 group by \"NO_POLISI_ID\") as t_sum_5", 'T_M_D_NO_POLISI.ID = t_sum_5.NO_POLISI_ID', 'left');


    




    $this->db->where('T_M_D_NO_POLISI.MARK_FOR_DELETE',FALSE);
    


    
    $this->db->order_by("NO_POLISI", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  }







  public function select()
  {
    $this->db->select('T_M_D_NO_POLISI.ID');
    $this->db->select('T_M_D_NO_POLISI.NO_POLISI');
    $this->db->select('T_M_D_NO_POLISI.NO_UNIT');
    $this->db->select('T_M_D_NO_POLISI.CREATED_BY');
    $this->db->select('T_M_D_NO_POLISI.UPDATED_BY');
    $this->db->select('T_M_D_NO_POLISI.MARK_FOR_DELETE');
    $this->db->select('T_M_D_JENIS_KENDARAAN.JENIS_KENDARAAN');

    $this->db->from('T_M_D_NO_POLISI');


    $this->db->join('T_M_D_JENIS_KENDARAAN', 'T_M_D_JENIS_KENDARAAN.ID = T_M_D_NO_POLISI.JENIS_KENDARAAN_ID', 'left');

    if($this->session->userdata('t_m_d_no_polisi_delete_logic')==0)
    {
      $this->db->where('T_M_D_NO_POLISI.MARK_FOR_DELETE',FALSE);
    }
    $this->db->order_by("ID", "asc");
    $akun = $this->db->get ();
    return $akun->result ();
  }

  public function delete($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('T_M_D_NO_POLISI');
  }

  function tambah($data)
  {
    $this->db->insert('T_M_D_NO_POLISI', $data);
    return TRUE;
  }

}



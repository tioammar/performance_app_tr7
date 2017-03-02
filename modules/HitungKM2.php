<?php
class HitungKM {

  private $mysqli;

  function __construct() {
    $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
  }

  public function hitung($km, $level, $unit){ // passing level so we can check wether it has a sub level or not
    $ach_all = array();
    if($level < $km->len){
      $ach_all = $this->hitungSubLevel($km, $level, $unit);
    } else {
      for($i = 1; $i <= 4; $i++){
        $tw = "tw".$i;
        $bobot = $km->bobot[$tw];
        $real = $km->realisasi[$tw];
        $target = $km->target[$tw];
        if($target == 0){
          $ach_1 = 0;
        } else {
          if($km->type == TYPE_NORMAL){
            $ach_1 = $real/$target;
          } else {
            $ach_1 = $target/$real;
          }
        }
        $ach_2 = $ach_1 * $bobot;
        $ach = array('ach_show' => $ach_1, 'ach_sum' => $ach_2, 'bobot' => $bobot);
        $ach_all[$tw] = $ach;
      }
    }
    // $json = json_encode($ach_all);
    // echo $json;
    return $ach_all;
  }

  public function hitungSubLevel($km, $lvl, $unit){
    $ach_all = array();
    $level = $lvl + 1; // get the sub level
    $Q = "SELECT DISTINCT l_$level FROM km WHERE `l_$lvl` = '".$km->indikator['l_'.$lvl]."'";
    if ($unit != null) $Q .= " AND `unit` = '$unit'";
    $row = $this->mysqli->query($Q);
    // if ($level == 4){
    //   echo $row->num_rows;
    // }
    $ach_sub_all = array();
    $i = 1;
    while($r = $row->fetch_array()){
      $km_sub = new KM($r['l_'.$level], $level);
      $ach_sub_all['km_'.$i] = $this->hitung($km_sub, $level, $unit);
      $i++;
    }
    // if($km->level == 3){
    //   $json = json_encode($ach_sub_all);
    //   echo $json;
    // }
    // hitung rata2 isi dari $ach_sub_all
    for($t = 1; $t <= 4; $t++){
      $tw = "tw".$t;
      $total_bobot = 0;
      $total_ach_sub = 0;
      for($s = 1; $s <= count($ach_sub_all); $s++){
        $total_bobot = $ach_sub_all['km_'.$s][$tw]['bobot'] + $total_bobot;
        $total_ach_sub = $ach_sub_all['km_'.$s][$tw]['ach_sum'] + $total_ach_sub;
      }
      if($total_ach_sub == 0 && $total_bobot == 0){
        $ach_1 = 0;
      } else {
        $ach_1 = $total_ach_sub/$total_bobot;
      }
      $ach_2 = $ach_1 * $total_bobot;
      $ach = array('ach_show' => $ach_1, 'ach_sum' => $ach_2, 'bobot' => $total_bobot);
      $ach_all[$tw] = $ach;
    }
    // $json = json_encode($ach_all);
    // echo $json;
    return $ach_all;
  }
}
?>
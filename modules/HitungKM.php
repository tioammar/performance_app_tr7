<?php
require_once("Hitung.php");

class HitungKM extends Hitung {

  public function hitungSubLevel($model, $lvl, $unit){
    $ach_all = array();
    $level = $lvl + 1; // get the sub level
    $Q = "SELECT DISTINCT l_$level FROM km WHERE `l_$lvl` = '".$model->indikator['l_'.$lvl]."'";
    if ($unit != null) $Q .= " AND `unit` = '$unit'";
    $row = $this->mysqli->query($Q);
    $ach_sub_all = array();
    $i = 1;
    while($r = $row->fetch_array()){
      $model_sub = new KM($r['l_'.$level], $level, $this->count);
      $ach_sub_all['model_'.$i] = $this->hitung($model_sub, $level, $unit);
      $i++;
    }
    return $this->subAch($ach_sub_all);
  }
}
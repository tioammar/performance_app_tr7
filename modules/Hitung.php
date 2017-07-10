<?php
class Hitung {

  protected $mysqli;
  protected $count;

  function __construct($count) {
    $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $this->count = $count; 
  }

  public function hitung($model, $level, $unit){ // passing level so we can check wether it has a sub level or not
    $ach_all = array();
    if($level < $model->len){
      $ach_all = $this->hitungSubLevel($model, $level, $unit);
    } else {
      for($i = 1; $i <= $this->count; $i++){
        $bobot = $model->bobot[$i];
        $real = $model->realisasi[$i];
        $target = $model->target[$i];
        if($target == 0){
          $ach_1 = 0;
        } else {
          if($model->status[$i] == STATUS_RELEASED){
            if($model->type == TYPE_NORMAL){
              $ach_1 = $real/$target;
            } else {
              $ach_1 = $target/$real;
            }
          } else {
            $ach_1 = 0;
          }
        }
        $ach_2 = $ach_1 * $bobot;
        $ach = array('ach_show' => $ach_1, 'ach_sum' => $ach_2, 'bobot' => $bobot);
        $ach_all[$i] = $ach;
      }
    }
    return $ach_all;
  }

  public function subAch($ach_sub_all){
    $ach_all = array();
    for($t = 1; $t <= $this->count; $t++){
      $total_bobot = 0;
      $total_ach_sub = 0;
      for($s = 1; $s <= count($ach_sub_all); $s++){
        $total_bobot = $ach_sub_all['model_'.$s][$t]['bobot'] + $total_bobot;
        $total_ach_sub = $ach_sub_all['model_'.$s][$t]['ach_sum'] + $total_ach_sub;
      }
      if($total_ach_sub == 0 && $total_bobot == 0){
        $ach_1 = 0;
      } else {
        $ach_1 = $total_ach_sub/$total_bobot;
      }
      $ach_2 = $ach_1 * $total_bobot;
      $ach = array('ach_show' => $ach_1, 'ach_sum' => $ach_2, 'bobot' => $total_bobot);
      $ach_all[$t] = $ach;
    }
    return $ach_all;
  }

  public function hitungSubLevel($model, $lvl, $unit){
    $ach_all = array();
    $level = $lvl + 1; // get the sub level
    $Q = "SELECT DISTINCT l_$level FROM $model->table WHERE `l_$lvl` = '".$model->indikator['l_'.$lvl]."'";
    if ($unit != null) $Q .= " AND `unit` = '$unit'";
    $row = $this->mysqli->query($Q);
    $ach_sub_all = array();
    $i = 1;
    while($r = $row->fetch_array()){
      $model_sub = $model->make($r['l_'.$level], $level);
      $ach_sub_all['model_'.$i] = $this->hitung($model_sub, $level, $unit);
      $i++;
    }
    return $this->subAch($ach_sub_all);
  }
}
?>
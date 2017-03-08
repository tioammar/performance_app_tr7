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
      for($i = 1; $i <= 4; $i++){
        $tw = "tw".$i;
        $bobot = $model->bobot[$tw];
        $real = $model->realisasi[$tw];
        $target = $model->target[$tw];
        if($target == 0){
          $ach_1 = 0;
        } else {
          if($model->type == TYPE_NORMAL){
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
    return $ach_all;
  }

  public function subAch($ach_sub_all){
    $ach_all = array();
    for($t = 1; $t <= $this->count; $t++){
      $tw = "tw".$t;
      $total_bobot = 0;
      $total_ach_sub = 0;
      for($s = 1; $s <= count($ach_sub_all); $s++){
        $total_bobot = $ach_sub_all['model_'.$s][$tw]['bobot'] + $total_bobot;
        $total_ach_sub = $ach_sub_all['model_'.$s][$tw]['ach_sum'] + $total_ach_sub;
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
    return $ach_all;
  }
}
?>
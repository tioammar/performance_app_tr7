<?php
class Base {

  public $id;
  public $indikator = array();
  public $satuan;
  public $tahun;
  public $bobot = array();
  public $realisasi = array();
  public $target = array();
  public $ach = array();
  public $status = array();
  public $evid = array();
  public $level;
  public $type;
  public $len;
  public $table;
  public $count;

  
  function __construct($indikator, $level){
    $this->make($indikator, $level);
  }

  function make($indikator, $level){
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $Q = "SELECT * FROM $this->table WHERE `l_$level` = '$indikator'";
    $row = $mysqli->query($Q);
    if($r = $row->fetch_array()){
      $this->id = $r['id'];
      $i = 1;
      while($i <= $this->count){
        $this->indikator['l_'.$i] = $r['l_'.$i];
        $this->bobot['tw'.$i] = $r['bobot_tw'.$i];
        $this->target['tw'.$i] = $r['tar_tw'.$i];
        $this->realisasi['tw'.$i] = $r['real_tw'.$i];
        $this->status['tw'.$i] = $r['stt_tw'.$i];
        $this->evid['tw'.$i] = $r['evid_tw'.$i];
        $i++;
      }
      $this->level = $level;
      $this->type = $r['type'];
      $this->len = $r['len'];
    }
    return $this;
  }
}
?>
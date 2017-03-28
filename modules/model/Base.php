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
  protected $count;

  public function make($indikator, $level){
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $Q = "SELECT * FROM $this->table WHERE `l_$level` = '$indikator'";
    $row = $mysqli->query($Q);
    $this->fill($row, $level);
    return $this;
  }

  public function makeById($id){
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $Q = "SELECT * FROM $this->table WHERE `id` = '$id'";
    $row = $mysqli->query($Q);
    $this->fill($row, 0);
    return $this;
  }

  private function fill($row, $level){
    if($r = $row->fetch_array()){
      $this->id = $r['id'];
      $i = 1;
      $this->tahun = $r['tahun'];
      $this->satuan = $r['satuan'];
      while($i <= $this->count){
        $this->indikator['l_'.$i] = $r['l_'.$i];
        $this->bobot[$i] = $r['bobot_'.$i];
        $this->target[$i] = $r['tar_'.$i];
        $this->realisasi[$i] = $r['real_'.$i];
        $this->status[$i] = $r['stt_'.$i];
        // $this->evid[$i] = $r['evid_'.$i];
        $i++;
      }
      $this->level = $level;
      $this->type = $r['type'];
      $this->len = $this->len();
    }
  }

  function len(){
    $i = 1;
    $l = 0;
    while($i <= 4){
      if($this->indikator['l_'.$i] != ""){
        $l++;
      }
      $i++;
    }
    return $l;
  }
}
?>
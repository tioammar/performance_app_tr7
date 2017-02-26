<?php
class KM {

  public $id;
  public $indikator = array();
  // public $level1;
  // public $level2;
  // public $level3;
  // public $level4;
  public $satuan;
  public $tahun;
  public $bobot;
  public $realisasi;
  public $target;
  public $ach = array();
  public $status;
  // public $level;
  // public $sub;
  public $type;
  public $len;
  
  function __construct($indikator, $level){
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $Q = "SELECT * FROM km WHERE `l_$level` = '$indikator'";
    $row = $mysqli->query($Q);
    if($r = $row->fetch_array()){
      $this->id = $r['id'];
      $this->indikator = array('l_1' => $r['l_1'],
                'l_2' => $r['l_2'],
                'l_3' => $r['l_3'],
                'l_4' => $r['l_4']);
      $this->satuan = $r['satuan'];
      $this->tahun = $r['tahun'];
      $this->bobot = array('tw1' => $r['bobot_tw1'], 
                'tw2' => $r['bobot_tw2'],
                'tw3' => $r['bobot_tw3'], 
                'tw4' => $r['bobot_tw4']);
      $this->target = array('tw1' => $r['tar_tw1'], 
                'tw2' => $r['tar_tw2'],
                'tw3' => $r['tar_tw3'], 
                'tw4' => $r['tar_tw4']);
      $this->realisasi = array('tw1' => $r['real_tw1'], 
                'tw2' => $r['real_tw2'],
                'tw3' => $r['real_tw3'], 
                'tw4' => $r['real_tw4']);
      $this->status = array('tw1' => $r['stt_tw1'], 
                'tw2' => $r['stt_tw2'],
                'tw3' => $r['stt_tw3'], 
                'tw4' => $r['stt_tw4']);
      $this->level = $level;
      // $this->sub = $r['sub'];
      $this->type = $r['type'];
      $this->len = $r['len'];
    }
  }

  public static function updateReal($id, $tw, $value){
    return self::update($id, $tw, $value, "real");
  }

  public static function updateStatus($id, $tw, $value){
    return self::update($id, $tw, $value, "stt");
  }

  public static function update($id, $tw, $value, $type){
    $Q = "UPDATE km SET `".$type."_".$tw."` = '$value' WHERE `id` = $id";
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if(!$mysqli->query($Q)){
      return QUERY_SUCCESS;
    } else {
      return QUERY_FAILED;
    }
  }

  public static function uploadEvidence($file, $id){
    //TODO 
  }
}
?>
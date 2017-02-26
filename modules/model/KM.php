<?php
class KM {

  public $id;
  public $indikator;
  public $satuan;
  public $tahun;
  public $bobot;
  public $realisasi;
  public $target;
  public $ach = array();
  public $status;
  public $level;
  public $sub;
  public $type;
  
  function __construct($id, $level){
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $Q = "SELECT * FROM km_level$level WHERE `id` = $id";
    $row = $mysqli->query($Q);
    if($r = $row->fetch_array()){
      $this->id = $id;
      $this->indikator = $r['indikator'];
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
      $this->level = $r['level'];
      $this->sub = $r['sub'];
      $this->type = $r['type'];
    }
  }

  public static function updateReal($id, $kolom, $level, $value){
    return self::update($id, $kolom, $level, $value, "real");
  }

  public static function updateStatus($id, $kolom, $level, $value){
    return self::update($id, $kolom, $level, $value, "stt");
  }

  public static function update($id, $kolom, $level, $value, $type){
    $Q = "UPDATE km_level$level SET `".$type."_".$kolom."` = '$value' WHERE `id` = $id";
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
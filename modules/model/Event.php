<?php
require_once(__DIR__."/../config.php");

class Event {

  public $message;
  public $subj; // editor
  public $dest;
  public $unit;
  public $level; // current user level
  protected $mysqli;
  protected $table;
  public $type; // KM / Quad / Flag

  function __construct($unit, $type){
    $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $this->unit = $unit;
    $this->type = $type;
  }

  public function get($id){
    $Q = "SELECT * FROM $this->table WHERE `id` = '$id'"; 
    $row = $this->mysqli->query($Q);
    if($r = $row->fetch_array()){
      $this->event = $r['event'];
      $this->unit = $r['unit'];
      $this->subject = $r['subj'];
      $this->type = $r['type'];
      if($this->table == "notification"){
        $this->message = $r['message'];
      }
    }
    return $this;
  }

  public function getAll($level){
    $ids = array();
    $Q = "SELECT id FROM $this->table WHERE `unit` = '$this->unit' AND `dest` = '$level' AND `type` = '$this->type'"; 
    $row = $this->mysqli->query($Q);
    while($r = $row->fetch_array()){
      $ids[] = $r['id'];
    }
    return $ids;
  }  
  
  public function getAllNotif($level){
    $ids = array();
    $Q = "SELECT id FROM $this->table WHERE `unit` = '$this->unit' AND `dest` = '$level'"; 
    $row = $this->mysqli->query($Q);
    while($r = $row->fetch_array()){
      $ids[] = $r['id'];
    }
    return $ids;
  }

  public function getAllDest($level){
    $ids = array();
    $Q = "SELECT id FROM $this->table WHERE `dest` = '$level' AND `unit2` = '$this->unit'"; 
    $row = $this->mysqli->query($Q);
    while($r = $row->fetch_array()){
      $ids[] = $r['id'];
    }
    return $ids;
  }
}
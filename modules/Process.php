<?php
require_once("config.php");
require_once("model/Notification.php");

class Process {

  public $id;
  public $t;
  public $table;

  function __construct($id, $t, $table, $unit){
     $this->id = $id;
     $this->t = $t;
     $this->table = $table;
     $this->unit = $unit;
  }

  function updateReal($value){
    if($this->update($this->id, $this->t, $value, "real") == QUERY_SUCCESS){
      return $this->updateStatus(STATUS_EDITED, "");
    } else return QUERY_FAILED;
  }

  function updateRealWitel($value, $witel){
    if($this->update($this->id, $this->t, $value, "real") == QUERY_SUCCESS){
      return $this->updateStatusWitel(STATUS_EDITED, "", $witel);
    } else return QUERY_FAILED;
  }

  function addSupportWitel($value, $dest, $type, $item_type){
    $Q = "INSERT INTO $this->table (item, periode, dest, item_id, type, unit, item_type, stt) VALUES ('$value', '$this->t', '$dest', '$this->id', '$type', '$this->unit', '$item_type', 'added')";
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if($mysqli->query($Q)){
      $notif = new Notification($dest, $this->table); // dest fills unit column
      $notif->setMessageSupportWitel("added", $mysqli->insert_id, $this->t, $this->unit); // unit as witel column
      return $notif->send($message);
    } else {
      return QUERY_FAILED;
    }
  }  
  
  function addSupport($value, $dest, $type, $item_type){
    $Q = "INSERT INTO $this->table (item, periode, dest, item_id, type, unit, item_type, stt) VALUES ('$value', '$this->t', '$dest', '$this->id', '$type', '$this->unit', '$item_type', 'added')";
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if($mysqli->query($Q)){
      $notif = new Notification($this->unit, $this->table);
      $notif->setMessageSupport("added", $mysqli->insert_id, $this->t, $dest);
      return $notif->send("");
    } else {
      return QUERY_FAILED;
    }
  }

  public function updateStatusSupport($value, $message, $dest){
    $Q = "UPDATE $this->table SET `stt` = '$value' WHERE `id` = $this->id";
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if($mysqli->query($Q)){
      $notif = new Notification($this->unit, $this->table);
      $notif->setMessageSupport($value, $this->id, $this->t, $dest);
      return $notif->send($message);
    } else {
        return QUERY_FAILED;
    }
  }

  public function updateStatusSupportWitel($value, $message, $witel){
    $Q = "UPDATE $this->table SET `stt` = '$value' WHERE `id` = $this->id";
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if($mysqli->query($Q)){
      $notif = new Notification($this->unit, $this->table);
      $notif->setMessageSupportWitel($value, $this->id, $this->t, $witel);
      return $notif->send($message);
    } else {
        return QUERY_FAILED;
    }
  }

  function addAction($value, $item_type){
    $Q = "INSERT INTO $this->table (item, periode, item_id, item_type) VALUES ('$value', '$this->t', '$this->id', '$item_type')";
    echo "$Q";
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if($mysqli->query($Q)){
      return QUERY_SUCCESS;
    } else {
      return QUERY_FAILED;
    }
  }

  function addLesson($value, $item_type){
    $Q = "INSERT INTO $this->table (item, periode, item_id, item_type) VALUES ('$value', '$this->t', '$this->id', '$item_type')";
    echo "$Q";
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if($mysqli->query($Q)){
      return QUERY_SUCCESS;
    } else {
      return QUERY_FAILED;
    }
  }

  public function updateStatus($value, $message){
    if($this->update($this->id, $this->t, $value, "stt") == QUERY_SUCCESS){
      $notif = new Notification($this->unit, $this->table);
      $notif->setMessage($value, $this->id, $this->t);
      return $notif->send($message);
    } else {
      return QUERY_FAILED;
    }
  }

  public function updateStatusWitel($value, $message, $witel){
    if($this->update($this->id, $this->t, $value, "stt") == QUERY_SUCCESS){
      $notif = new Notification($this->unit, $this->table);
      $notif->setMessageWitel($value, $this->id, $this->t, $witel);
      return $notif->send($message);
    } else {
      return QUERY_FAILED;
    }
  }

  public function deleteSupport(){
    $Q = "DELETE FROM $this->table WHERE `id` = $this->id";
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if($mysqli->query($Q)){
      return QUERY_SUCCESS;
    } else {
      return QUERY_FAILED;
    }
  }  
  
  public function deleteLesson(){
    $Q = "DELETE FROM $this->table WHERE `id` = $this->id";
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if($mysqli->query($Q)){
      return QUERY_SUCCESS;
    } else {
      return QUERY_FAILED;
    }
  }

  public function deleteAction(){
    $Q = "DELETE FROM $this->table WHERE `id` = $this->id";
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if($mysqli->query($Q)){
      return QUERY_SUCCESS;
    } else {
      return QUERY_FAILED;
    }
  }

  // public function updateStatusWitel($value, $message){
  //   if($this->update($this->id, $this->t, $value, "stt") == QUERY_SUCCESS){
  //     if($value != STATUS_RELEASED){
  //       $notif = new Notification($this->unit, $this->table);
  //       $notif->setMessage($value, $this->id, $this->t, $message);
  //       return $notif->send($message);
  //     } else {
  //       return QUERY_SUCCESS;
  //     }
  //   } return QUERY_FAILED;
  // }

  // public function updateEvidence($value){
  //   if($this->update($this->id, $this->t, $value, "evid")){
  //     return UPLOAD_OK;
  //   } else {
  //     return UPLOAD_NOK;
  //   }
  // }

  public function update($id, $t, $value, $type){
    $Q = "UPDATE $this->table SET `".$type."_".$t."` = '$value' WHERE `id` = $id";
    echo $Q;
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if(!$mysqli->query($Q)){
      return QUERY_FAILED;
    } else {
      return QUERY_SUCCESS;
    }
  }
}
?>
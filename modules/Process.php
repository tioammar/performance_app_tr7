<?php
require_once("config.php");

class Process {

  private $id;
  private $tw;
  private $table;

  function __construct($id, $tw, $table){
     $this->id = $id;
     $this->tw = $tw;
     $this->table = $table;
  }

  function updateReal($value){
    if($this->update($this->id, $this->tw, $value, "real") == QUERY_SUCCESS){
      $this->updateStatus(STATUS_EDITED);
    }
  }

  public function updateStatus($value){
    if($this->update($this->id, $this->tw, $value, "stt") == QUERY_SUCCESS){
      switch($value){
        case STATUS_APPROVED:
          $dest = ADMIN_BPP;
          break;
        case STATUS_REJECTED:
          $dest = ADMIN_UNIT;
          break;
        case STATUS_EDITED:
          $dest = ADMIN_SM;
          break;
      }
      if($value != STATUS_RELEASED){
        $this->setNotification($dest, "Status");
      }
    }
  }

  public function updateEvidence($value){
    if($this->update($this->id, $this->tw, $value, "evid")){
      return UPLOAD_OK;
    } else {
      return UPLOAD_NOK;
    }
  }

  public function update($id, $tw, $value, $type){
    $Q = "UPDATE $this->table SET `".$type."_".$tw."` = '$value' WHERE `id` = $id";
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if(!$mysqli->query($Q)){
      return QUERY_FAILED;
    } else {
      return QUERY_SUCCESS;
    }
  }

  private function setNotification($dest, $type){
    
  }
}
?>
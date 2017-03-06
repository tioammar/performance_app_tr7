<?php
class Process {

  private $id;
  private $tw;

  function __construct($id, $tw){
     $this->id = $id;
     $this->tw = $tw;
  }

  function updateReal($value){
    return $this->update($this->id, $this->tw, $value, "real");
  }

  public function updateStatus($value){
    return $this->update($this->id, $this->tw, $value, "stt");
  }

  public function update($id, $tw, $value, $type){
    $Q = "UPDATE km SET `".$type."_".$tw."` = '$value' WHERE `id` = $id";
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if(!$mysqli->query($Q)){
      return QUERY_SUCCESS;
    } else {
      return QUERY_FAILED;
    }
  }
}
?>
<?php
require_once("Event.php");
require_once(__DIR__."/../config.php");

class Log extends Event {

  protected $table = "log";

  public function send($notif){
    $time = date("Y-m-d H:i:s");
    $Q = "INSERT INTO $this->table (log, subj, server_time, type) VALUE ('$notif->message', '$notif->subj', '$time', '$this->type')";
    if($this->mysqli->query($Q)){
      return QUERY_SUCCESS;
    } else return QUERY_FAILED;
  }
}
?>
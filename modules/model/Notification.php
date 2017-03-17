<?php
require_once(__DIR__."/../config.php");
require_once("Event.php");
require_once("KM.php");

class Notifiation extends Event {

  protected $table = "notification";
  
  public function setMessage($value, $id, $tw){
    $this->message = $this->build($value, $id, $tw);
    switch($value){
      case STATUS_APPROVED:
        $this->subj = ADMIN_SM;
        $this->dest = ADMIN_ALL;
        break;
      case STATUS_REJECTED:
        $this->subj = ADMIN_SM;
        $this->dest = ADMIN_UNIT;
        break;
      case STATUS_EDITED:
        $this->subj = ADMIN_UNIT;
        $this->dest = ADMIN_SM;
        break;
      case STATUS_NOT_RELEASED:
        $this->subj = ADMIN_ALL;
        $dthis->est = ADMIN_UNIT;
        break;
    }
  }

  public function send(){
    $Q = "INSERT INTO $this->table (notiication, subj, dest) VALUE ('$this->message', '$this->subj', '$this->dest')";
  }

  private function build($value, $id, $tw){
    $message = "";
    $km = KM::loadById($id);
    $indikator = $km->indikator['l_'.$km->len];
    switch($value){
      case STATUS_APPROVED:
        $message = "Realisasi $indikator TW $tw Telah Disetujui";
        break;
      case STATUS_REJECTED:
        $message = "Realisasi $indikator TW $tw Telah Ditolak";
        break;
      case STATUS_EDITED:
        $message = "Realisasi $indikator TW $tw Telah Diubah";
        break;
      case STATUS_NOT_RELEASED:
        $message = "Realisasi $indikator TW $tw Tidak Ditolak";
        break;
    }
    return $message;
  }
}

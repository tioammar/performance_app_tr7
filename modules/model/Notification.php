<?php
require_once(__DIR__."/../config.php");
require_once("Event.php");
require_once("KM.php");
require_once("KMWitel.php");
require_once("QuickWin.php");
require_once("LogInterface.php");
require_once("Support.php");

class Notification extends Event {

  protected $table = "notification";
  protected $unit2;
  
  public function setMessage($value, $id, $tw, $unit2){
    if($this->unit == $unit2){
      $this->unit2 = "";
    } else $this->unit2 = $unit2;
    $this->event = $this->build($value, $id, $tw);
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
        $this->dest = ADMIN_UNIT;
        break;
      case STATUS_RELEASED:
        $this->subj = ADMIN_ALL;
        $this->dest = "";
        break;
    }
  }

  public function setMessageWitel($value, $id, $tw, $witel){
    $this->unit2 = $witel;
    $this->event = $this->buildWitel($value, $id, $tw);
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
        $this->dest = ADMIN_UNIT;
        break;
      case STATUS_RELEASED:
        $this->subj = ADMIN_ALL;
        $this->dest = ADMIN_WITEL;
        break;
      case STATUS_APPROVED_WITEL:
        $this->subj = ADMIN_WITEL;
        $this->dest = "";
        break;
      case STATUS_REJECTED_WITEL:
        $this->subj = ADMIN_WITEL;
        $this->dest = ADMIN_UNIT;
        break;
    }
  }

  public function setMessageSupport($value, $id, $tw, $unit2){
    $this->unit2 = $unit2;
    $this->event = $this->buildSupport($value, $id, $tw);
    switch($value){
      case STATUS_ADDED:
        $this->subj = ADMIN_UNIT;
        $this->dest = ADMIN_SM;
        break;
      case STATUS_REJECTED:
        $this->subj = ADMIN_SM;
        $this->dest = ADMIN_UNIT;
        break;
      case STATUS_APPROVED:
        $this->subj = ADMIN_SM;
        $this->dest = ADMIN_ALL;
        break;
    }
  }  
  
  public function setMessageSupportWitel($value, $id, $tw, $witel){
    $this->unit2 = $witel;
    $this->event = $this->buildSupport($value, $id, $tw);
    switch($value){
      case STATUS_ADDED:
        $this->subj = ADMIN_WITEL;
        $this->dest = ADMIN_SM;
        break;
      case STATUS_REJECTED:
        $this->subj = ADMIN_SM;
        $this->dest = ADMIN_WITEL;
        break;
      case STATUS_APPROVED:
        $this->subj = ADMIN_WITEL;
        $this->dest = ADMIN_ALL;
        break;
    }
  }

  public function send($message){
    $log = new LogInterface($this->unit, $this->type);
    if($log->send($this) == QUERY_SUCCESS){
      $Q = "INSERT INTO $this->table (event, subj, dest, type, unit, message, unit2) VALUE ('$this->event', '$this->subj', '$this->dest', '$this->type', '$this->unit', '$message', '$this->unit2')";
      if($this->mysqli->query($Q)){
        return QUERY_SUCCESS;
      } else return QUERY_FAILED;
    }
  }

  public function delete($id){
    $log = new LogInterface($this->unit, $this->type);
    if($log->send($this) == QUERY_SUCCESS){
      $Q = "DELETE FROM $this->table WHERE `id` = $id";
      if($this->mysqli->query($Q)){
        return QUERY_SUCCESS;
      } else return QUERY_FAILED;
    }
  }

  // public function sendSupport($message){
  //   $log = new LogInterface($this->unit, $this->type);
  //   if($log->send($this) == QUERY_SUCCESS){
  //     $Q = "INSERT INTO $this->table (event, subj, dest, type, unit, message, witel) VALUE ('$this->event', '$this->subj', '$this->dest', '$this->type', '$this->unit', '$message', '$this->witel')";
  //     // echo $Q;
  //     if($this->mysqli->query($Q)){
  //       return QUERY_SUCCESS;
  //     } else return QUERY_FAILED;
  //   }
  // }

  private function build($value, $id, $tw){
    $message = "";
    if($this->type == "km"){
      $km = KM::loadById($id);
      $indikator = $km->indikator['l_'.$km->len];
      $unit = $km->unit;
    } else if($this->type == "quickwin"){
      $qw = QuickWin::loadById($id);
      $indikator = $qw->indikator['l_'.$qw->len];
      $unit = $km->unit;
    }
    switch($value){
      case STATUS_APPROVED:
        $message = "Realisasi $indikator unit $unit periode $tw telah disetujui";
        break;
      case STATUS_REJECTED:
        $message = "Realisasi $indikator unit $unit periode $tw telah ditolak";
        break;
      case STATUS_EDITED:
        $message = "Realisasi $indikator unit $unit periode $tw telah diubah";
        break;
      case STATUS_NOT_RELEASED:
        $message = "Realisasi $indikator unit $unit periode $tw Tidak ditolak";
        break;
      case STATUS_RELEASED:
        $message = "Realisasi $indikator unit $unit periode $tw telah dirilis";
        break;
    }
    return $message;
  }

  private function buildWitel($value, $id, $tw){
    $message = "";
      $qw = KMWitel::loadById($id);
      $indikator = $qw->indikator['l_'.$qw->len];
      $witel = $qw->witel;
    switch($value){
      case STATUS_APPROVED:
        $message = "Realisasi $indikator witel $witel periode $tw telah disetujui";
        break;
      case STATUS_REJECTED:
        $message = "Realisasi $indikator witel $witel periode $tw telah ditolak";
        break;
      case STATUS_EDITED:
        $message = "Realisasi $indikator witel $witel periode $tw telah diubah";
        break;
      case STATUS_NOT_RELEASED:
        $message = "Realisasi $indikator witel $witel periode $tw Tidak ditolak";
        break;      
      case STATUS_RELEASED:
        $message = "Realisasi $indikator witel $witel periode $tw Tidak dirilis";
        break;
      case STATUS_REJECTED_WITEL:
        $message = "Realisasi $indikator witel $witel periode $tw telah ditolak";
        break;
      case STATUS_APPROVED_WITEL:
        $message = "Realisasi $indikator witel $witel periode $tw telah disetujui";
        break;
    }
    return $message;
  }

  private function buildSupport($value, $id, $tw){
    $message = "";
    $sn = Support::loadById($id);
    $indikator = $sn->item;
    switch($sn->item_type){
      case "quickwin":
        $i = QuickWin::loadById($sn->item_id);
        $m = $i->indikator['l_'.$i->len];
        $unit = "unit ".$i->unit;
        break;
      case "km":
        $i = KM::loadById($sn->item_id);
        $m = $i->indikator['l_'.$i->len];
        $unit = "unit ".$i->unit;
        break;
      case "km_witel":
        $i = KMWitel::loadById($sn->item_id);
        $m = $i->indikator['l_'.$i->len];
        $unit = "witel ".$i->unit;
        break;
    }
    switch($value){
      case STATUS_APPROVED:
        $message = "Support Needed: $indikator untuk indikator $m $unit bulan $sn->periode telah disetujui";
        break;
      case STATUS_REJECTED:
        $message = "Support Needed: $indikator untuk indikator $m $unit bulan $sn->periode telah ditolak";
        break;
      case STATUS_ADDED:
        $message = "Support Needed: $indikator untuk indikator $m $unit bulan $sn->periode telah ditambahkan";
        break;
    }
    return $message;
  }
}

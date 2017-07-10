<?php
require_once(__DIR__."/../config.php");
require_once("Event.php");
require_once("KM.php");
require_once("KMWitel.php");
require_once("LogInterface.php");
require_once("Support.php");

class Notification extends Event {

  protected $table = "notification";
  protected $witel;
  
  public function setMessage($value, $id, $tw){
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
        $dthis->dest = ADMIN_UNIT;
        break;
      case STATUS_RELEASED:
        $this->subj = ADMIN_ALL;
        $this->dest = ADMIN_UNIT;
        break;
    }
  }

  public function setMessageWitel($value, $id, $tw, $witel){
    $this->witel = $witel;
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
        $dthis->dest = ADMIN_UNIT;
        break;
      case STATUS_RELEASED:
        $this->subj = ADMIN_ALL;
        $this->dest = ADMIN_WITEL;
        break;
      case STATUS_APPROVED_WITEL:
        $this->subj = ADMIN_WITEL;
        $this->dest = ADMIN_UNIT;
        break;
      case STATUS_REJECTED_WITEL:
        $this->subj = ADMIN_WITEL;
        $this->dest = ADMIN_ALL;
        break;
    }
  }

  public function setMessageSupport($value, $id, $tw, $witel){
    $this->witel = $witel;
    $this->event = $this->buildSupport($value, $id, $tw);
    
    switch($value){
      case STATUS_ADDED:
        $this->subj = ADMIN_UNIT;
        $this->dest = ADMIN_WITEL;
        break;
      case STATUS_REJECTED_WITEL:
        $this->subj = ADMIN_WITEL;
        $this->dest = ADMIN_UNIT;
        break;
      case STATUS_APPROVED_WITEL:
        $this->subj = ADMIN_WITEL;
        $this->dest = ADMIN_ALL;
        break;
    }
  }

  public function send($message){
    $log = new LogInterface($this->unit, $this->type);
    if($log->send($this) == QUERY_SUCCESS){
      $Q = "INSERT INTO $this->table (event, subj, dest, type, unit, message, witel) VALUE ('$this->event', '$this->subj', '$this->dest', '$this->type', '$this->unit', '$message', '$this->witel')";
      if($this->mysqli->query($Q)){
        return QUERY_SUCCESS;
      } else return QUERY_FAILED;
    }
  }

  public function sendSupport($message){
    $log = new LogInterface($this->unit, $this->type);
    if($log->send($this) == QUERY_SUCCESS){
      $Q = "INSERT INTO $this->table (event, subj, dest, type, unit, message, witel) VALUE ('$this->event', '$this->subj', '$this->dest', '$this->type', '$this->unit', '$message', '$this->witel')";
      // echo $Q;
      if($this->mysqli->query($Q)){
        return QUERY_SUCCESS;
      } else return QUERY_FAILED;
    }
  }

  private function build($value, $id, $tw){
    $message = "";
    if($this->type == "km"){
      $km = KM::loadById($id);
      $indikator = $km->indikator['l_'.$km->len];
    } else if($this->type == "quickwin"){
      $qw = QuickWin::loadById($id);
      $indikator = $qw->indikator['l_'.$qw->len];
    }
    switch($value){
      case STATUS_APPROVED:
        $message = "Realisasi $indikator Periode $tw Telah Disetujui";
        break;
      case STATUS_REJECTED:
        $message = "Realisasi $indikator Periode $tw Telah Ditolak";
        break;
      case STATUS_EDITED:
        $message = "Realisasi $indikator Periode $tw Telah Diubah";
        break;
      case STATUS_NOT_RELEASED:
        $message = "Realisasi $indikator Periode $tw Tidak Ditolak";
        break;
      case STATUS_RELEASED:
        $message = "Realisasi $indikator Periode $tw Telah Direlease";
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
        $message = "Realisasi $indikator Witel $witel Periode $tw Telah Disetujui";
        break;
      case STATUS_REJECTED:
        $message = "Realisasi $indikator Witel $witel Periode $tw Telah Ditolak";
        break;
      case STATUS_EDITED:
        $message = "Realisasi $indikator Witel $witel Periode $tw Telah Diubah";
        break;
      case STATUS_NOT_RELEASED:
        $message = "Realisasi $indikator Witel $witel Periode $tw Tidak Ditolak";
        break;      
      case STATUS_RELEASED:
        $message = "Realisasi $indikator Witel $witel Periode $tw Tidak Direlease";
        break;
      case STATUS_REJECTETD_WITEL:
        $message = "Realisasi $indikator Witel $witel Periode $tw Telah Ditolak";
        break;
      case STATUS_APPROVED_WITEL:
        $message = "Realisasi $indikator Witel $witel Periode $tw Telah Disetujui";
        break;
    }
    return $message;
  }

  private function buildSupport($value, $id, $tw){
    $message = "";
    $sn = Support::loadById($id);
    $indikator = $sn->item;
    switch($value){
      case STATUS_APPROVED:
        $message = "Support Needed: $indikator Bulan $sn->periode Telah Disetujui";
        break;
      case STATUS_REJECTED:
        $message = "Support Needed: $indikator Bulan $sn->periode Telah Ditolak";
        break;
      case STATUS_ADDED:
        $message = "Support Needed: $indikator Bulan $sn->periode Telah Ditambahkan";
        break;
    }
    echo $message;
    return $message;
  }
}

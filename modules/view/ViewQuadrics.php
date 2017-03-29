<?php
require_once("View.php");
require_once("TableKM.php");

class ViewQuadrics extends View {

  public $statusType = "statusquad";
  public $updateType = "updatequad";
  public $uploadType = "uploadquad";
  public $useBobot = false;
  public $count = 12;

  public function setTable(){
    return new TableKM($this);
  }
}
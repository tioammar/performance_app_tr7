<?php
require_once("View.php");
require_once("TableKM.php");

class ViewKM extends View {

  public $statusType = "statuskm";
  public $updateType = "updatekm";
  public $uploadType = "uploadkm";
  public $useBobot = true;
  public $count = 4;

  public function setTable(){
    return new TableKM($this, "km");
  }
}
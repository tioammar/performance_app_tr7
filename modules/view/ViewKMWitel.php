<?php
require_once("View.php");
require_once("TableKMWitel.php");

class ViewKMWitel extends View {

  public $statusType = "statuswit";
  public $updateType = "updatewit";
  public $uploadType = "uploadwit";
  public $useBobot = false;
  public $count = 12;

  public function setTable(){
    return new TableKMWitel($this, "km_witel");
  }
}
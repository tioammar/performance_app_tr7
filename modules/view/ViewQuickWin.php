<?php
require_once("View.php");
require_once("TableQuickWin.php");

class ViewQuickWin extends View {

  public $statusType = "statusqw";
  public $updateType = "updateqw";
  public $uploadType = "uploadqw";
  public $useBobot = false;
  public $count = 12;

  public function setTable(){
    return new TableQuickWin($this, "quickwin");
  }
}
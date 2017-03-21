<?php
require_once("Base.php");

class QuickWin extends Base {

  function __construct(){
    $this->table = "quickwin";
    $this->count = 6;
  }

  public static function load($indikator, $level){
    $instance = new self();
    $instance->make($indikator, $level);
    return $instance;
  }

  public static function loadById($id){
    $instance = new self();
    $instance->makeById($id);
    return $instance;
  }
}
?>
<?php
require_once("Base.php");

class KMWitel extends Base {

  function __construct(){
    $this->table = "km_witel";
    $this->count = 12;
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
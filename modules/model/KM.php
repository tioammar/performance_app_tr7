<?php
require_once("Base.php");

class KM extends Base {

  function __construct(){
    $this->table = "km";
    $this->count = 4;
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
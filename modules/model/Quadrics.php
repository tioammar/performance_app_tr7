<?php
require_once("Base.php");

class Quadrics extends Base {

  function __construct(){
    $this->table = "quadrics";
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
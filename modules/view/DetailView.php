<?php
class DetailView {

  public $count;
  protected $type;
  public $unit;
  public $user;
  protected $itemId;

  function setUnit($unit){
    $this->unit = $unit;
  }

  function setUser($user){
    $this->user = $user;
  }

  function setFilter($name){
    $month = date('m', time());
    $quarter = ceil($month/3) - 1;
    if($this->count < 12){
      $t = $quarter == 0 ? 1 : $quarter;
    } else {
      $t = $month;
    }
    $i = 1;
    while($i <= $this->count){
      $cls = $i == $t ? "selected" : "";
      $disp = $this->count < 12 ? $name." ".$i : $this->month($i);
      echo "<option value='$i' $cls>$disp</option>";
      $i++;
    }
  }
}
?>
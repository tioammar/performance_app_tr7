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
    $month = date('m', time()) - 1;
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

  function month($month){
    switch($month){
      case 1;
        $div = "Januari";
        break;
      case 2:
        $div = "Februari";
        break;
      case 3:
        $div = "Maret";
        break;
      case 4:
        $div = "April";
        break;
      case 5:
        $div = "Mei";
        break;
      case 6:
        $div = "Juni";
        break;
      case 7:
        $div = "Juli";
        break;
      case 8:
        $div = "Agustus";
        break;
      case 9:
        $div = "September";
        break;
      case 10:
        $div = "Oktober";
        break;
      case 11:
        $div = "November";
        break;
      case 12:
        $div = "Desember";
        break;
      default:
        // do nothing
    }
    return $div;
  }
}
?>
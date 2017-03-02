<?php
class View {

  private $user;
  private $unit;
  private $mysqli;

  function __construct($user, $unit){
    $this->user = $user;
    $this->unit = $unit;
    $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
  }

  function setUser($user){
    $this->user = $user;
  }

  function setUnit($unit){
    $this->unit = $unit;
  }

  public function showEditor(){
    $editor = "";
    switch($this->user){
      case ADMIN_UNIT:
        $editor = "<a class='green-text small' href='#editor'><i class='material-icons'>edit</i></a>";
        break;
      case ADMIN_SM:
        $editor = "<a class='small green-text' href='?page=accept'><i class='material-icons'>done</i></a> <a class='red-text small text-darken-3' href='?page=reject'><i class='material-icons'>close</i></a>";
        break;
    }
    echo $editor;
  }

  public function row($km, $ach_all, $level){
    switch($level){
      case 1:
        $class = "red accent-4 white-text";
        break;
      case 2:
        $class = "red white-text";
        break;
      case 3:
        $class = "light-blue lighten-5";
        break;
      case 4:
        $class = "white";
        break;
      default:
        // do nothing
    }
    echo "
          <tr class='$class'>
            <td class='indent-$level'>".$km->indikator['l_'.$level]."</td>
            <td class='center-align'>$km->tahun</td>";
      if($level < $km->len){
        echo "
            <td class='center-align'>-</td>";
      } else {
        echo "
            <td class='center-align'>$km->satuan</td>";
      }
      for($t = 1; $t <= 4; $t++){
        if($ach_all['tw'.$t]['bobot'] < 1){
          echo "
            <td class='hides center-align $t'> - </td>"; // clean UI
        }
        else {
          echo "
            <td class='hides center-align $t'>".$ach_all['tw'.$t]['bobot']."</td>";
        }
        if($level < $km->len){
          echo "
            <td class='hides center-align $t'>-</td>
            <td class='hides center-align $t'>-</td>";
        } else {
          echo "
            <td class='hides center-align $t'>".$km->target['tw'.$t]."</td>
            <td class='hides center-align $t'>".$km->realisasi['tw'.$t]." <span>";
          echo ($this->user != USER) ? $this->showEditor($this->user) : "";
          echo "  
            </span></td>";
        }
        echo "
            <td class='hides center-align $t'>".rounds($ach_all['tw'.$t]['ach_show']*100)." %</td>";
      }
      echo "       
          </tr>";
  }

  public function sub($parent, $plevel){
    $level = $plevel+1;
    $Q = "SELECT DISTINCT l_$level FROM km WHERE `l_$plevel` = '$parent'";
    if ($this->unit != null) $Q .= " AND `unit` = '$this->unit'";
    $rows = $this->mysqli->query($Q);
    $hitung = new HitungKM();
    while($row = $rows->fetch_array()){
      $km2 = new KM($row['l_'.$level], $level);
      $ach_all = $hitung->hitung($km2, $level, $this->unit);
      $this->row($km2, $ach_all, $level);
      if($level < $km2->len){
        $this->sub($km2->indikator['l_'.$level], $level);
      }
    }
  }
}
?>
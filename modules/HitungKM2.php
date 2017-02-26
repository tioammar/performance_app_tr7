<?php
class HitungKM {

  private $mysqli;

  function __construct() {
    $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
  }

  public function hitung($km, $level){ // passing level so we can check wether it has a sub level or not
    $ach_all = array();
    if($level < $km->len){
      $ach_all = $this->hitungSubLevel($km, $level);
    } else {
      for($i = 1; $i <= 4; $i++){
        $tw = "tw".$i;
        $bobot = $km->bobot[$tw];
        $real = $km->realisasi[$tw];
        $target = $km->target[$tw];
        if($target == 0){
          $ach_1 = 0;
        } else {
          if($km->type == TYPE_NORMAL){
            $ach_1 = $real/$target;
          } else {
            $ach_1 = $target/$real;
          }
        }
        $ach_2 = $ach_1 * $bobot;
        $ach = array('ach_show' => $ach_1, 'ach_sum' => $ach_2, 'bobot' => $bobot);
        $ach_all[$tw] = $ach;
      }
    }
    // $json = json_encode($ach_all);
    // echo $json;
    return $ach_all;
  }

  public function hitungSubLevel($km, $lvl){
    $ach_all = array();
    $level = $lvl + 1; // get the sub level
    $Q = "SELECT DISTINCT l_$level FROM km WHERE `l_$lvl` = '".$km->indikator['l_'.$lvl]."'";
    $row = $this->mysqli->query($Q);
    // if ($level == 4){
    //   echo $row->num_rows;
    // }
    $ach_sub_all = array();
    $i = 1;
    while($r = $row->fetch_array()){
      $km_sub = new KM($r['l_'.$level], $level);
      $ach_sub_all['km_'.$i] = $this->hitung($km_sub, $level);
      $i++;
    }
    // if($km->level == 3){
    //   $json = json_encode($ach_sub_all);
    //   echo $json;
    // }
    // hitung rata2 isi dari $ach_sub_all
    for($t = 1; $t <= 4; $t++){
      $tw = "tw".$t;
      $total_bobot = 0;
      $total_ach_sub = 0;
      for($s = 1; $s <= count($ach_sub_all); $s++){
        $total_bobot = $ach_sub_all['km_'.$s][$tw]['bobot'] + $total_bobot;
        $total_ach_sub = $ach_sub_all['km_'.$s][$tw]['ach_sum'] + $total_ach_sub;
      }
      if($total_ach_sub == 0 && $total_bobot == 0){
        $ach_1 = 0;
      } else {
        $ach_1 = $total_ach_sub/$total_bobot;
      }
      $ach_2 = $ach_1 * $total_bobot;
      $ach = array('ach_show' => $ach_1, 'ach_sum' => $ach_2, 'bobot' => $total_bobot);
      $ach_all[$tw] = $ach;
    }
    // $json = json_encode($ach_all);
    // echo $json;
    return $ach_all;
  }

  public function writeRow($parent, $plevel){ // passing parent level to get sub indikator
    $level = $plevel+1;
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
    $Q = "SELECT DISTINCT l_$level FROM km WHERE `l_$plevel` = '$parent'";
    $rows = $this->mysqli->query($Q);
    while($row = $rows->fetch_array()){
      $km2 = new KM($row['l_'.$level], $level);
      $ach_all = $this->hitung($km2, $level);
      echo "
          <tr class='$class'>
            <td class='indent-$level'>".$km2->indikator['l_'.$level]."</td>
            <td class='center-align'>$km2->tahun</td>";
    if($level < $km2->len){
      echo "
            <td class='center-align'>-</td>";
    } else {
      echo "
            <td class='center-align'>$km2->satuan</td>";
    }
    for($t = 1; $t <= 4; $t++){
      echo "
            <td class='hides center-align $t'>".$ach_all['tw'.$t]['bobot']."</td>";

            // <td class='hides center-align $t'>".$km->target['tw'.$t]."</td>
            // <td class='hides center-align $t'>".$km->realisasi['tw'.$t]."</td>";
            // } else {
      if($level < $km2->len){
        echo "
            <td class='hides center-align $t'>-</td>
            <td class='hides center-align $t'>-</td>";
      } else {
        // if($session == ADMIN_UNIT){
        //  echo "
        //    <td class='hides center-align $t'>".$km2->target['tw'.$t]."</td> // editable
        //    <td class='hides center-align $t' data-id='$km2->id' data-type='$t'>".$km2->realisasi['tw'.$t]."</td>"; // editable
        // } else {
          echo "
            <td class='hides center-align $t'>".$km2->target['tw'.$t]."</td>
            <td class='hides center-align $t'>".$km2->realisasi['tw'.$t]."</td>";
          }
      // }
        echo "
            <td class='hides center-align $t'>".rounds($ach_all['tw'.$t]['ach_show']*100)." %</td>";
    }
      echo "       
          </tr>";
      if($level < $km2->len){
        $this->writeRow($km2->indikator['l_'.$level], $level);
      }
    }
  }
}
?>
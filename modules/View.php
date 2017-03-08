<?php
class View {

  private $user;
  private $unit;
  private $mysqli;
  private $uri;
  private $count;

  function __construct($user, $unit){
    $this->user = $user;
    $this->unit = $unit;
    $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
  }

  function setUser($user){
    $this->user = $user;
  }
  
  function setURI($uri){
    $this->uri = $uri;
  }

  function setCount($count){
    $this->count = $count;
  }

  function setFilter($count, $name){
    $month = date('m', time());
    $quarter = ceil($month/3) - 1;
    $tw = $quarter == 0 ? 1 : $quarter;
    $i = 1;
    while($i <= 4){
      $cls = $i == $tw ? "selected" : "";
      echo "<option value='$i' $cls>$name $i</option>";
      $i++;
      }
  }

  function setUnit($unit){
    $this->unit = $unit;
  }

  public function showEditor($id, $t, $stt){
    $approved_stt = "disabled";
    $rejected_stt = "disabled";

    if($stt == STATUS_EDITED){
      $approved_stt = ""; // enable all button
      $rejected_stt = "";
    } else if($stt == STATUS_APPROVED){
      $rejected_stt = ""; // disable approved button
    } else if($stt == STATUS_REJECTED){
      $approved_stt = ""; // disable rejected button
    }

    $editor = "";
    switch($this->user){
      case ADMIN_UNIT:
        $editor = "<a class='$approved_stt modal-trigger btn-floating btn-small blue darken-3' data-id='$id' data-count='$t'>
                    <i class='small material-icons'>edit</i>
                  </a>";
        break;
      case ADMIN_SM:
        $editor = "<a class='$approved_stt btn-floating btn-small green ' href='process.php?type=status&stt=".STATUS_APPROVED."&id=$id&count=$t'>
                    <i class='small material-icons'>done</i>
                  </a> 
                  <a class='$rejected_stt btn-floating btn-small red darken-3' href='process.php?type=status&stt=".STATUS_REJECTED."&id=$id&count=$t'>
                    <i class='small material-icons'>close</i>
                  </a>";
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
      for($t = 1; $t <= $this->count; $t++){
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
            <td class='hides center-align $t'>".$km->realisasi['tw'.$t]." <br><span>";
          echo ($this->user != USER) ? $this->showEditor($km->id, $t, $km->status['tw'.$t]) : "";
          echo "  
            </span></td>";
            $this->editor($km->id, $t);
        }
        echo "
            <td class='hides center-align $t'>".rounds($ach_all['tw'.$t]['ach_show']*100)." %</td>";
        if($level == $km->len && $km->evid['tw'.$t] != ""){
          echo "
            <td class='hides center-align $t'>
              <a class='btn-floating btn-small blue' href='process.php?type=evid&id=$km->id&count=$t'>
                <i class='small material-icons'>library_books</i>
              </a>
            </td>";
        } else {
           echo "
            <td class='hides center-align $t'> - </td>";
        }
      }
      echo "       
          </tr>";
  }

  public function sub($parent, $plevel){
    $level = $plevel+1;
    $Q = "SELECT DISTINCT l_$level FROM km WHERE `l_$plevel` = '$parent'";
    if ($this->unit != null) $Q .= " AND `unit` = '$this->unit'";
    $rows = $this->mysqli->query($Q);
    $hitung = new HitungKM($this->count);
    while($row = $rows->fetch_array()){
      $km2 = new KM($row['l_'.$level], $level, $this->count);
      $ach_all = $hitung->hitung($km2, $level, $this->unit);
      $this->row($km2, $ach_all, $level);
      if($level < $km2->len){
        $this->sub($km2->indikator['l_'.$level], $level);
      }
    }
  }

  public function editor($id, $t){
    echo "
    <div class='modal-editor-$id-$t modal small-modal' id='modal-$id-$t'>
      <div class='modal-content'>
        <form action='process.php?&type=updatekm&id=$id&t=$t' method='post'>
        <input type='text' Placeholder='Realisasi TW $t' name='real'/>
        <input type='file' Placeholder='Evidence TW $t' name='evid'/>
      </div>
      <div class='modal-footer'>
        <input type='submit' class='btn blue'>
        </form>
      </div>
    </div>";
  }
}
?>
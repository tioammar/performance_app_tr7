<?php
require_once(__DIR__."/../config.php");
// to use this class , extends and add editor method 
class View {

  private $user;
  protected $unit;
  protected $mysqli;
  protected $uri;
  public $count;
  protected $statusType;
  protected $updateType;
  protected $useBobot;
  protected $admin;

  function __construct($user, $unit){
    $this->user = $user;
    $this->unit = $unit;
    $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
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

  function setUnit($unit){
    $this->unit = $unit;
  }

  function setUser($user){
    $this->user = $user;
  }

  public function showEditor($model, $t, $stt){
    $editor_stt = "";
    $approved_stt = "disabled";
    $rejected_stt = "disabled";
    $released_stt = "disabled";
    $notreleased_stt = "disabled";

    if($stt == STATUS_EDITED){
      $approved_stt = ""; // enable all button
      $rejected_stt = "";
    } else if($stt == STATUS_APPROVED){
      $rejected_stt = ""; // disable approved button
      $released_stt = "";
      $notreleased_stt = "";
      $editor_stt = "disabled";
    } else if($stt == STATUS_REJECTED){
      $approved_stt = ""; // disable rejected button
      $editor_stt = "";
    } else if($stt == STATUS_RELEASED){
      $notreleased_stt = "";
      $editor_stt = "disabled";
    } else if($stt == STATUS_NOT_RELEASED){
      $released_stt = "";
    }

    $editor = "";
    if($this->user != USER){
      switch($this->user){
        case ADMIN_UNIT:
          $editor = "<a class='$editor_stt modal-trigger btn-floating btn-small blue darken-3' data-id='$model->id' data-count='$t'>
                      <i class='small material-icons'>edit</i>
                    </a>";
          break;
        case ADMIN_SM:
          $editor = "<a class='$approved_stt btn-floating btn-small green ' href='process.php?type=$this->statusType&stt=".STATUS_APPROVED."&id=$model->id&t=$t'>
                      <i class='small material-icons'>done</i>
                    </a> 
                    <a class='$rejected_stt btn-floating btn-small red darken-3' href='process.php?type=$this->statusType&stt=".STATUS_REJECTED."&id=$model->id&t=$t'>
                      <i class='small material-icons'>close</i>
                    </a>";    
          break;    
        case ADMIN_ALL:
          $editor = "<a class='$released_stt btn-floating btn-small green ' href='process.php?type=$this->statusType&stt=".STATUS_RELEASED."&id=$model->id&t=$t'>
                      <i class='small material-icons'>done</i>
                    </a> 
                    <a class='$notreleased_stt btn-floating btn-small red darken-3' href='process.php?type=$this->statusType&stt=".STATUS_NOT_RELEASED."&id=$model->id&t=$t'>
                      <i class='small material-icons'>close</i>
                    </a>";
          break;
      }
    }
    if($model->evid[$t] != ""){
      $editor .= " <a class='btn-floating btn-small blue' href='process.php?type=evid&id=$model->id&count=$t'>
                    <i class='small material-icons'>library_books</i>
                  </a>";
    }
    echo $editor;
  }

  public function row($model, $ach_all, $level){
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
            <td class='indent-$level'>".$model->indikator['l_'.$level]."</td>
            <td class='center-align'>$model->tahun</td>";
      if($level < $model->len){
        echo "
            <td class='center-align'>-</td>";
      } else {
        echo "
            <td class='center-align'>$model->satuan</td>";
      }
      for($t = 1; $t <= $this->count; $t++){
        if($this->useBobot){
          if($ach_all[$t]['bobot'] < 1){
            echo "
              <td class='hides center-align $t'> - </td>"; // clean UI
          }
          else {
            echo "
              <td class='hides center-align $t'>".$ach_all[$t]['bobot']."</td>";
          }
        }
        if($level < $model->len){
          echo "
            <td class='hides center-align $t'>-</td>
            <td class='hides center-align $t'>-</td>";
        } else {
          echo "
            <td class='hides center-align $t'>".$model->target[$t]."</td>
            <td class='hides center-align $t'>".$model->realisasi[$t]."</td>";
            if($this->user == ADMIN_UNIT){
              $this->editor($model->id, $t);
              // TODO test with ADMIN_UNIT level
            }
        }
        echo "
            <td class='hides center-align $t'>".rounds($ach_all[$t]['ach_show']*100)." %</td>";
        if($level == $model->len){
          echo "
            <td class='hides center-align $t'>";
          $this->showEditor($model, $t, $model->status[$t]);
          echo "
            </td>";
        } else {
           echo "
            <td class='hides center-align $t'> - </td>";
        }
      }
      echo "       
          </tr>";
  }

  public function sub($model, $plevel){
    $level = $plevel+1;
    $Q = "SELECT DISTINCT l_$level FROM $model->table WHERE `l_$plevel` = '".$model->indikator['l_'.$plevel]."'";
    if ($this->unit != null) $Q .= " AND `unit` = '$this->unit'";
    $rows = $this->mysqli->query($Q);
    $hitung = new Hitung($this->count);
    while($row = $rows->fetch_array()){
      $model_sub = $model->make($row['l_'.$level], $level);
      $ach_all = $hitung->hitung($model_sub, $level, $this->unit);
      $this->row($model_sub, $ach_all, $level);
      if($level < $model_sub->len){
        $this->sub($model_sub, $level);
      }
    }
  }

  public function editor($id, $t){
    echo "
    <div class='modal-editor-$id-$t modal small-modal' id='modal-$id-$t'>
      <div class='modal-content'>
        <form action='process.php?&type=$this->updateType&id=$id&t=$t' method='post' enctype='multipart/form-data'>
          <input type='text' Placeholder='Realisasi TW $t' name='real'/>
          <input type='file' Placeholder='Evidence TW $t' name='evid'/>
      </div>
      <div class='modal-footer'>
          <button type='submit' class='btn blue'>Kirim</button>
        </form>
      </div>
    </div>";
  }

  public function setHeader(){
    echo "
          <thead>
            <tr class='black white-text center-align'>
              <td class='center-align'>Parameter/Indikator</td>
              <td class='center-align'>Tahun</td>
              <td class='center-align'>Satuan</td>";
    $i = 1;
    while($i <= $this->count){
      if($this->useBobot){
        echo "<td class='hides center-align $i'>Bobot</td>";
      }
      echo "
              <td class='hides center-align $i'>Target</td>
              <td class='hides center-align $i'>Realisasi</td>
              <td class='hides center-align $i'>Ach.</td>
              <td class='hides center-align $i'> </td>";
      $i++;
    }
    echo " </tr>
          </thead>";
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
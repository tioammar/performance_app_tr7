<?php
require_once(__DIR__."/../config.php");
// to use this class , extends and add editor method 
class View {

  public $user;
  public $unit;
  public $smunit;
  public $mysqli;
  public $uri;
  public $count;
  public $statusType;
  public $updateType;
  public $uploadType;
  public $useBobot;
  public $admin;

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

  function setSMUnit($unit){
    $this->smunit = $unit;
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

  public function adminallupload(){
    echo "
      <div class='fixed-action-btn' style='bottom: 45px; right: 45px;'>
        <a href='#upload-modal' class='upload btn-floating btn-large green'>
          <i class='large material-icons'>file_upload</i>
        </a>
      </div>
      <div id='upload-modal' class='modal'>
        <form action='data.php?$this->uploadType' method='post' enctype='multipart/form-data'>
          <div class='modal-content'>
            <div class='file-field input-field'>
              <div class='btn-flat'>
                <span>Pilih File</span>
                <input type='file' name='excel'>
              </div>
            <div class='file-path-wrapper'>
              <input class='file-path validate' type='text'>
            </div>
          </div>
        </div>
      <div class='modal-footer'>
        <button class='btn waves-effect waves-light right grey darken-3' type='submit' name='action'>Upload</button>
      </div>
        </form>
      </div>";
  }
}
?>
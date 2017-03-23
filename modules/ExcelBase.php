<?php
require_once("phpexcel/PHPExcel.php");
require_once("config.php");

class ExcelBase {

  protected $mysqli;
  protected $file;
  protected $count;
  protected $table;

  function __construct($file){
    $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $this->file = $file;
  }

  public function read(){
    if(isset($this->file['data'])){
      if($this->file['data']['name']){
        $input = $this->file['data']['tmp_name'];
        $ext = strtoupper(pathinfo($this->file['data']['name'], PATHINFO_EXTENSION));
        if($ext == "XLSX"){
          try {
            $inputType = PHPExcel_IOFactory::identify($input);
            $reader = PHPExcel_IOFactory::createReader($inputType);
            $obj = $reader->load($input);
          } catch(Exception $e) {
            die("tidak dapat membaca file");
          }
          $sheet = $obj->getSheet(0);
          return $this->insert($sheet);
        }
      } 
    } else {
      return UPLOAD_NOK;
    }
  }

  public function insert($sheet){
    $rows = $sheet->getHighestRow();
    $columns = $sheet->getHighestColumn();

    $bobot = "";
    $target = "";
    $real = "";

    $r = 1;
    while($r <= $this->count){
      $bobot .= "bobot_$r, ";
      $target .= "target_$r, ";
      $real .= "real_$r,";
      $r++;
    }
    $insertQuery = $bobot.$target.$real;

    for($row = 2; $row <= $rows; $row++){
      $i = 0;
      $rowData = $sheet->rangeToArray('A' . $row . ':' . $columns . $row, NULL, TRUE, FALSE);
      $array = $rowData[0];
      $Q = "INSERT INTO $this->table (l_1,l_2,l_3,l_4,$insertQuery unit,satuan,tahun) VALUES (
              '".$array[$i]."','".$array[$i+1]."', '".$array[$i+2]."','".$array[$i+3]."',";
      $b = 1;
      $bv = $i + 3;
      $vbobot = "";
      while($b <= $this->count){
        $vb = $bv + $b;
        $vbobot .= $array[$vb].",";
        $b++;
      }

      $t = 1;
      $tv = $vb;
      $vtarget = "";
      while($t <= $this->count){
        $vt = $tv + $t;
        $vtarget .= "'".$array[$vt]."',";
        $t++;
      }

      $r = 1;
      $rv = $vt;
      $vreal = "";
      while($r <= $this->count){
        $vr = $rv + $r;
        $vreal .= "'".$array[$vr]."',";
        $r++;
      }

      $Q1 = $vbobot.$vtarget.$vreal;
      $Q2 = $Q.$Q1."'".$array[$vr+1]."','".$array[$vr+2]."','".$array[$vr+3]."')";
      if($mysqli->query($Q2)){
        return UPLOAD_OK;
      } else {
        return UPLOAD_NOK;
      }
    }
  }
}
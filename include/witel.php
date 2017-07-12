<?php  
require_once("modules/model/KMWitel.php");
require_once("modules/Hitung.php");
require_once("modules/view/ViewKMWitel.php");
?>
<div class='km'>
  <div class='row'>
    <div class='input-field col s3'>
      <select id='tw'>
        <option value='' disabled>Pilih Bulan</option>
        <?php
        $view = new ViewKMWitel(USER, null);
        $view->setFilter("Bulan");
        ?>
      </select>
    </div>
  </div>
<?php
foreach($witel as $unit_name){  
  $view->setUnit($unit_name);
  $models = array();
  $Q1 = "SELECT DISTINCT l_1 FROM km_witel WHERE `witel` = '$unit_name'";
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $rows1 = $mysqli->query($Q1);
  $hitung1= new Hitung($view->count);
  $m = 0;
  $ach_all = array();
  while($row = $rows1->fetch_array()){
    $km = KMWitel::load($row['l_1'], 1);
    $models[$m] = $km;
    // $ach_all = $hitung1->hitung($km, 1, $unit_name);
    $m++;
  }
  $ach_bulan = $hitung1->hitungBulan($models, $unit_name);
  // echo json_encode($ach_bulan);

  echo "
  <div id='$unit_name'>
    <div class='row'>
      <div class='col s9'>
        <h4 class='italic'>Witel $unit_name<h4>
      </div>";
  for($month = 1; $month <= $view->count; $month++){
    echo "
      <div class='col s3 grey lighten-3 center-align periode-hides $month'>
        <small>Ach. %</small>
        <h3>".round($ach_bulan[$month]['ach_show'],2)." %</h3>
      </div>";
  }
  echo "
    </div>
    <div class='card white z-depth-2 contain'>
      <div class='card-content black-text'>
        <table class='bordered'>"; 
  $view->setUnit($unit_name);
  $view->setHeader();
  $view->setUser(USER);
  $table = $view->setTable();
  echo "
          <tbody>";
  $Q = "SELECT DISTINCT l_1 FROM km_witel WHERE `witel` = '$unit_name'";
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $rows = $mysqli->query($Q);
  $hitung = new Hitung($view->count);
  while($row = $rows->fetch_array()){
    $qw = KMWitel::load($row['l_1'], 1);
    $level = 1;
    $ach_all = $hitung->hitung($qw, 1, $unit_name);
    $table->row($qw, $ach_all, $level);
    if($level < $qw->len){
      $table->sub($qw, $level);
    }
  }
  echo "
          </tbody>
        </table>
      </div>
    </div>
  </div>";
}
?>
</div>
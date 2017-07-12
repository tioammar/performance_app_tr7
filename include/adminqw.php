<?php
if($session['level'] == ADMIN_ALL || $session['level'] == USER || $session['level'] == ADMIN_SM){
  header("Location:./?page=main");
}
require_once("modules/model/QuickWin.php");
require_once("modules/Hitung.php");
require_once("modules/view/ViewQuickWin.php");
?>
<div class='km'>
  <div class='row'>
    <div class='input-field col s3 offset-s9'>
      <select id='tw'>
        <option value='' disabled>Pilih Bulan</option>
        <?php
        $view = new ViewQuickWin($session['level'], $session['unit']);
        $view->setFilter("Bulan");
        ?>
      </select>
    </div>
  </div>
<?php
$unit = $session['unit'];  
  $view->setUnit($unit);
  $models = array();
  $Q1 = "SELECT DISTINCT l_1 FROM quickwin WHERE `unit` = '$unit'";
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $rows1 = $mysqli->query($Q1);
  $hitung1= new Hitung($view->count);
  $m = 0;
  $ach_all = array();
  while($row = $rows1->fetch_array()){
    $km = QuickWin::load($row['l_1'], 1);
    $models[$m] = $km;
    // $ach_all = $hitung1->hitung($km, 1, $unit_name);
    $m++;
  }
  $ach_bulan = $hitung1->hitungBulan($models, $unit);
  // echo json_encode($ach_bulan);

  echo "
  <div id='tr7' class='card white z-depth-2 contain'>
      <div class='card-content black-text'>
      <span class='card-title'>Quick Win $unit 2017</span>
        <table class='bordered'>";
  $view->setHeader();
  echo "
          <tbody>";
  $Q = "SELECT DISTINCT l_1 FROM quickwin WHERE `unit` = '$unit'";
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $rows = $mysqli->query($Q);
  $hitung = new Hitung($view->count);
  $table = $view->setTable();
  while($row = $rows->fetch_array()){
    $qw = QuickWin::load($row['l_1'], 1);
    $level = 1;
    $ach_all = $hitung->hitung($qw, 1, $unit);
    $table->row($qw, $ach_all, $level);
    if($level < $qw->len){
      $view->sub($qw, $level);
    }
  }
?>
        </tbody>
      </table>
    </div>
  </div>
</div>
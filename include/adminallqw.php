<?php  
if($session['level'] != ADMIN_ALL && $session['level'] != ADMIN_SM){
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
        $view = new ViewQuickWin($session['level'], null);
        $view->setFilter("Bulan");
        ?>
      </select>
    </div>
  </div>
<?php
if($session['level'] == ADMIN_SM){
  $view->setSMUnit($session['unit']);
}
foreach($units as $unit_name){
  echo "
  <div id='$unit_name' class='card white z-depth-2 contain'>
      <div class='card-content black-text'>
      <span class='card-title'>Quick Win $unit_name 2017</span>
        <table class='bordered'>"; 
  $view->setUnit($unit_name);
  $view->setHeader();
  $table = $view->setTable();
  echo "
          <tbody>";
  $Q = "SELECT DISTINCT l_1 FROM quickwin WHERE `unit` = '$unit_name'";
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $rows = $mysqli->query($Q);
  $hitung = new Hitung($view->count);
  while($row = $rows->fetch_array()){
    $qw = QuickWin::load($row['l_1'], 1);
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
  </div>";
}
if($session['level'] == ADMIN_ALL){
  $view->adminallupload();
}
?>
</div>
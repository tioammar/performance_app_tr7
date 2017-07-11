<?php  
if($session['level'] == ADMIN_ALL || $session['level'] == USER){
  header("Location:./?page=main");
}
require_once("modules/model/KMWitel.php");
require_once("modules/Hitung.php");
require_once("modules/view/ViewKMWitel.php");
?>
<div class='km'>
  <div class='row'>
    <div class='input-field col s3 offset-s9'>
      <select id='tw'>
        <option value='' disabled>Pilih Bulan</option>
        <?php
        $view = new ViewKMwitel($_SESSION['level'], null);
        $view->setFilter("Bulan");
        ?>
      </select>
    </div>
  </div>
<?php
if($session['level'] == "adminwitel"){
  $witel = array($session['unit']);   
}
foreach($witel as $unit_name){
  echo "
  <div id='$unit_name' class='card white z-depth-2 contain'>
      <div class='card-content black-text'>
      <span class='card-title'>Witel $unit_name 2017</span>
        <table class='bordered'>";
  $unit = $_SESSION['unit']; 
  $view->setHeader();
  $table = $view->setTable();
  echo "
          <tbody>";
  if($session['level'] == "adminwitel"){
    $Q = "SELECT DISTINCT l_1 FROM km_witel WHERE `witel` = '$unit'";    
  } else {
    $Q = "SELECT DISTINCT l_1 FROM km_witel WHERE `witel` = '$unit_name' AND `unit` = '$unit'";
  }
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
  </div>";
}
?>
</div>
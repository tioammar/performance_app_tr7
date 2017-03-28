<?php  
if($session['level'] != ADMIN_ALL){
  header("Location:./?page=main");
}
require_once("modules/model/KM.php");
require_once("modules/Hitung.php");
require_once("modules/view/ViewQuadrics.php");
?>
<div class='km'>
  <div class='row'>
    <div class='input-field col s3 offset-s9'>
      <select id='tw'>
        <option value='' disabled>Pilih Bulan</option>
        <?php
        $view = new ViewQuadrics(ADMIN_ALL, null);
        $view->setFilter("Bulan");
        ?>
      </select>
    </div>
  </div>
<?php
foreach($unitsQuad as $unit_name){
  echo "
  <div id='$unit_name' class='card white z-depth-2 contain'>
      <div class='card-content black-text'>
      <span class='card-title'>Quadrics $unit_name 2017</span>
        <table class='bordered'>"; 
  $view->setUnit($unit_name);
  $view->setHeader();
  $table = $view->setTable();
  echo "
          <tbody>";
  $Q = "SELECT DISTINCT l_1 FROM quadrics WHERE `unit` = '$unit_name'";
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $rows = $mysqli->query($Q);
  $hitung = new Hitung($view->count);
  while($row = $rows->fetch_array()){
    $quad = Quadrics::load($row['l_1'], 1);
    $level = 1;
    $ach_all = $hitung->hitung($quad, 1, $unit_name);
    $table->row($quad, $ach_all, $level);
    if($level < $quad->len){
      $table->sub($quad, $level);
    }
  }
  echo "
        </tbody>
      </table>
    </div>
  </div>";
}
$view->adminallupload();
?>
</div>
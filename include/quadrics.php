<?php
require_once("modules/model/Quadrics.php");
require_once("modules/Hitung.php");
require_once("modules/view/ViewQuadrics.php");
?>
<div class='km'>
  <div class='row'>
    <div class='input-field col s3 offset-s9'>
      <select id='tw'>
        <option value='' disabled>Pilih Bulan</option>
        <?php
        $view = new ViewQuadrics($session['level'], $session['unit']);
        $view->setFilter("Bulan");
        ?>
      </select>
    </div>
  </div>
<?php 
$unit = null;
  echo "
  <div id='tr7' class='card white z-depth-2 contain'>
      <div class='card-content black-text'>
      <span class='card-title'>Quadrics Telkom Regional VII</span>
        <table class='bordered'>";
  $view->setHeader();      
  echo "
          <tbody>";
  $Q = "SELECT DISTINCT l_1 FROM quadrics";
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $rows = $mysqli->query($Q);
  $hitung = new Hitung($view->count);

  $view->setUser(USER); 
  $view->setUnit(null);

  while($row = $rows->fetch_array()){
    $quad = Quadrics::load($row['l_1'], 1);
    $level = 1;
    $ach_all = $hitung->hitung($quad, 1, null);
    $view->row($quad, $ach_all, $level);
    if($level < $quad->len){
      $view->sub($quad, $level);
    }
  }
?>
        </tbody>
      </table>
    </div>
  </div>
</div>
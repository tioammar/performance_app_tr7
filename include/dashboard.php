<div id='quickwin'>
  <div class='row'>
    <div class='input-field col s3'>
      <select id='tw'>
        <option value='' disabled>Pilih Bulan</option>
        <?php
        require_once("modules/model/QuickWin.php");
        require_once("modules/Hitung.php");
        require_once("modules/view/ViewQuickWin.php");
        $view = new ViewQuickWin(USER, null);
        $view->setFilter("Bulan");
        ?>
      </select>
    </div>
  </div> 
  <div class='row'>
<?php
$u = 1;
$month1 = date('m', time()) - 1;

foreach($units as $unit_name){
  $view->setUnit($unit_name);
  $models = array();
  $Q = "SELECT DISTINCT l_1 FROM quickwin WHERE `unit` = '$unit_name'";
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $rows = $mysqli->query($Q);
  $hitung= new Hitung($view->count);
  $m = 0;
  $ach_all = array();
  while($row = $rows->fetch_array()){
    $km = QuickWin::load($row['l_1'], 1);
    $models[$m] = $km;
    // $ach_all = $hitung1->hitung($km, 1, $unit_name);
    $m++;
  }
  $ach_bulan = $hitung->hitungBulan($models, $unit_name);
  $i = 1;
  echo "
      <div class='col s4'>
        <div class='card'>
          <div class='card-content'>
            <div class='row'>
              <div class='col s7'>
                <span class='card-title'>Unit $unit_name</span>
              </div>";

          for($mth = 1; $mth <= $view->count; $mth++){
            echo "
              <div class='col s5 grey lighten-3 center-align periode-hides $mth'>
                <h5>".round($ach_bulan[$mth]['ach_show'],2)." %</h5>
              </div>";
          }
  echo "     </div>
            <div class='row'>";
  // for($i = 1; $i <= $view->count; $i++){
    echo "
              <div class='chart-$u'></div>";
  // }
  echo "
            </div>
          </div>
        </div>
      </div>
  ";
  echo "
  <script>
  new Chartist.Line('.chart-$u', {
    labels: [],
    series: [[";
  if($month1 > 4) $start = $month1 - 4;
  for($i = $start; $i <= $month1; $i++){
    echo $ach_bulan[$i]['ach_show'].",";
  }  
  echo "]]
  }, {
    fullWidth: true,
    chartPadding: {
      right: 40
    }
  })
  </script>";
  $u++;
}
?>
  </div>
</div>
<div id='km_witel'>
  <div class='row'>
    <div class='input-field col s3'>
      <select id='tw'>
        <option value='' disabled>Pilih Bulan</option>
        <?php
        require_once("modules/model/KMWitel.php");
        require_once("modules/Hitung.php");
        require_once("modules/view/ViewKMWitel.php");
        $view1 = new ViewKMWitel(USER, null);
        $view1->setFilter("Bulan");
        ?>
      </select>
    </div>
  </div> 
  <div class='row'>
<?php
$u = 1;
$month = date('m', time()) - 1;

foreach($witel as $unit_name){
  $view1->setUnit($unit_name);
  $models = array();
  $Q1 = "SELECT DISTINCT l_1 FROM km_witel WHERE `witel` = '$unit_name'";
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $rows1 = $mysqli->query($Q1);
  $hitung1= new Hitung($view->count);
  $m = 0;
  $ach_all = array();
  while($row1 = $rows1->fetch_array()){
    $model = KMWitel::load($row1['l_1'], 1);
    $models[$m] = $model;
    // $ach_all = $hitung1->hitung($km, 1, $unit_name);
    $m++;
  }
  $ach_bulan = $hitung1->hitungBulan($models, $unit_name);
  $i = 1;
  echo "
      <div class='col s4'>
        <div class='card'>
          <div class='card-content'>
            <div class='row'>
              <div class='col s7'>
                <span class='card-title'>Witel $unit_name</span>
              </div>";

          for($mth = 1; $mth <= $view1->count; $mth++){
            echo "
              <div class='col s5 grey lighten-3 center-align periode-hides $mth'>
                <h5>".round($ach_bulan[$mth]['ach_show'],2)." %</h5>
              </div>";
          }
  echo "     </div>
            <div class='row'>";
  // for($i = 1; $i <= $view->count; $i++){
    echo "
              <div class='chartwitel-$u'></div>";
  // }
  echo "
            </div>
          </div>
        </div>
      </div>
  ";
  echo "
  <script>
  new Chartist.Line('.chartwitel-$u', {
    labels: [],
    series: [[";
  if($month > 4) $start = $month - 4;
  for($i = $start; $i <= $month; $i++){
    echo $ach_bulan[$i]['ach_show'].",";
  }  
  echo "]]
  }, {
    fullWidth: true,
    chartPadding: {
      right: 40
    }
  })
  </script>";
  $u++;
}
?>
  </div>
</div>
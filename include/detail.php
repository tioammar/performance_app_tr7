<?php
require_once("modules/view/DetailViewKM.php");
require_once("modules/view/DetailViewQuickWin.php");
require_once("modules/view/DetailViewKMWitel.php");
require_once("modules/view/DetailTableView.php");
require_once("modules/model/Support.php");
require_once("modules/model/ActionPlan.php");
require_once("modules/model/Lesson.php");
require_once("modules/model/KM.php");
require_once("modules/model/QuickWin.php");
require_once("modules/model/KMWitel.php");

if(!isset($_GET['type']) || $_GET['type'] == ""){
  header("Location: ./");
}
$id = $_GET['id'];
$type = $_GET['type'];
if($type == "km"){
  $model = KM::loadById($id);
  $indikator = $model->indikator['l_'.$model->len];
  $view = new DetailViewKM($id);
  $table = $view->setTable();
} else if($type == "quickwin"){
  $model = QuickWin::loadById($id);
  $indikator = $model->indikator['l_'.$model->len];
  $view = new DetailViewQuickWin($id);
  $table = $view->setTable();
} else if($type == "km_witel"){
  $model = KMWitel::loadById($id);
  $indikator = $model->indikator['l_'.$model->len];
  $view = new DetailViewKMWitel($id);
  $table = $view->setTable();
}

// User Filter
if($_SESSION['level'] == ADMIN_WITEL){
  if($model->witel != $_SESSION['unit']){
    header("Location: ./");
  }
} else if($_SESSION['level'] == ADMIN_UNIT){
  if($model->unit != $_SESSION['unit']){
    header("Location: ./");
  }
  if($type == "km_witel"){
    header("Location: ./");
  }  
}

$view->setUnit($_SESSION['unit']);
$view->setUser($_SESSION['level']);
?>

<div class='km'>
  <div class='row'>
    <h3><?php echo $indikator; ?></h3>
  </div>
  <div class='row'>
    <div class='col s12'>
      <div class='chart'></div>
    </div>
  </div>
  <div class='row'>
    <div class='input-field col s3 offset-s9'>
      <select id='periode'>
        <option value='' disabled>Pilih Bulan</option>
        <?php
        $view->setFilter("Bulan");
        ?>
      </select>
    </div>
  </div>
<?php
  for($i = 1; $i <= $view->count; $i++){
    echo "
  <div class='row periode-hides $i' id='periode-$i'>
    <div class='row'>
      <table class='striped' id='support'>
        <thead>
          <th>Support Needed</th>
          <th>Unit</th>
          <th>Type</th>
          <th></th>
        </thead>
        <tbody>";

    $supports = array();
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $Q = "SELECT id FROM support WHERE `item_type` = '$type' AND `item_id` = '$id' AND `periode` = $i";
    $row = $mysqli->query($Q);
    $s = 0;
    while($r = $row->fetch_array()){
      $support = Support::loadById($r['id']);
      $supports[$s] = $support;
      $s++;
    }
    foreach($supports as $ss){
      $table->row($ss, "support");
    }

    echo "
        </tbody>
      </table>
    </div>";

    if($type == "km_witel"){
      if($_SESSION['level'] == ADMIN_WITEL && $model->witel == $_SESSION['unit']){
        echo "
        <a class='modal-trigger-support waves-effect waves-light btn' data-count='$i'>+ Support Needed</a>
        <div class='modal-add-support-$i modal small-modal' id='modal-add-support-$i'>
          <div class='modal-content'>
            <form action='data.php?addsupportwitel&id=$id&t=$i&type=$type' method='post' enctype='multipart/form-data'>
              <input type='text' Placeholder='Support Needed Periode $i' name='item'/>
              <div class='row'>
                <div class='col s4'>
                  <select name='unit'>
                    <option value='' disabled selected>Pilih Unit</option>";
                    foreach($units as $unit){
                    echo "<option value='$unit'>$unit</option>";
                    }
                  echo "
                  </select>
                </div>
                <div class='col s4'>
                  <select name='type'>
                    <option value='' disabled selected>Pilih Tipe</option>
                    <option value='Process'>Process</option>
                    <option value='People'>People</option>
                    <option value='Tools'>Tools</option>
                  </select>
                </div>
                <div class='col s4'>
                </div>
              </div>
              <button type='submit' class='btn blue'>Kirim</button>
            </form>
          </div>
        </div>
        <div class='row'></div>";
      }
    } else {
      if($_SESSION['level'] == ADMIN_UNIT && $model->unit == $_SESSION['unit']){
        echo "
        <a class='modal-trigger-support waves-effect waves-light btn' data-count='$i'>+ Support Needed</a>
        <div class='modal-add-support-$i modal small-modal' id='modal-add-support-$i'>
          <div class='modal-content'>
            <form action='data.php?addsupport&id=$id&t=$i&type=$type' method='post' enctype='multipart/form-data'>
              <input type='text' Placeholder='Support Needed Periode $i' name='item'/>
              <div class='row'>
                <div class='col s4'>
                  <select name='unit'>
                    <option value='' disabled selected>Pilih Unit</option>";
                    foreach($units as $unit){
                    echo "<option value='$unit'>$unit</option>";
                    }
                  echo "
                  </select>
                </div>
                <div class='col s4'>
                  <select name='type'>
                    <option value='' disabled selected>Pilih Tipe</option>
                    <option value='Process'>Process</option>
                    <option value='People'>People</option>
                    <option value='Tools'>Tools</option>
                  </select>
                </div>
                <div class='col s4'>
                </div>
              </div>
              <button type='submit' class='btn blue'>Kirim</button>
            </form>
          </div>
        </div>
        <div class='row'></div>";
      }     
    }
    
    echo "
      <div class='row'>
        <table class='striped' id='lesson'>
          <thead>
            <th>Lesson Learned</th>
            <th></th>
          </thead>
          <tbody>";
    $lessons = array();
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $Q = "SELECT id FROM lesson WHERE `item_type` = '$type' AND `item_id` = '$id' AND `periode` = $i";
    $row = $mysqli->query($Q);
    $l = 0;
    while($r = $row->fetch_array()){
      $lesson = Lesson::loadById($r['id']);
      $lessons[$l] = $lesson;
      $l++;
    }
    foreach($lessons as $ls){
      $table->row($ls, "lesson");
    }
    echo "
        </tbody>
      </table>
    </div>";

    if($_SESSION['level'] == ADMIN_UNIT || $_SESSION['level'] == ADMIN_WITEL){
      echo "
        <a class='modal-trigger-lesson waves-effect waves-light btn' data-count='$i'>+ Lesson Learned</a>
        <div class='modal-add-lesson-$i modal small-modal' id='modal-add-lesson-$i'>
          <div class='modal-content'>
            <form action='data.php?addlesson&id=$id&t=$i&type=$type' method='post' enctype='multipart/form-data'>
              <input type='text' Placeholder='Lesson Learned Periode $i' name='item'/>
              <button type='submit' class='btn blue'>Kirim</button>
            </form>
          </div>
        </div>
        <div class='row'></div>";
    }

    echo "
      <div class='row'>
        <table class='striped' id='action-plan'>
          <thead>
            <th>Action Plan</th>
            <th></th>
          </thead>
          <tbody>";
    $actionplans = array();
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $Q = "SELECT id FROM actionplan WHERE `item_type` = '$type' AND `item_id` = '$id' AND `periode` = $i";
    $row = $mysqli->query($Q);
    $a = 0;
    while($r = $row->fetch_array()){
      $actionplan = ActionPlan::loadById($r['id']);
      $actionplans[$a] = $actionplan;
      $a++;
    }
    foreach($actionplans as $aps){
      $table->row($aps, "action");
    }
    echo "
        </tbody>
      </table>
    </div>";

    if($_SESSION['level'] == ADMIN_UNIT || $_SESSION['level'] == ADMIN_WITEL){
        echo "
        <a class='modal-trigger-action waves-effect waves-light btn' data-count='$i'>+ Action Plan</a>
        <div class='modal-add-action-$i modal small-modal' id='modal-add-action-$i'>
          <div class='modal-content'>
            <form action='data.php?addaction&id=$id&t=$i&type=$type' method='post' enctype='multipart/form-data'>
              <input type='text' Placeholder='Action Plan Periode $i' name='item'/>
              <button type='submit' class='btn blue'>Kirim</button>
            </form>
          </div>
        </div>";
    }
    echo "
  </div>";
  }

  echo "
  <script>
  new Chartist.Line('.chart', {
    labels: [],
    series: [[";
  $month = date('m', time());
  $start = 0;
  if($month > 4 ) $start = $month - 4;
  for($i = $start; $i <= $month; $i++){
    if($model->target != 0){
      $ach = round(($model->realisasi[$i] / $model->target[$i]) * 100, 2);
    } else $ach = 0;
    echo $ach.",";
  }  
  echo " ]]
  }, {
    fullWidth: true,
    chartPadding: {
      right: 40
    }
  })

  </script>"
?>
  </div>

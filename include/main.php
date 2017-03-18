<?php
require_once("modules/model/KM.php");
require_once("modules/Hitung.php");
require_once("modules/view/ViewKM.php");
?>
<div class='km'>
  <div class='row'>
    <div class='input-field col s3 offset-s9'>
      <select id='tw'>
        <option value='' disabled>Pilih TW</option>
        <?php
        $view = new ViewKM($session['level'], $session['unit']);
        $view->setFilter("Triwulan");
        ?>
      </select>
    </div>
  </div>
<?php 
$unit = null;
  echo "
  <div id='tr7' class='card white z-depth-2 contain'>
      <div class='card-content black-text'>
      <span class='card-title'>KM Telkom Regional VII</span>
        <table class='bordered'>";
  $view->setHeader();      
  echo "
          <tbody>";
  $Q = "SELECT DISTINCT l_1 FROM km";
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $rows = $mysqli->query($Q);
  $hitung = new Hitung($view->count);

  $view->setUser(USER); 
  $view->setUnit(null);

  while($row = $rows->fetch_array()){
    $km = KM::load($row['l_1'], 1);
    $level = 1;
    $ach_all = $hitung->hitung($km, 1, null);
    $view->row($km, $ach_all, $level);
    if($level < $km->len){
      $view->sub($km, $level);
    }
  }
?>
        </tbody>
      </table>
    </div>
  </div>
<script>
$('#tw').on("change", function() {
    hideAll();
    showSelected($(this).val());
});

function hideAll() {
	$('tr td.hides').each(function(){
    	$(this).hide();
    });
}

function showSelected(selected) {
  var classes = parseInt(selected);
	$('tr td.'+classes).each(function(){
    $(this).show();
  });
}

$(document).ready(function(){
    $('#tw').change();
})
</script>
</div>
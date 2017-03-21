<?php
if(in_array($session['unit'], $unitsQuad)){
  if($session['level'] == ADMIN_ALL || $session['level'] == USER){
    header("Location:./?page=main");
  }
} else {
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
        $view = new ViewQuadrics($session['level'], $session['unit']);
        $view->setFilter("Bulan");
        ?>
      </select>
    </div>
  </div>
<?php
$unit = $session['unit'];
  echo "
  <div id='tr7' class='card white z-depth-2 contain'>
      <div class='card-content black-text'>
      <span class='card-title'>Quadrics $unit 2017</span>
        <table class='bordered'>";
  $view->setHeader();
  echo "
          <tbody>";
  $Q = "SELECT DISTINCT l_1 FROM quadrics WHERE `unit` = '$unit'";
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $rows = $mysqli->query($Q);
  $hitung = new Hitung($view->count);
  while($row = $rows->fetch_array()){
    $quad = Quadrics::load($row['l_1'], 1);
    $level = 1;
    $ach_all = $hitung->hitung($quad, 1, $unit);
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

$('.modal-trigger').on('click', function() {
  var id = $(this).attr('data-id');
  var tw = $(this).attr('data-count');
  $('#modal-'+id+'-'+tw).modal('open');
});

function showSelected(selected) {
  var classes = parseInt(selected);
	$('tr td.'+classes).each(function(){
    $(this).show();
  });
}

$(document).ready(function(){
  $('#tw').change();
  $('.modal').modal();
})
</script>
</div>
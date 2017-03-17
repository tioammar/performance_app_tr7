<?php  
if($session['level'] != ADMIN_ALL){
  header("Location:./?page=main");
}

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
        $count = 4;
        $view = new ViewKM(ADMIN_ALL, null, $count);
        $view->setFilter("Triwulan");
        ?>
      </select>
    </div>
  </div>
<?php
foreach($units as $unit_name){
  echo "
  <div id='$unit_name' class='card white z-depth-2 contain'>
      <div class='card-content black-text'>
      <span class='card-title'>KM $unit_name 2017</span>
        <table class='bordered'>"; 
  $view->setUnit($unit_name);
  $view->setHeader();
  echo "
          <tbody>";
  $Q = "SELECT DISTINCT l_1 FROM km WHERE `unit` = '$unit_name'";
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $rows = $mysqli->query($Q);
  $hitung = new Hitung($count);
  while($row = $rows->fetch_array()){
    $km = KM::load($row['l_1'], 1);
    $level = 1;
    $ach_all = $hitung->hitung($km, 1, $unit_name);
    $view->row($km, $ach_all, $level);
    if($level < $km->len){
      $view->sub($km, $level);
    }
  }
  echo "
        </tbody>
      </table>
    </div>
  </div>";
}
?>

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
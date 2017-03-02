<div class='km'>
  <div class='row'>
    <div class='input-field col s3 offset-s9'>
      <select id='tw'>
        <option value='' disabled>Pilih TW</option>
        <option value='1' selected>Triwulan 1</option>
        <option value='2'>Triwulan 2</option>
        <option value='3'>Triwulan 3</option>
        <option value='4'>Triwulan 4</option>
      </select>
    </div>
  </div>
<?php
require_once("modules/model/KM2.php");
require_once("modules/HitungKM2.php");
$unit = $session['unit'];
// for($w = 0; $w < count($cat); $w++){
  // $div = getWitelId($cat_name);
  echo "
  <div id='tr7' class='card white z-depth-2 contain'>
      <div class='card-content black-text'>
      <span class='card-title'>KM Telkom Regional VII</span>
        <table class='bordered'>
          <thead>
            <tr class='black white-text center-align'>
              <td class='center-align'>Parameter/Indikator</td>
              <td class='center-align'>Tahun</td>
              <td class='center-align'>Satuan</td>
              <td class='hides center-align 1'>Bobot TW 1</td>
              <td class='hides center-align 1'>Target TW 1</td>
              <td class='hides center-align 1'>Realisai TW 1</td>
              <td class='hides center-align 1'>Ach. TW 1</td>
              <td class='hides center-align 2'>Bobot TW 2</td>
              <td class='hides center-align 2'>Target TW 2</td>
              <td class='hides center-align 2'>Realisai TW 2</td>
              <td class='hides center-align 2'>Ach. TW 2</td>
              <td class='hides center-align 3'>Bobot TW 3</td>
              <td class='hides center-align 3'>Target TW 3</td>
              <td class='hides center-align 3'>Realisai TW 3</td>
              <td class='hides center-align 3'>Ach. TW 3</td>
              <td class='hides center-align 4'>Bobot TW 4</td>
              <td class='hides center-align 4'>Target TW 4</td>
              <td class='hides center-align 4'>Realisai TW 4</td>
              <td class='hides center-align 4'>Ach. TW 4</td>
            </tr>
          </thead>
          <tbody>";
  $Q = "SELECT DISTINCT l_1 FROM km WHERE `unit` = '$unit'";
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $rows = $mysqli->query($Q);
  $hitung = new HitungKM();
  while($row = $rows->fetch_array()){
    $km = new KM($row['l_1'], 1);
    $level = 1;
    $ach_all = $hitung->hitung($km, 1, $unit);
    $view->row($km, $ach_all, $level);
    if($level < $km->len){
      $view->sub($km->indikator['l_1'], $level);
    }
  }
?>
        </tbody>
      </table>
    </div>
  </div>";
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
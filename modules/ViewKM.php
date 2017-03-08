<?php
require_once("View.php");

class ViewKM extends View {

  public function sub($parent, $plevel){
    $level = $plevel+1;
    $Q = "SELECT DISTINCT l_$level FROM km WHERE `l_$plevel` = '$parent'";
    if ($this->unit != null) $Q .= " AND `unit` = '$this->unit'";
    $rows = $this->mysqli->query($Q);
    $hitung = new HitungKM($this->count);
    while($row = $rows->fetch_array()){
      $km2 = new KM($row['l_'.$level], $level, $this->count);
      $ach_all = $hitung->hitung($km2, $level, $this->unit);
      $this->row($km2, $ach_all, $level);
      if($level < $km2->len){
        $this->sub($km2->indikator['l_'.$level], $level);
      }
    }
  }

  public function editor($id, $t){
    echo "
    <div class='modal-editor-$id-$t modal small-modal' id='modal-$id-$t'>
      <div class='modal-content'>
        <form action='process.php?&type=updatekm&id=$id&t=$t' method='post'>
        <input type='text' Placeholder='Realisasi TW $t' name='real'/>
        <input type='file' Placeholder='Evidence TW $t' name='evid'/>
      </div>
      <div class='modal-footer'>
        <input type='submit' class='btn blue'>
        </form>
      </div>
    </div>";
  }
}
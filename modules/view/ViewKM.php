<?php
require_once("View.php");

class ViewKM extends View {

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
<?php
require_once("TableView.php");
require_once(__DIR__."/../config.php");

class TableKM extends TableView {

  protected $level1 = "grey lighten-1";
  protected $level2 = "grey lighten-2";
  protected $level3 = "grey lighten-3";
  protected $level4 = "white";
  protected $useEvid = true;

  public function editor($id, $t){
    echo "
    <div class='modal-editor-$id-$t modal small-modal' id='modal-$id-$t'>
      <div class='modal-content'>
        <form action='data.php?".$this->view->updateType."&id=$id&t=$t' method='post' enctype='multipart/form-data'>
          <input type='text' Placeholder='Realisasi TW $t' name='real'/>
          <input type='file' Placeholder='Evidence TW $t' name='evid'/>
          <button type='submit' class='btn blue right'>Kirim</button>
        </form>
      </div>
    </div>";
  }

  public function rejEditor($id, $t){
    echo "
    <div class='modal-reject-$id-$t modal small-modal' id='modal-reject-$id-$t'>
      <div class='modal-content'>
        <form action='data.php?".$this->view->statusType."&stt=".STATUS_REJECTED."&id=$id&t=$t' method='post' enctype='multipart/form-data'>
          <input type='text' Placeholder='Catatan' name='message'/>
          <button type='submit' class='btn blue'>Kirim</button>
        </form>
      </div>
    </div>";
  }

  public function nrEditor($id, $t, $unit){ 
    echo "
    <div class='modal-nr-$id-$t modal small-modal' id='modal-nr-$id-$t'>
      <div class='modal-content'>
        <form action='data.php?".$this->view->statusType."&stt=".STATUS_NOT_RELEASED."&id=$id&t=$t&dest=$unit' method='post' enctype='multipart/form-data'>
          <input type='text' Placeholder='Catatan' name='message'/>
          <button type='submit' class='btn blue'>Kirim</button>
        </form>
      </div>
    </div>";
  }

  public function witelEditor($id, $t){ 
    echo "
    <div class='modal-wit-$id-$t modal small-modal' id='modal-nr-$id-$t'>
      <div class='modal-content'>
        <form action='data.php?".$this->view->statusType."&stt=".STATUS_REJECTED_WITEL."&id=$id&t=$t' method='post' enctype='multipart/form-data'>
          <input type='text' Placeholder='Catatan' name='message'/>
          <button type='submit' class='btn blue'>Kirim</button>
        </form>
      </div>
    </div>";
  }
}
?>
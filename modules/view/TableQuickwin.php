<?
require_once("TableView.php");
require_once(__DIR__."/../config.php");

class TableQuickWin extends TableView {

  protected $level1 = "white";
  protected $level2 = "white";
  protected $level3 = "white";
  protected $level4 = "white";
  protected $useEvid = true;

  public function editor($id, $t){
    echo "
    <div class='modal-editor-$id-$t modal small-modal' id='modal-$id-$t'>
      <div class='modal-content'>
        <form action='process.php?&type=".$this->view->updateType."&id=$id&t=$t' method='post' enctype='multipart/form-data'>
          <input type='text' Placeholder='Realisasi TW $t' name='real'/>
          <input type='file' Placeholder='Evidence TW $t' name='evid'/>
      </div>
      <div class='modal-footer'>
          <button type='submit' class='btn blue'>Kirim</button>
        </form>
      </div>
    </div>";
  }

  public function rejEditor($id, $t){
    echo "
    <div class='modal-reject-$id-$t modal small-modal' id='modal-$id-$t'>
      <div class='modal-content'>
        <form action='process.php?type=".$this->view->statusType."&stt=".STATUS_REJECTED."&id=$id&t=$t' method='post' enctype='multipart/form-data'>
          <input type='text' Placeholder='Catatan' name='message'/>
      </div>
      <div class='modal-footer'>
          <button type='submit' class='btn blue'>Kirim</button>
        </form>
      </div>
    </div>";
  }
}
?>
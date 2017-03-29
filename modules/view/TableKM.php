<?
require_once("TableView.php");
require_once(__DIR__."/../config.php");

class TableKM extends TableView {

  protected $level1 = "red accent-4 white-text";
  protected $level2 = "red white-text";
  protected $level3 = "light-blue lighten-5";
  protected $level4 = "white";
  protected $useEvid = true;

  public function editor($id, $t){
    echo "
    <div class='modal-editor-$id-$t modal small-modal' id='modal-$id-$t'>
      <div class='modal-content'>
        <form action='process.php?&".$this->view->updateType."&id=$id&t=$t' method='post' enctype='multipart/form-data'>
          <input type='text' Placeholder='Realisasi TW $t' name='real'/>
          <input type='file' Placeholder='Evidence TW $t' name='evid'/>
          <button type='submit' class='btn blue right'>Kirim</button>
        </form>
      </div>
    </div>";
  }

  public function rejEditor($id, $t){
    echo "
    <div class='modal-reject-$id-$t modal small-modal' id='modal-$id-$t'>
      <div class='modal-content'>
        <form action='process.php?".$this->view->statusType."&stt=".STATUS_REJECTED."&id=$id&t=$t' method='post' enctype='multipart/form-data'>
          <input type='text' Placeholder='Catatan' name='message'/>
          <button type='submit' class='btn blue right'>Kirim</button>
        </form>
      </div>
    </div>";
  }
}
?>
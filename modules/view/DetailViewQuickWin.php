<?php
require_once("DetailView.php");
require_once("DetailTableView.php");

class DetailViewQuickWin extends DetailView {

  public $count = 4;

  public function __construct($id){
    $this->itemId = $id;
  }

  public function setTable(){
    return new DetailTableView($this, "quickwin");
  }

  public function editor($model){
    echo "
    <div class='modal-rejwit-$model->id-$model->periode modal small-modal' id='modal-rejwit-$model->id-$model->periode'>
      <div class='modal-content'>
        <form action='data.php?statussupport&stt=".STATUS_REJECTED."&id=$model->id&unit=$model->unit&t=$model->periode' method='post' enctype='multipart/form-data'>
          <input type='text' Placeholder='Catatan' name='message'/>
          <button type='submit' class='btn blue'>Kirim</button>
        </form>
      </div>
    </div>";
  }
}
?>
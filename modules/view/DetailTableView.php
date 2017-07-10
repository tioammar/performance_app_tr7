<?php
require_once(__DIR__."/../config.php");

class DetailTableView {

  protected $view;
  private $type;

  function __construct($view, $type){
    $this->view = $view;
    $this->type = $type;
  }

  public function showEditor($model, $stt, $type){
    $editor_stt = "";
    $approved = "disabled";
    $rejected = "disabled";

    if($stt == STATUS_ADDED){
      $approved = ""; // enable all button
      $rejected = "";
    } else if($stt == STATUS_APPROVED_WITEL){
      $rejected = "";
      $editor_stt = "disabled";
    } else if($stt == STATUS_REJECTED_WITEL){
      $approved = "";
    }

    $editor = "";
    if($this->view->user != USER){
      switch($this->view->user){
        case ADMIN_UNIT:
          $editor = "<a class='$editor_stt btn-floating btn-small red darken-3' href='data.php?delete$type&&id=$model->id&t=$model->periode'>
                      <i class='small material-icons'>close</i>
                    </a>";
          break;
        case ADMIN_SM:
          $editor = "<a class='$approved btn-floating btn-small green' href='data.php?statussupport&stt=".STATUS_APPROVED."&id=$model->id&witel=$model->witel&t=$model->periode'>
                      <i class='small material-icons'>done</i>
                    </a> 
                    <a class='$rejected btn-floating modal-trigger-rejwit btn-small red darken-3' data-id='$model->id' data-count='$model->periode'>
                      <i class='small material-icons'>close</i>
                    </a>";
          break;         
      }
      echo $editor;
    }
  }

  public function row($model, $type){
    echo "
          <tr'>
            <td class=''>".$model->item."</td>";
      if($type == "support"){
        echo "
            <td class=''>".$model->witel."</td>
            <td class=''>".$model->type."</td>";
            if($this->view->user == ADMIN_SM){
              $this->view->editor($model);
            }
      }
      echo "
            <td class=''>";
      if($this->view->user == ADMIN_UNIT || $this->view->user == ADMIN_WITEL){
        if($type == "support"){
          $this->showEditor($model, $model->stt, $type);
        } else {
          $this->showEditor($model, null, $type);
        }
      }
      echo "
            </td>";
      echo "       
          </tr>";
  }
}
?>
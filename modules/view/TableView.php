<?php
require_once(__DIR__."/../config.php");

class TableView {

  protected $view;
  protected $useEvid;

  function __construct($view){
    $this->view = $view;
  }

  public function showEditor($model, $t, $stt){
    $editor_stt = "";
    $approved_stt = "disabled";
    $rejected_stt = "disabled";
    $released_stt = "disabled";
    $notreleased_stt = "disabled";

    if($stt == STATUS_EDITED){
      $approved_stt = ""; // enable all button
      $rejected_stt = "";
    } else if($stt == STATUS_APPROVED){
      $rejected_stt = ""; // disable approved button
      $released_stt = "";
      $notreleased_stt = "";
      $editor_stt = "disabled";
    } else if($stt == STATUS_REJECTED){
      $approved_stt = ""; // disable rejected button
      $editor_stt = "";
    } else if($stt == STATUS_RELEASED){
      $notreleased_stt = "";
      $editor_stt = "disabled";
    } else if($stt == STATUS_NOT_RELEASED){
      $released_stt = "";
    }

    $editor = "";
    if($this->view->user != USER){
      switch($this->view->user){
        case ADMIN_UNIT:
          $editor = "<a class='$editor_stt modal-trigger blue darken-3' data-id='$model->id' data-count='$t'>
                      <i class='small material-icons'>edit</i>
                    </a>";
          break;
        case ADMIN_SM:
          $editor = "<a class='$approved_stt green-text' href='data.php?".$this->view->statusType."&stt=".STATUS_APPROVED."&id=$model->id&t=$t'>
                      <i class='small material-icons'>done</i>
                    </a> 
                    <!--a class='$rejected_stt red-text text-darken-3' href='data.php?".$this->view->statusType."&stt=".STATUS_REJECTED."&id=$model->id&t=$t'>
                      <i class='small material-icons'>close</i>
                    </a-->
                    <a class='$rejected_stt modal-trigger-reject red-text text-darken-3' data-id='$model->id' data-count='$t'>
                      <i class='small material-icons'>close</i>
                    </a>";    
          break;    
        case ADMIN_ALL:
          $editor = "<a class='$released_stt green-text' href='data.php?".$this->view->statusType."&stt=".STATUS_RELEASED."&id=$model->id&t=$t'>
                      <i class='small material-icons'>done</i>
                    </a> 
                    <a class='$notreleased_stt red-text text-darken-3' href='data.php?".$this->view->statusType."&stt=".STATUS_NOT_RELEASED."&id=$model->id&t=$t'>
                      <i class='small material-icons'>close</i>
                    </a>";
          break;
      }
      echo $editor;
    }
  }

  public function row($model, $ach_all, $level){
    switch($level){
      case 1:
        $class = $this->level1;
        break;
      case 2:
        $class = $this->level2;
        break;
      case 3:
        $class = $this->level3;
        break;
      case 4:
        $class = $this->level4;
        break;
      default:
        // do nothing
    }
    echo "
          <tr class='$class'>
            <td class='indent-$level'>".$model->indikator['l_'.$level]."</td>
            <td class='center-align'>$model->tahun</td>";
      if($level < $model->len){
        echo "
            <td class='center-align'>-</td>";
      } else {
        echo "
            <td class='center-align'>$model->satuan</td>";
      }
      for($t = 1; $t <= $this->view->count; $t++){
        if($this->view->useBobot){
          if($ach_all[$t]['bobot'] < 1){
            echo "
              <td class='hides center-align $t'> - </td>"; // clean UI
          }
          else {
            echo "
              <td class='hides center-align $t'>".$ach_all[$t]['bobot']."</td>";
          }
        }
        if($level < $model->len){
          echo "
            <td class='hides center-align $t'>-</td>
            <td class='hides center-align $t'>-</td>";
        } else {
          echo "
            <td class='hides center-align $t'>".$model->target[$t]."</td>
            <td class='hides center-align $t'>".$model->realisasi[$t]."</td>";

            if($this->view->user == ADMIN_UNIT){
              $this->editor($model->id, $t);
              // TODO test with ADMIN_UNIT level
            }
            if($this->view->user == ADMIN_ALL || $this->view->user == ADMIN_SM){
              $this->rejEditor($model->id, $t);
            }
        }
        echo "
            <td class='hides center-align $t'>".rounds($ach_all[$t]['ach_show']*100)." %</td>";
        if($level == $model->len){
          echo "
            <td class='hides center-align $t'>";
          $this->showEditor($model, $t, $model->status[$t]);
          if($this->useEvid){
            echo "
              <a class='$class' href='data.php?evid&id=$model->id&type=$model->table'>
                <i class='small material-icons'>description</i>
              </a>";
          }
          echo " 
            </td>";
        } else {
          echo "
            <td class='hides center-align $t'> </td>";
        }
      }
      echo "       
          </tr>";
  }

  public function sub($model, $plevel){
    $level = $plevel+1;
    $Q = "SELECT DISTINCT l_$level FROM $model->table WHERE `l_$plevel` = '".$model->indikator['l_'.$plevel]."'";
    if ($this->view->unit != null) $Q .= " AND `unit` = '".$this->view->unit."'";
    $rows = $this->view->mysqli->query($Q);
    $hitung = new Hitung($this->view->count);
    while($row = $rows->fetch_array()){
      $model_sub = $model->make($row['l_'.$level], $level);
      $ach_all = $hitung->hitung($model_sub, $level, $this->view->unit);
      $this->row($model_sub, $ach_all, $level);
      if($level < $model_sub->len){
        $this->sub($model_sub, $level);
      }
    }
  }
}
?>
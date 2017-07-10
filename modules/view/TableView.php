<?php
require_once(__DIR__."/../config.php");

class TableView {

  protected $view;
  protected $useEvid;
  private $type;

  function __construct($view, $type){
    $this->view = $view;
    $this->type = $type;
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
          $editor = "<a class='$editor_stt btn-floating btn-small modal-trigger blue darken-3' data-id='$model->id' data-count='$t'>
                      <i class='small material-icons'>edit</i>
                    </a>";
          break;
        case ADMIN_SM:
          $editor = "<a class='$approved_stt btn-floating btn-small green' href='data.php?".$this->view->statusType."&stt=".STATUS_APPROVED."&id=$model->id&t=$t'>
                      <i class='small material-icons'>done</i>
                    </a> 
                    <!--a class='$rejected_stt btn-floating btn-small red darken-3' href='data.php?".$this->view->statusType."&stt=".STATUS_REJECTED."&id=$model->id&t=$t'>
                      <i class='small material-icons'>close</i>
                    </a-->
                    <a class='$rejected_stt btn-floating modal-trigger-reject btn-small red darken-3' data-id='$model->id' data-count='$t'>
                      <i class='small material-icons'>close</i>
                    </a>";    
          break;    
        case ADMIN_ALL:
          $editor = "<a class='$released_stt btn-floating btn-small green' href='data.php?".$this->view->statusType."&stt=".STATUS_RELEASED."&id=$model->id&t=$t'>
                      <i class='small material-icons'>done</i>
                    </a> 
                    <a class='$notreleased_stt btn-floating modal-trigger-nr btn-small red darken-3' data-id='$model->id' data-count='$t'>
                      <i class='small material-icons'>close</i>
                    </a>";
          break;
      }
      echo $editor;
    }
  }

  public function showEditorWitel($model, $t, $stt, $witel){
    $editor_stt = "";
    $approved_stt = "disabled";
    $rejected_stt = "disabled";
    $released_stt = "disabled";
    $notreleased_stt = "disabled";
    $approved_witel = "disabled";
    $rejected_witel = "disabled";

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
      $approved_witel = "";
      $rejected_witel = "";
    } else if($stt == STATUS_NOT_RELEASED){
      $released_stt = "";
    } else if($stt == STATUS_APPROVED_WITEL){
      $rejected_witel = "";
      $editor_stt = "disabled";
    } else if($stt == STATUS_REJECTED_WITEL){
      $approved_witel = "";
      $editor_stt = "";
    }

    $editor = "";
    if($this->view->user != USER){
      switch($this->view->user){
        case ADMIN_UNIT:
          $editor = "<a class='$editor_stt btn-floating btn-small modal-trigger blue darken-3' data-id='$model->id' data-count='$t'>
                      <i class='small material-icons'>edit</i>
                    </a>";
          break;
        case ADMIN_SM:
          $editor = "<a class='$approved_stt btn-floating btn-small green' href='data.php?".$this->view->statusType."&stt=".STATUS_APPROVED."&id=$model->id&t=$t&witel=$witel'>
                      <i class='small material-icons'>done</i>
                    </a> 
                    <!--a class='$rejected_stt btn-floating btn-small red darken-3' href='data.php?".$this->view->statusType."&stt=".STATUS_REJECTED."&id=$model->id&t=$t&witel=$witel'>
                      <i class='small material-icons'>close</i>
                    </a-->
                    <a class='$rejected_stt btn-floating modal-trigger-reject btn-small red darken-3' data-id='$model->id' data-count='$t'>
                      <i class='small material-icons'>close</i>
                    </a>";    
          break;    
        case ADMIN_ALL:
          $editor = "<a class='$released_stt btn-floating btn-small green' href='data.php?".$this->view->statusType."&stt=".STATUS_RELEASED."&id=$model->id&t=$t&witel=$witel'>
                      <i class='small material-icons'>done</i>
                    </a> 
                    <a class='$notreleased_stt btn-floating modal-trigger-nr btn-small red darken-3' data-id='$model->id' data-count='$t'>
                      <i class='small material-icons'>close</i>
                    </a>";
          break;
        case ADMIN_WITEL:
          $editor = "<a class='$approved_witel btn-floating btn-small green' href='data.php?".$this->view->statusType."&stt=".STATUS_APPROVED_WITEL."&id=$model->id&t=$t&witel=$witel'>
                      <i class='small material-icons'>done</i>
                    </a> 
                    <a class='$rejected_witel btn-floating modal-trigger-wit btn-small red darken-3' data-id='$model->id' data-count='$t'>
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
          <tr class='$class'>";
      if($level == $model->len){
        echo "<td class='indent-$level'><a href='?page=detail&id=$model->id&type=$this->type'>".$model->indikator['l_'.$level]."</a></td>";
      } else {
        echo "<td class='indent-$level'>".$model->indikator['l_'.$level]."</td>";
      }
        echo "
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
            <td class='hides center-align $t'>".$model->realisasi[$t]." ";
            if($this->useEvid && $model->realisasi[$t] != ""){
              echo "
                <a class='$class' href='data.php?evid&id=$model->id&type=$model->table'>
                  <i class='small material-icons'>description</i>
                </a>";
            }
            echo "
            </td>";
            if($this->type == "km_witel"){
              if($this->view->user == ADMIN_WITEL){
                $this->witelEditor($model->id, $t, $model->witel);
              }
              if($this->view->user == ADMIN_UNIT){
                $this->editor($model->id, $t, $model->witel);
                // TODO test with ADMIN_UNIT level
              }
              if($this->view->user == ADMIN_SM){
                $this->rejEditor($model->id, $t, $model->witel);
              }
              if($this->view->user == ADMIN_ALL){
                $this->nrEditor($model->id, $t, $model->witel);
              }
            } else {
              if($this->view->user == ADMIN_UNIT){
                $this->editor($model->id, $t);
                // TODO test with ADMIN_UNIT level
              }
              if($this->view->user == ADMIN_SM){
                $this->rejEditor($model->id, $t);
              }
              if($this->view->user == ADMIN_ALL){
                $this->nrEditor($model->id, $t);
              }

            }
        }
        echo "
            <td class='hides center-align $t'>".rounds($ach_all[$t]['ach_show']*100)." %</td>";
        if($level == $model->len){
          echo "
            <td class='hides center-align $t'>";
          if($this->type == "km_witel"){
            $this->showEditorWitel($model, $t, $model->status[$t], $model->witel);
          } else {
            $this->showEditor($model, $t, $model->status[$t]);
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
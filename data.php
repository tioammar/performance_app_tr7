<?php
require_once("modules/Process.php");
require_once("modules/config.php");
require_once("modules/Upload.php");
require_once("modules/Login.php");
require_once("modules/ExcelKM.php");
require_once("modules/ExcelQW.php");
require_once("modules/ExcelKMWitel.php");

session_start();

if(isset($_GET['id']) && isset($_GET['t'])){
  $id = $_GET['id'];
  $t = $_GET['t'];

  if(isset($_GET['statuskm'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $page = $_SESSION['level'] == ADMIN_UNIT ? "admin" : "adminall";
    $process = new Process($id, $t, "km", $_SESSION['unit']);
    $status = $_GET['stt'];
    $unit2 = $_SESSION['level'] == ADMIN_ALL ? $_GET['dest'] : $_SESSION['unit'];
    $message = $status != STATUS_REJECTED ? "" : $_POST['message'];
    if($process->updateStatus($status, $message, $unit2) == QUERY_SUCCESS){
      header("Location: ./?page=$page");
    } else echo "Update Status Failed";
  } 

  if(isset($_GET['updatekm'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $process = new Process($id, $t, "km", $_SESSION['unit']);
    $real = $_POST['real'];
    $upload = new Upload("evidence/km/", $process);
    $unit2 = $_SESSION['level'] == ADMIN_ALL ? $_GET['dest'] : $_SESSION['unit'];
    // $file = $_FILES['evid'];
    // $status = $upload->upload($file);
    $status = UPLOAD_OK;
    if($status == UPLOAD_OK){
      if($process->updateReal($real, $unit2) == QUERY_SUCCESS){
        header("Location: ./?page=admin");
      } else echo "Update Failed";
    }
  }

  if(isset($_GET['statuswit'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $unit2 = $_SESSION['unit'];
    if($_SESSION['level'] == ADMIN_WITEL || $_SESSION['level'] == ADMIN_UNIT){
      $page = "adminwitel";
    } else $page = "adminallwitel";
    
    if($_SESSION['level'] == ADMIN_WITEL || $_SESSION['level'] == ADMIN_ALL){
      $unit2 = $_GET['dest'];
    }
    // $unit2 = $_SESSION['level'] == ADMIN_WITEL ? $_GET['dest'] : $_SESSION['unit'];
    // $unit2 = $_SESSION['level'] == ADMIN_ALL ? $_GET['dest'] : $_SESSION['unit'];
    $process = new Process($id, $t, "km_witel", $unit2);
    $status = $_GET['stt'];
    $witel = $_GET['witel'];
    if($_SESSION['level'] != ADMIN_ALL){
      $message = $status != STATUS_REJECTED ? "" : $_POST['message'];
    } else {
      $message = $status != STATUS_NOT_RELEASED ? "" : $_POST['message'];
    }
    if($process->updateStatusWitel($status, $message, $witel) == QUERY_SUCCESS){
      header("Location: ./?page=$page");
    } else echo "Update Status Failed";
  } 

  if(isset($_GET['updatewit'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $process = new Process($id, $t, "km_witel", $_SESSION['unit']);
    $real = $_POST['real'];
    $witel = $_GET['witel'];
    $upload = new Upload("evidence/km_witel/", $process);
    // $file = $_FILES['evid'];
    // $status = $upload->upload($file);
    $status = UPLOAD_OK;
    if($status == UPLOAD_OK){
      if($process->updateRealWitel($real, $witel) == QUERY_SUCCESS){
        header("Location: ./?page=adminwitel");
      } else echo "Update Failed";
    }
  }

  if(isset($_GET['addsupportwitel'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $process = new Process($id, $t, "support", $_SESSION['unit']); // id as item_id
    $dest = $_POST['unit'];
    $value = $_POST['item'];
    $type = $_POST['type'];
    $item_type = $_GET['type'];
    if($process->addSupportWitel($value, $dest, $type, $item_type) == QUERY_SUCCESS){
      // echo "?page=detail&id=$id&type=$item_type";
      header("Location: ./?page=detail&id=$id&type=$item_type");
    } else {
      echo "Add Support Failed";
    }
  }

  if(isset($_GET['addsupport'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $process = new Process($id, $t, "support", $_SESSION['unit']); // id as item_id
    $dest = $_POST['unit'];
    $value = $_POST['item'];
    $type = $_POST['type'];
    $item_type = $_GET['type'];
    if($process->addSupport($value, $dest, $type, $item_type) == QUERY_SUCCESS){
      // echo "?page=detail&id=$id&type=$item_type";
      header("Location: ./?page=detail&id=$id&type=$item_type");
    } else {
      echo "Add Support Failed";
    }
  }

   if(isset($_GET['addaction'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $process = new Process($id, $t, "actionplan", $_SESSION['unit']); // id as item_id
    $value = $_POST['item'];
    $type = $_GET['type'];
    if($process->addAction($value, $type) == QUERY_SUCCESS){
      header("Location: ./?page=detail&id=$id&type=$type");
    } else {
      echo "Add Action Failed";
    }
  }

   if(isset($_GET['addlesson'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $process = new Process($id, $t, "lesson", $_SESSION['unit']); // id as item_id
    $value = $_POST['item'];
    $type = $_GET['type'];
    if($process->addAction($value, $type) == QUERY_SUCCESS){
      header("Location: ./?page=detail&id=$id&type=$type");
    } else {
      echo "Add Lesson Failed";
    }
  }

  if(isset($_GET['deletesupport'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $process = new Process($id, $t, "support", $_SESSION['unit']);
    $type = $_GET['type'];
    if($process->deleteSupport() == QUERY_SUCCESS){
      header("Location: ./?page=detail&id=$id&type=$type");
    } else echo "Update Status Failed";
  }

  if(isset($_GET['deletelesson'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $process = new Process($id, $t, "lesson", $_SESSION['unit']);
    $type = $_GET['type'];
    if($process->deleteLesson() == QUERY_SUCCESS){
      header("Location: ./?page=detail&id=$id&type=$type");
    } else echo "Delete Failed";
  }

  if(isset($_GET['deleteaction'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $process = new Process($id, $t, "actionplan", $_SESSION['unit']);
    $type = $_GET['type'];
    if($process->deleteAction() == QUERY_SUCCESS){
      header("Location: ./?page=detail&id=$id&type=$type");
    } else echo "Delete Failed";
  }

  if(isset($_GET['statussupport'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $process = new Process($id, $t, "support", $_SESSION['unit']);
    $status = $_GET['stt'];
    $unit2 = $_GET['unit'];
    $message = $status != STATUS_REJECTED? "" : $_POST['message'];
    if($process->updateStatusSupport($status, $message, $unit2) == QUERY_SUCCESS){
      header("Location: ./");
    } else echo "Update Status Failed";
  } 

  if(isset($_GET['statussupportwitel'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $process = new Process($id, $t, "support", $_SESSION['unit']);
    $status = $_GET['stt'];
    $witel = $_GET['unit'];
    $message = $status != STATUS_REJECTED ? "" : $_POST['message'];
    if($process->updateStatusSupportWitel($status, $message, $witel) == QUERY_SUCCESS){
      header("Location: ./");
    } else echo "Update Status Failed";
  } 

  if(isset($_GET['statusqw'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $page = $_SESSION['level'] == ADMIN_UNIT ? "adminqw" : "adminallqw";
    $process = new Process($id, $t, "quickwin", $_SESSION['unit']);
    $status = $_GET['stt'];
    if($_SESSION['level'] != ADMIN_ALL){
      $message = $status != STATUS_REJECTED ? "" : $_POST['message'];
    } else {
      $message = $status != STATUS_NOT_RELEASED ? "" : $_POST['message'];
    }
    $unit2 = $_SESSION['level'] == ADMIN_ALL ? $_GET['dest'] : $_SESSION['unit'];
    if($process->updateStatus($status, $message, $unit2) == QUERY_SUCCESS){
      header("Location: ./?page=$page");
    } else echo "Update Status Failed";
  }

  if(isset($_GET['updateqw'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=dashboard");
    }
    $page = $_SESSION['level'] == ADMIN_UNIT ? "adminqw" : "adminallqw";
    $process = new Process($id, $t, "quickwin", $_SESSION['unit']);
    $real = $_POST['real'];
    $upload = new Upload("evidence/quickwin/", $process);
    $unit2 = $_SESSION['level'] == ADMIN_ALL ? $_GET['dest'] : $_SESSION['unit'];
    // $file = $_FILES['evid'];
    // $status = $upload->upload($file);
    $status = UPLOAD_OK;
    if($status == UPLOAD_OK){
      if($process->updateReal($real, $unit2) == QUERY_SUCCESS){
        header("Location: ./?page=$page");
      } else echo "Update Failed";
    }
  }
} 

  if(isset($_GET['uploadkm'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] != ADMIN_ALL) header("Location: ./?page=dashboard");
    }
    $excel = new ExcelKM($_FILES['excel']);
    if($excel->read() == UPLOAD_OK){
      header("Location: ./?page=adminall");
    } else echo "Upload Failed";
  }  
  
  if(isset($_GET['uploadqw'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] != ADMIN_ALL) header("Location: ./?page=dashboard");
    }
    $excel = new ExcelQW($_FILES['excel']);
    if($excel->read() == UPLOAD_OK){
      header("Location: ./?page=adminallqw");
    } else echo "Upload Failed";
  }  
  
  if(isset($_GET['uploadwit'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=dashboard");
    } else {
      if($_SESSION['level'] != ADMIN_ALL) header("Location: ./?page=dashboard");
    }
    $excel = new ExcelKMWitel($_FILES['excel']);
    if($excel->read() == UPLOAD_OK){
      header("Location: ./?page=adminallwitel");
    } else echo "Upload Failed";
  }

  if(isset($_GET['deletenotif'])){
    $id = $_GET['id'];
    $notification = new Notification(null, null);
    if($notification->delete($id)){
      header("Location: ./?page=notifications");
    } else echo "Delete Failed";
  }

if(isset($_GET["login"])){
  $nik = $_POST['nik'];
  $pass = $_POST['password'];
  $login = new Login($nik, $pass);
  $portal_auth = $login->auth();
  if($portal_auth === NOT_REGISTERED){
    header("Location:./?page=login&status=".NOT_REGISTERED);
  } else if ($portal_auth === WRONG_PASSWORD) {
    header("Location:./?page=login&status=".WRONG_PASSWORD);
  } else if ($portal_auth === NOT_CONNECTED){
    header("Location:./?page=login&status=".NOT_CONNECTED);
  } else {
    // create session
    $user = $login->getUser();
    $_SESSION['nik'] = $user->nik;
    $_SESSION['name'] = $user->name;
    $_SESSION['level'] = $user->level;
    if($user->unit != null){
      $_SESSION['unit'] = $user->unit;
    }
    header("Location:./?page=dashboard");
  }
} 

if(isset($_GET["logout"])){
  unset($_SESSION['nik']);
  unset($_SESSION['name']);
  unset($_SESSION['level']);
  session_destroy();
  header("Location: ./");
}
?>
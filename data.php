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
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
    }
    $page = $_SESSION['level'] == ADMIN_ALL ? "adminall" : "admin";
    $process = new Process($id, $t, "km", $_SESSION['unit']);
    $status = $_GET['stt'];
    $message = $status != STATUS_REJECTED ? "" : $_POST['message'];
    if($process->updateStatus($status, $message) == QUERY_SUCCESS){
      header("Location: ./?page=$page");
    } else echo "Update Status Failed";
  } 

  if(isset($_GET['updatekm'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
    }
    $process = new Process($id, $t, "km", $_SESSION['unit']);
    $real = $_POST['real'];
    $upload = new Upload("evidence/km/", $process);
    // $file = $_FILES['evid'];
    // $status = $upload->upload($file);
    $status = UPLOAD_OK;
    if($status == UPLOAD_OK){
      if($process->updateReal($real) == QUERY_SUCCESS){
        header("Location: ./?page=admin");
      } else echo "Update Failed";
    }
  }

  if(isset($_GET['statuswit'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
    }
    $page = $_SESSION['level'] == ADMIN_ALL ? "adminallwitel" : "adminwitel";
    $process = new Process($id, $t, "km_witel", $_SESSION['unit']);
    $status = $_GET['stt'];
    $witel = $_GET['witel'];
    $message = $status != STATUS_REJECTED ? "" : $_POST['message'];
    if($process->updateStatusWitel($status, $message, $witel) == QUERY_SUCCESS){
      header("Location: ./?page=$page");
    } else echo "Update Status Failed";
  } 

  if(isset($_GET['updatewit'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
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
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
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
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
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
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
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
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
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
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
    }
    $process = new Process($id, $t, "support", $_SESSION['unit']);
    $type = $_GET['type'];
    if($process->deleteSupport() == QUERY_SUCCESS){
      header("Location: ./?page=detail&id=$id&type=$type");
    } else echo "Update Status Failed";
  }

  if(isset($_GET['deletelesson'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
    }
    $process = new Process($id, $t, "lesson", $_SESSION['unit']);
    $type = $_GET['type'];
    if($process->deleteLesson() == QUERY_SUCCESS){
      header("Location: ./?page=detail&id=$id&type=$type");
    } else echo "Delete Failed";
  }

  if(isset($_GET['deleteaction'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
    }
    $process = new Process($id, $t, "actionplan", $_SESSION['unit']);
    $type = $_GET['type'];
    if($process->deleteAction() == QUERY_SUCCESS){
      header("Location: ./?page=detail&id=$id&type=$type");
    } else echo "Delete Failed";
  }

  if(isset($_GET['statussupport'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
    }
    $process = new Process($id, $t, "support", $_SESSION['unit']);
    $status = $_GET['stt'];
    $unit2 = $_GET['unit'];
    $message = $status != STATUS_REJECTED_WITEL ? "" : $_POST['message'];
    if($process->updateStatusSupport($status, $message, $unit2) == QUERY_SUCCESS){
      header("Location: ./");
    } else echo "Update Status Failed";
  } 

  if(isset($_GET['statussupportwitel'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
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
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
    }
    $page = $_SESSION['level'] == ADMIN_ALL ? "adminallqw" : "adminqw";
    $process = new Process($id, $t, "quickwin", $_SESSION['unit']);
    $status = $_GET['stt'];
    $message = $status != STATUS_REJECTED ? "" : $_POST['message'];
    if($process->updateStatus($status, $message) == QUERY_SUCCESS){
      header("Location: ./?page=$page");
    } else echo "Update Status Failed";
  }

  if(isset($_GET['updateqw'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] == USER) header("Location: ./?page=main");
    }
    $process = new Process($id, $t, "quickwin", $_SESSION['unit']);
    $real = $_POST['real'];
    $upload = new Upload("evidence/quickwin/", $process);
    $file = $_FILES['evid'];
    // $status = $upload->upload($file);
    $status = UPLOAD_OK;
    if($status == UPLOAD_OK){
      if($process->updateReal($real) == QUERY_SUCCESS){
        header("Location: ./?page=admin");
      } else echo "Update Failed";
    }
  }
} 

  if(isset($_GET['uploadkm'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] != ADMIN_ALL) header("Location: ./?page=main");
    }
    $excel = new ExcelKM($_FILES['excel']);
    if($excel->read() == UPLOAD_OK){
      header("Location: ./?page=adminall");
    } else echo "Upload Failed";
  }  
  
  if(isset($_GET['uploadqw'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] != ADMIN_ALL) header("Location: ./?page=main");
    }
    $excel = new ExcelQW($_FILES['excel']);
    if($excel->read() == UPLOAD_OK){
      header("Location: ./?page=adminallqw");
    } else echo "Upload Failed";
  }  
  
  if(isset($_GET['uploadwit'])){
    if(!isset($_SESSION['level'])){
      header("Location: ./?page=main");
    } else {
      if($_SESSION['level'] != ADMIN_ALL) header("Location: ./?page=main");
    }
    $excel = new ExcelKMWitel($_FILES['excel']);
    if($excel->read() == UPLOAD_OK){
      header("Location: ./?page=adminallwit");
    } else echo "Upload Failed";
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
    header("Location:./?page=main");
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
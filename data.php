<?php
require_once("modules/Process.php");
require_once("modules/config.php");
require_once("modules/Upload.php");
require_once("modules/Login.php");

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
    $file = $_FILES['evid'];
    $status = $upload->upload($file);
    $status = UPLOAD_OK;
    if($status == UPLOAD_OK){
      if($result = $process->updateReal($real) == QUERY_SUCCESS){
        header("Location: ./?page=admin");
      } else echo "Update Failed";
    }
  }
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
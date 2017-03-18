<?php
require_once("modules/Process.php");
require_once("modules/config.php");
require_once("modules/Upload.php");
require_once("modules/Login.php");

$type = $_GET['type'];
if(isset($_GET['id']) && isset($_GET['t'])){
  $id = $_GET['id'];
  $t = $_GET['t'];
}

if($type == "statuskm"){
  session_start();
  $page = $_SESSION['level'] == ADMIN_ALL ? "adminall" : "admin";
  $process = new Process($id, $t, "km", $_SESSION['unit']);
  $status = $_GET['stt'];
  if($process->updateStatus($status) == QUERY_SUCCESS){
    header("Location: ./?page=$page");
  } else echo "Update Status Failed";
} 

else if($type == "updatekm"){
  session_start();
  $process = new Process($id, $t, "km", $_SESSION['unit']);
  $real = $_POST['real'];
  $upload = new Upload("evidence/km/", $process);
  $file = $_FILES['evid'];
  $status = $upload->upload($file);
  if($status == UPLOAD_OK){
    if($result = $process->updateReal($real) == QUERY_SUCCESS){
      header("Location: ./?page=admin");
    } else echo "Update Failed";
  }
} 

else if($type == "login"){
  session_start();
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

else if ($type == "logout"){
  session_start();
  unset($_SESSION['nik']);
  unset($_SESSION['name']);
  unset($_SESSION['level']);
  session_destroy();
  header("Location: ./");
}

else {
  echo "not found";
}
?>
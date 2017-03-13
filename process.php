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
  $process = new Process($id, $t, "km");
  $status = $_GET['stt'];
  $result = $process->updateStatus($status);
  header("Location: ./?page=admin");
} 

else if($type == "updatekm"){
  $process = new Process($id, $t, "km");
  $real = $_POST['real'];
  $upload = new Upload("evidence/km/", $process);
  $file = $_FILES['evid'];
  $status = $upload->upload($file);
  if($status == UPLOAD_OK){
    $result = $process->updateReal($real);
    header("Location: ./?page=admin");
  }
} 

else if($type == "login"){
  session_start();
  $nik = $_POST['nik'];
  $pass = $_POST['password'];
  $login = new Login($nik, $pass);
  $portal_auth = $login->auth();
  if($portal_auth === 0){
    header("Location:./?page=login&status=".NOT_REGISTERED);
  } else if ($portal_auth === 0.5) {
    header("Location:./?page=login&status=".WRONG_PASSWORD);
  } else if ($portal_auth === 1){
    header("Location:./?page=login&status=".NOT_CONNECTED);
  } else {
    // create session
    $user = $login->getUser();
    $_SESSION['nik'] = $user->nik;
    $_SESSION['name'] = $user->name;
    $_SESSION['level'] = $user->level;
    header("Location:./?page=main");
  }
} 

else {
  echo "not found";
}
?>
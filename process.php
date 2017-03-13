<?php
session_start();
require_once("modules/Process.php");
require_once("modules/config.php");
require_once("modules/Upload.php");

$id = $_GET['id'];
$t = $_GET['t'];
$type = $_GET['type'];

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
  $nik = $_POST['nik'];
  $pass = $_POST['password'];
  $portal_auth = LDAP_auth($nik, $pass);
  if($portal_auth === 0){
    header("Location:./?page=login&status=".NOT_REGISTERED);
  } else if ($portal_auth === 0.5) {
    header("Location:./?page=login&status=".WRONG_PASSWORD);
  } else if ($portal_auth === 1){
    header("Location:./?page=login&status=".NOT_CONNECTED);
  } else {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $Q = "SELECT * FROM user WHERE `nik` = '$nik'";
    $row = $mysqli->query($Q);
    if($r = $row->fetch_array()){
      $_SESSION['nik'] = $r['nik'];
      $_SESSION['name'] = $r['full_name'];
      $_SESSION['level'] = $r['level'];
    } else {
      $_SESSION['nik'] = $nik;
      $_SESSION['name'] = 'Guest';
      $_SESSION['level'] = USER;
    }
    header("Location:./?page=main");
  }
} 

else {
  echo "not found";
}
?>
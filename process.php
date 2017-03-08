<?php
require_once("modules/model/Process.php");
require_once("modules/config.php");

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
  $result = $process->updateReal($real);
  header("Location: ./?page=admin");
} 

else if($type == "evidkm"){

} 

else {
  echo "not found";
}
?>
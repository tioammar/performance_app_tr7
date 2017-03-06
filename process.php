<?php
require_once "modules/model/Process.php";

$id = $_GET['id'];
$tw = $_GET['period'];
$process = new Process($id, $tw);

$type = $_GET['type'];

if($type == "status"){
  $status = $_GET['stt'];
  $result = $process->updateStatus($status);
  $message = "success";
  header("Location: ./?page=admin&stt=$message");
} else if($type == "update"){

} else if($type == "evid"){

} else {
  // show not found
}
?>
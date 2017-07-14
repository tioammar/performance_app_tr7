<?php

require_once("modules/model/Notification.php");

$dest = $session['level'];
$unit = $session['unit'];

$notif = new Notification($unit, null);
$ids = $notif->getAllNotif($dest);
$ids2 = $notif->getAllDest($dest);

$i = 0;
$num = 1;
?>

  <div id='main' class='row'>
    <div class='row card white z-depth-2 contain'>
        <div class='card-content black-text'>
          <table class='bordered'>
          <thead>
            <tr class='black white-text center-align'>
              <td class='center-align'>No.</td>
              <td class='center-align'>Program</td>
              <td class='center-align'>Unit</td>
              <td class='center-align'>Pesan</td>
              <td class='center-align'>Action</td>
            </tr>
          </thead>
          <tbody>
<?php
foreach($ids as $id){
  $notif = $notif->get($id);
  $link = "";
  if($notif->type == "quickwin"){
    $link =  $_SESSION['level'] == ADMIN_UNIT ? "adminqw" : "adminallqw";
  }
  else if($notif->type == "km"){
      $link = $_SESSION['level'] == ADMIN_UNIT ? "admin" : "adminall";
  }
  else if($notif->type == "km_witel"){
      $link = $_SESSION['level'] == ADMIN_UNIT || $_SESSION['level'] == ADMIN_WITEL ? "adminwitel" : "adminallwitel";
  }
  echo "
            <tr>
              <td class='center-align'>$num.</td>
              <td><a href='?page=$link'>$notif->event</td>
              <td class='center-align'>$notif->unit</td>
              <td class='center-align'>$notif->message</td>
              <td class='center-align'>
                <a class='green-text' href='data.php?deletenotif&id=$id'>
                  <i class='small material-icons'>done</i>
                </a>
              </td>
        ";
  $num++;
}

foreach($ids2 as $id2){
  $notif2 = $notif->get($id2);
  echo "
            <tr>
              <td class='center-align'>$num.</td>
              <td>$notif2->event</td>
              <td class='center-align'>$notif2->unit</td>
              <td class='center-align'>$notif2->message</td>
              <td class='center-align'>
                <a class='green-text' href='data.php?deletenotif&id=$id2'>
                  <i class='small material-icons'>done</i>
                </a>
              </td>
        ";
  $num++;
}
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


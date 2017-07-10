<!doctype html>
<?php
  require_once("modules/config.php");
  require_once("modules/model/Notification.php");
  
  session_start();
  $session = $_SESSION;

  if(isset($session['nik'])){
    if(isset($_GET['page'])){
      $page = $_GET['page'];
    } else {
      $page = "main";
    }
  } else {
    $page = 'login';
  }
  // $json = json_encode($_SESSION);
  // echo $json;
  $units = array("CCM", "RWS", "EGBIS", "EnD", "RNO", "ROC", "MSO", "BPP", "PCF", "GA", "HC");
  $witel = array("Makasar", "Sulselbar", "Sulteng", "Gorontalo", "Suma", "Sultra", "Maluku", "Pabar", "Papua");
  // $revenue = array("Consumer", "Wholesale", "EGBIS");
  // $assurance = array("SLG", "GAUL", "Q GGN");
  // $cat = array("Makasar", "Sulselbar", "Sulteng", "Gorontalo", "Sulut & Malut", "Sultra", "Maluku", "Papua Barat", "Papua");

  require_once("helper.php");
  require_once("modules/config.php");
?>
<html>
<head>
  <!-- head here -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
  <link rel="stylesheet" href="css/styles.css"/>
  <title>KM Online TREG 7</title>
</head>
<header>
  <?php
  if($page == "adminall" || $page == "adminwitel" || $page == "adminallqw" || $page == "quickwin" || $page == "adminallwitel"){
    echo "<nav class='nav-extended'>";
  } else {
    echo "<nav>";
  }
  ?>
    <div class="nav-wrapper red">
      <ul class="left">
      <?php
        if(isset($session['nik'])){
          echo "
        <li><a href='#' data-activates='slide-out' class='side-nav-trig black-text'><i class='material-icons left'>menu</i></a></li>";
        }
      ?>
        <li><a class="logo" href="?page=main">Dashboard Kinerja TREG 7</a></li>
      </ul>
      <ul class="right">
        <li><img src="img/woow.png" alt="" class="profile"></li>
        <!--li><img src="img/logo.png" alt="" class="profile"></li-->
      </ul>
      <?php
      if($page == "adminall" || $page == "adminallwitel" || $page == "adminwitel" || $page == "adminallqw" || $page == "quickwin"){
        include "include/tabs/".$page.".php";
      }
      ?>
    </div>
  </nav>
</header>
<body>
  <?php
  if(isset($session['nik'])){
  echo "
  <ul id='slide-out' class='side-nav'>
    <li>
      <div class='userView'>
        <div class='background'>
          <img src='img/office.jpg'>
        </div>
        <a href='#!user'><img class='circle' src='http://pwb-esshr.aon.telkom.co.id/index.php?r=pwbPhoto/profilePhoto&nik=".$session['nik']."&t=1457059388'></a>
        <a href='#!name'><span class='white-text name'>".$session['name']."</span></a>
        <a href='#!email'><span class='white-text email'>".$session['nik']."</span></a>
      </div>
    </li>
    <li><a href='?page=main'>Beranda</a></li>
    <!--li><a href='?page=quadrics'>Quadrics</a></li-->
    <!--li><a href='?page=quickwin'>Quick Win</a></li-->";
    if($session['level'] != USER){
      echo "
    <li><div class='divider'></div></li>";
      switch($session['level']){
        case ADMIN_SM:
          $linkkm = "?page=admin";
          $linkqw = "?page=adminqw";
          $linkwit = "?page=adminwitel";
          break;
        case ADMIN_UNIT:
          $linkkm = "?page=admin";
          $linkqw = "?page=adminqw";
          $linkwit = "?page=adminwitel";
          break;          
        case ADMIN_ALL:
          $linkkm = "?page=adminall";
          $linkqw = "?page=adminallqw";
          $linkwit = "?page=adminallwitel";
          break;          
        case ADMIN_WITEL:
          $linkkm = "";
          $linkqw = "";
          $linkwit = "?page=adminwitel";
          break;
        default:
          $linkkm = "#";
          $linkqw = "#";
      }
      echo "
    <li><a class='subheader'>PIC</a></li>
    <li><a href='$linkkm'>KM Regional</a></li>
    <li><a href='$linkwit'>Witel</a></li>
    <li><a href='$linkqw'>Quick Win</a></li>";
      $notifikasi = new Notification($session['unit'], "program");
      $ids = $notifikasi->getAll($session['level']);
      $count = count($ids);
      echo "
    <li><a href='?page=notifications'><span class='new badge' data-badge-caption=''>$count</span>Notifikasi</a></li>";
    }
    echo "
    <li><div class='divider'></div></li>
    <li><a href='data.php?logout'>Keluar</a></li>
  </ul>";
  }
  ?>
  <!-- main start here -->
  <div class="main">
    <!-- container start here -->
    <?php
      if(file_exists("include/".$page.".php")){
        include "include/$page.php";
      } else {
        include "include/main.php";
      }
    ?>
  </div> <!-- main ends here -->
</body>
<script>
$(document).ready(function(){
  $('.side-nav-trig').sideNav({
      menuWidth: 300, // Default is 240
      edge: 'left', // Choose the horizontal origin
      closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: false // Choose whether you can drag to open on touch screens
    }
  );
  $('ul.tabs').tabs();
  $('select').material_select();
});
</script>
<script type="text/javascript" src="js/script.js"></script>
</html>
<!doctype html>
<?php
  if(isset($_GET['page'])){
    $page = $_GET['page'];
  } else {
    $page = "main2";
  }
  // $units = array("CCM", "RWS", "EGBIS", "EnD", "RNO", "ROC", "MSO", "BPP", "PCF", "GA", "HC");
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
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <!-- script type="text/javascript" src="js/chartist.min.js"></script>
  <script type="text/javascript" src="js/chartist-plugin-tooltip.min.js"></script-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
  <!-- link rel="stylesheet" href="css/chartist.min.css"/>
  <link rel="stylesheet" href="css/chartist-plugin-tooltip.css"/-->
  <link rel="stylesheet" href="css/styles.css"/>
  <title>KM Online TREG 7</title>
</head>
<header>
  <?php
  if($page != "main2"){
    echo "<nav class='nav-extended'>";
  } else {
    echo "<nav>";
  }
  ?>
    <div class="nav-wrapper red">
      <ul class="left">
        <li><a href="#" data-activates="slide-out" class="side-nav-trig black-text"><i class="material-icons left">menu</i></a></li>
        <li><a class="logo" href="?page=main">KM Online TREG 7</a></li>
      </ul>
      <ul class="right">
        <li><img src="img/woow.png" alt="" class="profile"></li>
        <!--li><img src="img/logo.png" alt="" class="profile"></li-->
      </ul>
      <?php
      if($page != "main2"){
        include "include/tabs/".$page.".php";
      }
      ?>
    </div>
  </nav>
</header>
<body>
  <ul id="slide-out" class="side-nav">
    <li>
      <div class="userView">
        <div class="background">
          <img src="img/office.jpg">
        </div>
        <a href="#!user"><img class="circle" src="img/profile.jpg"></a>
        <a href="#!name"><span class="white-text name">Aditya Amirullah</span></a>
        <a href="#!email"><span class="white-text email">920153</span></a>
      </div>
    </li>
    <li><a href="?page=main">Beranda</a></li>
    <li><div class="divider"></div></li>
    <li><a href="?page=signout">Keluar</a></li>
  </ul>
  <!-- main start here -->
  <div class="main">
    <!-- container start here -->
    <?php
      if(file_exists("include/".$page.".php")){
        include "include/".$page.".php";
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
</html>

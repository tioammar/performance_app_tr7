<ul class='tabs tabs-transparent'>
<?php
$i = 0; 
$menus = array('quickwin', 'km_witel');
foreach($menus as $type){
  switch($type){
    case "quickwin":
      $name = "Quick Win";
      break;
    case "km_witel":
      $name = "KM Witel";
      break;
  }
  if($i == 0){
    echo "<li class='tab col s3'><a class='active' href='#$type'>$name</a></li>";
  } else {
    echo "<li class='tab col s3'><a href='#$type'>$name</a></li>";
  }
  $i++;
}
?>
</ul>
<ul class='tabs tabs-transparent'>
<?php 
for($wit=0; $wit < count($witel); $wit++){
  $div = getWitelId($witel[$wit]);
  if($wit == 0){
    echo "<li class='tab col s3'><a class='active' href='#".$div."'>".$witel[$wit]."</a></li>";
  } else {
    echo "<li class='tab col s3'><a href='#".$div."'>".$witel[$wit]."</a></li>";
  }
}
?>
</ul>
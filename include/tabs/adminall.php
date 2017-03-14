<ul class='tabs tabs-transparent'>
<?php
$i = 0; 
foreach($units as $unit_name){
  if($i == 0){
    echo "<li class='tab col s3'><a class='active' href='#$unit_name'>$unit_name</a></li>";
  } else {
    echo "<li class='tab col s3'><a href='#$unit_name'>$unit_name</a></li>";
  }
  $i++;
}
?>
</ul>
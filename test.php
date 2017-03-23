 <?php

    $bobot = "";
    $target = "";
    $real = "";
    $count = 12;
    $table = "km";
    $r = 1;

    while($r <= $count){
      $bobot .= "bobot_$r, ";
      $target .= "target_$r, ";
      $real .= "real_$r,";
      $r++;
    }

    $insertQuery = $bobot.$target.$real;
    $rows = 2;
    for($row = 2; $row <= $rows; $row++){
      $i = 0;
      $Q = "INSERT INTO $table (l_1,l_2,l_3,l_4,$insertQuery unit,satuan,tahun) VALUES (
              '$i','".($i+1)."', '".($i+2)."','".($i+3)."',";
      $b = 1;
      $bv = $i + 3;
      $vbobot = "";
      while($b <= $count){
        $vb = $bv + $b;
        $vbobot .= $vb.",";
        $b++;
      }

      $t = 1;
      $tv = $vb;
      $vtarget = "";
      while($t <= $count){
        $vt = $tv + $t;
        $vtarget .= "'$vt',";
        $t++;
      }

      $r = 1;
      $rv = $vt;
      $vreal = "";
      while($r <= $count){
        $vr = $rv + $r;
        $vreal .= "'$vr',";
        $r++;
      }

      $Q1 = $vbobot.$vtarget.$vreal;
      $Q2 = $Q.$Q1."'".($vr+1)."','".($vr+2)."','".($vr+3)."')";
      // if($mysqli->query($Q2)){
      //   return bla
      // } else {
      //   return UPLOAD_NOK;
      // }
      echo $Q2;
    }
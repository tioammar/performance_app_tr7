<div class='card login'>
  <div class='center-align'><img src='img/woow-2.png' class='login-logo center-align'></div>
  <form action='process.php?type=login' method='post'>
    <input id='nik' type='text' name='nik'  placeholder='NIK'>
    <input id='password' type='password' name='password'  placeholder='Password' autocomplete='new-password'>
  <?php
  if(isset($_GET['status'])){
  echo "
    <div class='chip'>
      Username atau password salah!
    </div>";
  }
  ?>
    <button type='submit' class='btn grey darken-3 right'>Masuk</button>
  </form>
</div>
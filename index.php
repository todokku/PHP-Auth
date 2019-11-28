  <?php
  // if (empty($_SESSION['csrf_token'])) {
  //
  //     // get suspect IP then send to owner
  //     $_SERVER['HTTP_X_FORWARDED_FOR'];
  //     $_SERVER['REMOTE_ADDR'];
  //     $_SERVER['HTTP_CLIENT_IP'];
  //     $suspect = $_SERVER['HTTP_CLIENT_IP'] ? $_SERVER['HTTP_CLIENT_IP'] : ($_SERVER['HTTP_X_FORWARDED_FOR'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);
  //
  //     header('location:../index.php?security+error');
  //     exit();
  // }

  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }

  $_SESSION['type']='null';
	//  $_SESSION['userName']='laclairs';
  // session_unset();
  ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Complete-Login-System</title>
    <link rel="stylesheet" href="assets/css/reset-style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body>
    <header>
        <nav>
          <a class="nav-brand ml-3 mt-3 d-none d-md-inline-block" href="">Lorem Ipsum</a>
          <?php
          if (isset($_SESSION['userName']) && !empty($_SESSION['userName'])) {
              echo '<button class="btn btn-primary float-right mr-4 mt-4" onclick="settingsBtn()">Settings</button>';
          } else {
              echo '<button class="btn btn-primary float-right mr-4 mt-4" onclick="loginBtn()">Login</button>';
          }
           ?>
        </nav>
    </header>
    <hr>

    <main>
      <?php

      if (isset($_SESSION['formMsg'])) {
          ?>
        <div class="alert-box">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <?php
          echo $_SESSION['formMsg'];
          unset($_SESSION['formMsg']); ?>
        </div>
        <?php
      }
        ?>

    <div class="main-container">

    <div class="container">
    <!--***********************
    			MAIN
    	***********************-->
    		<section id="main-section">
        </section>
    <?php


    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    if ($_SESSION['type'] == 'pos1') {
        include_once 'pos1.layout.php';
    } elseif ($_SESSION['type'] == 'pos2') {
        include_once 'pos2.layout.php';
    } elseif ($_SESSION['type'] == 'pos3') {
        include_once 'pos3.layout.php';
    } else {
        if (isset($_SESSION['userName']) && !empty($_SESSION['userName'])) {
            include_once 'view/profile.layout.php';
            include_once 'view/settings.layout.php';
        } else {
            include_once 'view/register.layout.php';
            include_once 'view/login.layout.php';
        }
    }

   ?>

</div>
  </main>
</div>
  <footer>
    <div class="card text-center">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title">  Lorem ipsum dolor sit amet, consectetur adipisicing elit</h5>
    <p class="card-text">Wsed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in  in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <a href="#" class="btn btn-primary">reprehenderit</a>
  </div>
  <div class="card-footer text-muted">
    <p>
      Copyright &copy; <?php echo date('Y'); ?> Copyright Holder All Rights Reserved.
    </p>
  </div>
</div>

  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>


</html>

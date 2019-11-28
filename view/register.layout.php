<!--***********************
      REGISTER FORM
  ***********************-->
<section id="register-section">
  <div class="jumbotron">
    <h2 class="text-center">REGISTER HERE!</h2>
    <div class="msg-box">

      <?php
      if (isset($_SESSION['formMsg'])) {
          echo $_SESSION['formMsg'];
          unset($_SESSION['formMsg']);
      }
       ?>
    </div>
    <form id="register-form" action="route/account.route.php" method="post">
      <!-- CSRF -->
      <?php
      echo ' <input class="csrf" type="hidden" name="csrf_token" value="', $_SESSION['csrf_token'] , ' "/> ';
       ?>
      <div class="form-group">
        <label> Username:</label>
        <input  type="text" class="form-control reg-form-userName" name="userName"  placeholder="Username" required="required"/>
      </div>
      <div class="form-group">
        <label>Email:</label>
        <input class="form-control reg-form-email" type="email" name="userEmail" placeholder="Email" required="required"/>
      </div>
      <div class="form-group">
        <label>Password:</label>
        <input class="form-control reg-form-pwd" type="password" name="userPwd" placeholder="Password" required="required"/>
      </div>
      <div class="form-group">
        <label>Confirm Password:</label>
        <input class="form-control reg-form-rePwd" type="password" name="reUserPwd" placeholder="Confirm Password" required="required"/>
      </div>
      <div class="form-group form-check">
        <span class="col-sm-3">By clicking Register, you agree to our <a href="#">Terms & Policy</a>.You may receive Notifications from us and can opt out any time.</span>
      </div>
      <button class="btn btn-primary btn-block reg-form-submit" type="submit">
        <input class="reg-submit-type" type="hidden" name="submitType" value="register"/>Register
      </button>
    </form>
  </div>

</section>

<!--***********************
      FORGOT FORM
  ***********************-->
<section id="forgot-section">
  <div class="container">
    <h2>FORGOT FORM</h2>
    <form class="" action="routes/serve.route.php" method="post">
      <!-- CSRF -->
      <?php
      echo ' <input type="hidden" name="csrf_token" value="',$_SESSION['csrf_token'],'"/> ';
       ?>
      <input type="email" name="userEmail" placeholder="Email" required="required"/>
      <button type="submit" name="forgot">Submit</button>
      </form>
  </div>
</section>

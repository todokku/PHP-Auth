<section class="settings-section">

	<!--***********************
					LOGIN FORM
		***********************-->
	<div id="settings-modal" class="modal px-5 py-5 overflow-auto zoomIn" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<!-- HEADER CONTAINER -->
				<div class="modal-header">
					<div class="login-img-container">
						<h2 class="text-center"> Settings</h2>
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" title="Close" onclick="document.getElementById('settings-modal').style.display='none'">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<!-- MAIN CONTAINER -->
				<div class="modal-body">
					<!--***********************
							CHANGE PASSWORD FORM
						***********************-->
					<section id="change-password-section">
						<b>CHANGE PASSWORD FORM</b>
						<div class="msg-box">

							<?php
                      if (isset($_SESSION['formMsg'])) {
                          echo $_SESSION['formMsg'];
                          unset($_SESSION['formMsg']);
                      }
                       ?>
						</div>
						<form id="change-password-form" action="route/account.route.php" method="post">
							<!-- CSRF -->
							<?php
                echo ' <input type="hidden" name="csrf_token" value="',$_SESSION['csrf_token'],'"/>
											<input type="hidden" name="userName" value="',$_SESSION['userName'],'"/>';
              ?>

							<div class="form-group">
								<input class="form-control sett-form-oldPwd" type="password" name="oldUserPwd" placeholder="Old Password" required="required"/>
							</div>
							<div class="form-group">
								<input class="form-control sett-form-newPwd" type="password" name="userPwd" placeholder="New Password" required="required"/>
							</div>
							<div class="form-group">
								<input class="form-control sett-form-reNewPwd" type="password" name="reUserPwd" placeholder="New Re-password" required="required"/>
							</div>
							<div class="form-group">
								<button class="btn btn-primary sett-form-submit" type="submit">Update
									<input type="hidden" name="submitType" value="update"/>
								</button>
								<button type="button" class="btn btn-danger float-right" data-dismiss="modal" onclick="document.querySelector('#settings-modal').style.display='none'">Close</button>
							</div>

						</form>
					</section>
				</div>

				<!-- FOOTER CONTAINER -->
				<div class="modal-footer">
					<!--***********************
									DELETE FORM
							***********************-->

					<section id="delete-section">
						<b>Want To Disconnect?</b>
						<form id="delete-form" action="route/account.route.php" method="post">
							<?php
              	echo ' <input type="hidden" name="csrf_token" value="',$_SESSION['csrf_token'],'"/>
											<input type="hidden" name="userName" value="',$_SESSION['userName'],'"/>';
          	  ?>
							<button class="btn btn-danger del-form-submit" type="submit">Delete Account
								<input type="hidden" name="submitType" value="delete"/>
							</button>
						</form>
					</section>
				</div>

			</div>
		</div>
	</div>
</section>

		<!--***********************
					LOGIN FORM
			***********************-->
		<section id="login-section">

			<div id="login-modal" class="modal overflow-auto px-5 py-5 zoomIn" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<!-- HEADER CONTAINER -->
						<div class="modal-header ">
							<div class="login-img-container">
								<img src="assets/img/undraw_authentication_fsn5.svg" alt="Avatar" class="login-avatar" />
								<h2 class="text-center"> Login Here!</h2>
							</div>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" title="Close" onclick="document.querySelector('#login-modal').style.display='none'">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<!-- MAIN CONTAINER -->
						<div class="modal-body">
							<div class="msg-box">
								<?php
                                if (isset($_SESSION['formMsg'])) {
                                    echo $_SESSION['formMsg'];
                                    unset($_SESSION['formMsg']);
                                }
                                 ?>
							</div>
							<form id="login-form" class="login-modal-content zoomIn" action="route/account.route.php" method="post">

								<!-- CSRF -->
								<?php
                    echo ' <input class="csrf-token" type="hidden" name="csrf_token" value="',$_SESSION['csrf_token'],'"/> ';
                ?>

								<div class="form-group">
									<label>Username or Email:</label>
									<input class="form-control" type="text" placeholder="Username or Email.." name="userName"  required="required"/>
								</div>
								<div class="form-group">
									<label>Password:</label>
									<input class="form-control" type="password" placeholder="Password" name="userPwd" required="required"/>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="login-check">
									<label class="form-check-label" for="login-check">remember me</label>
								</div>

								<div class="form-group">
									<span class="login-forgot">Forgot <a href="#">Username or Password?</a></span>
								</div>
						</div>

						<!-- FOOTER CONTAINER -->
						<div class="modal-footer d-flex justify-content-between">
							<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="document.querySelector('#login-modal').style.display='none'">Close</button>
							<button class="btn btn-primary login-form-submit">
								<input type="hidden" name="submitType" value="login"/>Login
							</button>

						</div>
						</form>

					</div>
				</div>
			</div>

		</section>

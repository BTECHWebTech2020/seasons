<?php
require_once('includes/header.php');
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['address']) && isset($_POST['postal_code']) && isset($_POST['level'])) {
	$first_name = get_post($con, 'first_name');
	$last_name = get_post($con, 'last_name');
	$address = get_post($con, 'address');
	$post_code = get_post($con, 'postal_code');
	$email = get_post($con, 'email');
	$level = get_post($con, 'level');
	$password = get_post($con, 'password');
	
	$token = password_hash($password, PASSWORD_DEFAULT);
	
	$query = "INSERT INTO users (first_name, last_name, address, post_code, email, password, level, reg) VALUES('$first_name', '$last_name', '$address', '$post_code', '$email', '$token', '$level', CURRENT_TIMESTAMP)";
	$result = mysqli_query($con, $query);
	if (!$result) {
		if (mysqli_errno($con) == 1062) {
			echo "<div class='container message'>";
		echo "<p class='error'>The e-mail address: <strong>" . $email . "</strong> is already registered, please login or use a different e-mail address.</p></div>";
		require_once ('includes/footer.php');
		die();
		}
		else 
		echo "<p class='error'>Couldn't register user: " . mysqli_error($con) . ".</p>";
		
	}
	if ($result) {
		echo "<div class='container message'><p class='welcome'>Welcome to our example website " . $first_name . " " . $last_name . ". Please login to access your personal content.</p></div>";
		require_once ('includes/footer.php');
		die();
	}
}
?>
	<main role="main">
		<fieldset>
			<legend>
				<h2>User Registration</h2></legend>
			<form class="needs-validation" novalidate method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				<div class="form-row">
					<div class="col-md-6 mb-4">
						<label for="validationCustom01">First name</label>
						<input type="text" class="form-control" id="validationCustom01" placeholder="First name" name="first_name" required>
                        <!--Message to be generated when the field is filled in correctly-->
						<div class="valid-feedback"> Looks good! </div>
					</div>
					<div class="col-md-6 mb-4">
						<label for="validationCustom02">Last name</label>
						<input type="text" class="form-control" id="validationCustom02" placeholder="Last name" name="last_name" required>
                        <!--Message to be generated when the field is filled in correctly-->
						<div class="valid-feedback"> Looks good! </div>
					</div>
					<div class="form-row">
						<div class="col-md-6 mb-4">
							<label for="validationCustomUsername">E-Mail</label>
                            <!--This class allows for a small textbox to be appended to the field. It is an input group because it has two different fields, the prepend showing the @ sign and the actual email input field. The last div shows the message to be displayed if the input is not an e-mail-->
							<div class="input-group">
								<div class="input-group-prepend"> <span class="input-group-text" id="inputGroupPrepend">@</span> </div>
								<input type="email" class="form-control" id="validationCustomUsername" placeholder="email" aria-describedby="inputGroupPrepend" name="email" required>
								<div class="invalid-feedback"> Please enter a valid e-mail address. </div>
							</div>
						</div>
						<div class="col-md-6 mb-4">
							<label for="validationCustomPasword">Password</label>
                            <!--This class allows for a small textbox to be appended to the field. It is an input group because it has two different fields, the prepend showing the ? sign and the actual password input field. The last div shows the message to be displayed if the input is not valid-->
							<div class="input-group">
								<input type="password" class="form-control" id="validationCustomPassword" placeholder="Your Password" aria-describedby="inputGroupPrepend" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
								<div class="invalid-feedback"> Please enter a valid password. </div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
						<label for="validationCustom03">Address</label>
						<input type="text" class="form-control" id="validationCustom03" placeholder="Street name and number" name="address" required>
                        <!--Message to be generated when the field is filled in incorrectly-->
						<div class="invalid-feedback"> Please provide a valid address. </div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustom05">Postal Code</label><br>
						<?php
						$query = "SELECT * FROM post_codes ORDER BY post_code";
						$result = mysqli_query($con, $query);
						if (!$result) die(mysqli_error($con));

						$rows = mysqli_num_rows($result);
						if ($rows > 0) {
						echo "<select id='postal_code' name='postal_code' class='custom-select mr-sm-2'>";
						echo "<option value=''>Select a postal code</option>";
						while($row = mysqli_fetch_assoc($result)) {
							echo "<option value='" . $row['post_code'] . "'>" . $row['post_code'] . " " . $row['city'] . "</option>";
						}
						echo "</select>";
					}
					mysqli_close($con);
					?>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustom06"> &nbsp;</label>
						<input type="text" class="form-control" id="show_city" placeholder="Postal Code" name="show_city" onclick="checkPostCode()" required disabled>
						<div class="invalid-feedback"> Please select a valid postal code. </div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-2 mb-3">
						<label>I prefer: </label>
					</div>
					<div class="col-md-2 mb-3">
						<label>Spring</label>
						<input type="radio" value="1" name="level" checked="checked">
					</div>
					<div class="col-md-2 mb-3">
						<label>Summer</label>
						<input type="radio" value="2" name="level">
					</div>
					<div class="col-md-2 mb-3">
						<label>Autumn</label>
						<input type="radio" value="3" name="level">
					</div>
					<div class="col-md-2 mb-3">
						<label>Winter</label>
						<input type="radio" value="4" name="level">
					</div>
				</div>
				<!--Adds a checkbox that the user has to check to be able to register-->
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck"> Agree to <a href="#" id="terms">terms and conditions</a> </label>
                    <div class="invalid-feedback"> You must agree before submitting. </div>
                </div>
            </div>
				<button class="btn btn-primary" type="submit">Submit form</button>
			</form>
		</fieldset>
	</main>
	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function () {
			'use strict';
			window.addEventListener('load', function () {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.getElementsByClassName('needs-validation');
				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function (form) {
					form.addEventListener('submit', function (event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
					}, false);
				});
			}, false);
		})();
		var select = document.getElementById('postal_code');
		var input = document.getElementById('show_city');
		select.onchange = function() {
			input.value = select.value;
		}
	</script>
	<?php

function get_post($con, $var) {
	return mysqli_real_escape_string($con, $_POST[$var]);
}
require_once('includes/footer.php');
?>
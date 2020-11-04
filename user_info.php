<?php
require_once('includes/header.php');

if (!isset($_SESSION['user_id'])) {
	echo "<p class='intro t15'>You are not authorized to access this content. Please login.</p>";
}
if (isset($_SESSION['user_id']) && isset($_SESSION['level'])) {
	$user_id = $_SESSION['user_id'];
	$query = "SELECT * FROM users WHERE user_id = '$user_id'";
	$result = mysqli_query($con, $query);
	if (!$result) {
		echo "<p class='error'>There was an error on your request: " . mysqli_error($con) . "</p>";
		require_once('includes/footer.php');
		die();
	}
	if ($result) {
		$rows = mysqli_num_rows($result);
		while ($row = mysqli_fetch_assoc($result)) {
			$user_id = $row['user_id'];
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$address = $row['address'];
			$post_code = $row['post_code'];
			$email = $row['email'];
			$level = $row['level'];
			$password = $row['password'];
			
			$token = password_hash($password, PASSWORD_DEFAULT);
			?>
<main role="main">
		<fieldset>
			<legend>
				<h2>User Update</h2></legend>
			<form class="needs-validation" novalidate method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				<div class="form-row">
					<div class="col-md-6 mb-4">
						<label for="validationCustom01">First name</label>
						<input type="text" class="form-control" value="<?php echo $first_name; ?>" placeholder="First name" name="first_name" required>
					</div>
					<div class="col-md-6 mb-4">
						<label for="validationCustom02">Last name</label>
						<input type="text" class="form-control" value="<?php echo $last_name; ?>" placeholder="Last name" name="last_name" required>
					</div>
					<div class="form-row">
						<div class="col-md-6 mb-4">
							<label for="validationCustomUsername">E-Mail</label>
							<div class="input-group">
								<div class="input-group-prepend"> <span class="input-group-text" id="inputGroupPrepend">@</span> </div>
								<input type="email" class="form-control" value="<?php echo $email; ?>" placeholder="email" aria-describedby="inputGroupPrepend" name="email" required>
							</div>
						</div>
						<div class="col-md-6 mb-4">
							<label for="validationCustomPasword">Password</label>
							<div class="input-group">
								<input type="password" class="form-control" id="validationCustomPassword" placeholder="Your Password" aria-describedby="inputGroupPrepend" name="password" required>
								<div class="invalid-feedback"> Please enter a valid password. </div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
						<label for="validationCustom03">Address</label>
						<input type="text" class="form-control" id="validationCustom03" placeholder="Street name and number" name="address" value="<?php echo $address; ?>" required>
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
							if($row['post_code'] == $post_code) {
								$select = "selected";
							}
							else {
								$select = '';
							}
							echo "<option value='" . $row['post_code'] . "'" . $select . ">" . $row['post_code'] . " " . $row['city'] . "</option>";
						}
						echo "</select>";
					}
					?>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustom06"> &nbsp;</label>
						<input type="text" class="form-control" id="show_city" placeholder="Postal Code" name="show_city" onclick="checkPostCode()" value="<?php echo $post_code; ?>" required disabled>
						<div class="invalid-feedback"> Please select a valid postal code. </div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-2 mb-3">
						<label>I prefer: </label>
					</div>
					<div class="col-md-2 mb-3">
						<label>Spring</label>
						<input type="radio" value="1" name="level" 
							   <?php 
						if($level == 1) { 
							$check = "checked";
						} else {
							$check = "";
						} echo $check; ?>>
					</div>
					<div class="col-md-2 mb-3">
						<label>Summer</label>
						<input type="radio" value="2" name="level"
							   <?php 
						if($level == 2) { 
							$check = "checked";
						} else {
							$check = "";
						} echo $check; ?>>
					</div>
					<div class="col-md-2 mb-3">
						<label>Autumn</label>
						<input type="radio" value="3" name="level"
							   <?php 
						if($level == 3) { 
							$check = "checked";
						} else {
							$check = "";
						} echo $check; ?>>
					</div>
					<div class="col-md-2 mb-3">
						<label>Winter</label>
						<input type="radio" value="4" name="level"
							   <?php 
						if($level == 4) { 
							$check = "checked";
						} else {
							$check = "";
						} echo $check; ?>>
					</div>
				</div>
				<div class="form-group">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
						<label class="form-check-label" for="invalidCheck"> I confirm that I want to update my profile. </label>
						<div class="invalid-feedback"> You must agree before submitting. </div>
					</div>
				</div>
				<button class="btn btn-primary" type="submit" name="update">Submit form</button>
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
					}
	}
}
require_once('includes/footer.php');

if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['postal_code']) && isset($_POST['level'])) {
	$first_name = get_post($con, 'first_name');
	$last_name = get_post($con, 'last_name');
	$address = get_post($con, 'address');
	$post_code = get_post($con, 'postal_code');
	$email = get_post($con, 'email');
	$level = get_post($con, 'level');
	$password = get_post($con, 'password');
	
	$token = password_hash($password, PASSWORD_DEFAULT);
	
	$query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$token', address = '$address', post_code = '$post_code', level = '$level', reg = CURRENT_TIMESTAMP WHERE user_id = $user_id";
	$result = mysqli_query($con, $query);
	if (!$result) {
		echo "<p class='error'>Couldn't update user: " . mysqli_error($con) . ".</p>";
		require_once('includes/footer.php');
		die();
		
	}
	if ($result) {
		echo "<div class='container message'><p class='welcome'>" .$first_name . " " . $last_name . " your profile has been updated.</p></div>";
		$_SESSION['level'] = $level;
		require_once ('includes/footer.php');
		die();
	}
}

function get_post($con, $var) {
	return mysqli_real_escape_string($con, $_POST[$var]);
}
?>
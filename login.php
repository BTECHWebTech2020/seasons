<?php
require_once('includes/header.php');
if (isset($_SESSION['user_id'])) {
	echo "<p class='intro t15'>You are already logged in. Select your favorite season from the menu.</p>";
	require_once('includes/footer.php');
	die();
	
}
if (isset($_POST['email']) && isset($_POST['password'])) {
	$email_temp = $_POST['email'];
	$pwd_temp = $_POST['password'];
	
	$query = "SELECT * FROM users WHERE email = '$email_temp'";
	$result = mysqli_query($con, $query);
	if (!$result){
		echo mysql_errno($con);
		die();
	}
	if ($result) {
		while ($row = mysqli_fetch_assoc($result)) {
			$user_id = $row['user_id'];
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$email = $row['email'];
			$password = $row['password'];
			$level = $row['level'];
			
			$token = (password_verify($pwd_temp, $password));
			if ($token == $password) {
				$_SESSION['user_id'] = $user_id;
				$_SESSION['level'] = $level;

				echo "<div class='container message'><p class='welcome'>Welcome " . $first_name . " " . $last_name . ", you are now logged in.</p></div>";
				require_once('includes/footer.php');
				die();
			} 
				if ($token != $password) {
					echo "<div class='container message'><p class='error'>Invalid username/password combination.</p></div>"; // This is triggered if the password fails
					echo "<p class='error'>Please register or try again.</p>";
					require_once('includes/footer.php');
					die();
					
				}
			}
				echo "<div class='container message'><p class='error'>Invalid username/password combination.</p></div>"; // This is triggered if the password fails
					echo "<p class='error'>Please register or try again.</p>";
					require_once('includes/footer.php');
					die();
			}

		}
?>
	<main role="main">
		<div class="container">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				<div class="form-group row">
					<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
					</div>
				</div>
				<div class="form-group row">
    				<div class="col-sm-10">
      				<button type="submit" class="btn btn-primary">Login</button>
    				</div>
  				</div>
			</form>
		</div>
	</main>
	<?php
require_once('includes/footer.php');
?>
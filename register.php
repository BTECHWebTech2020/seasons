<?php
require_once('includes/header.php');
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['address']) && isset($_POST['postal_code']) && isset($_POST['level'])) {
    $first_name = get_post($con, 'first_name');
    $last_name = get_post($con, 'last_name');
    $email = get_post($con, 'email');
    $address = get_post($con, 'address');
    $post_code = get_post($con, 'postal_code');
    $level = get_post($con, 'level');
    $password = get_post($con, 'password');
    
    $token = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users(first_name, last_name, address, post_code, email, password, level, reg) VALUES('$first_name', '$last_name', '$address', '$post_code', '$email', '$token', '$level', CURRENT_TIMESTAMP)";
    $result = mysqli_query($con, $query);
    if (!$result) {
        if (mysqli_errno($con) == 1062) {
            echo "<div class='container message'>";
            echo "<p class='error'>The e-mail address: <strong>" . $email . "</strong> is already registered, please login or use a different e-mail address.</p></div>";
            require_once('includes/footer.php');
            die();
        }
        else echo "<p class='error'>Could not register user: " . mysqli_error($con) . ".</p>";
    }
    if ($result) {
        echo "<div class='container message'><p class='welcome'>Welcome to our example website " . $first_name . " " . $last_name . ". Please login to access your personal content.</p></div>";
        require_once('includes/footer.php');
        die();
    }
}
?>

<main role="main">
    <fieldset>
        <legend>User Registration</legend>
        <form class="needs-validation" novalidate method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-row">
                <div class="col-md-6 mb-4">
                    <label for="validationCustom01">First name</label>
                    <input type="text" class="form-control" id="validationCustom01" placeholder="First name" name="first_name" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label for="validationCustom02">Last name</label>
                    <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" name="last_name" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-4">
                    <label for="validationCustomUsername">E-mail</label>
                    <input type="email" class="form-control" id="validationCustomUsername" placeholder="@" name="email" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label for="validationCustomPassword">Password</label>
                    <input type="password" class="form-control" id="validationCustomPassword" placeholder="password" name="password" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Address</label>
                    <input type="text" class="form-control" id="validationCustom03" placeholder="Street name and number" name="address" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">Postal Code</label><br>
                    <?php
                    $query="SELECT * FROM post_codes ORDER BY post_code";
                    $result = mysqli_query($con, $query);
                    if (!$result) die (mysqli_error($con));
                    $rows = mysqli_num_rows($result);
                    if ($rows > 0){
                        echo "<select id='postal_code' name='postal_code' class='custom_select mr-sm-2'>";
                        echo "<option value=''>Select a postal code</option>";
                        while ($row=mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['post_code'] . "'>" . $row['post_code'] . " " . $row['city'] . "</option>";
                        }
                        echo "</select>";
                    } 
                    mysqli_close($con);
                    ?>
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
            <div class="form-row">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>




        </form>

    </fieldset>

</main>

<?php
function get_post($con,$var) {
    return mysqli_real_escape_string($con, $_POST[$var]);
}

require_once('includes/footer.php');
?>
<?php
require_once('includes/header.php');

if (!isset($_SESSION['user_id'])) {
	echo "<p class='intro autumn t15'>You are not authorized to access this content. Please login.</p>";
}
if (isset($_SESSION['user_id']) && isset($_SESSION['level'])) {
$user_id = $_SESSION['user_id'];
$level = $_SESSION['level'];

if ($level != 3) {
	echo "<p class='intro autumn t15'>Autumn is not you favorite season. You cannot access this content.</p>";
	require_once('includes/footer.php');
	die();
}
	if ($level == 3) {
?>
	<main role="main">
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron jumbotron-autumn">
			<div class="container jumbo">
				<h1 class="display-3 text-center">AUTUMN</h1> </div>
		</div>
		<div class="container">
			<!-- Example row of columns -->
			<div class="row">
				<div class="col-md-12">
				<p class="intro">So you prefer Autumn?<br> Here are a few quotes and images to make your day.</p>
				</div>		
			</div>
			<div class="row">
				<div class="col-md-4">
					<blockquote class="blockquote">Autumn is a second spring when every leaf is a flower.
					</blockquote>
					<p>Albert Camus</p>
				</div>
				<div class="col-md-4">
					<blockquote class="blockquote">When autumn darkness falls, what we will remember are the small acts of kindness: a cake, a hug, an invitation to talk, and every single rose. These are all expressions of a nation coming together and caring about its people.
					</blockquote>
					<p>Jens Stoltenberg</p>
				</div>
				<div class="col-md-4">
					<blockquote class="blockquote">Shopping for clothes is time consuming, it's tiring, and it can feel like a waste of an autumn afternoon.
					</blockquote>
					<p>Rumaan Alam</p>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-3">
					<img src="images/fall1.jpg" alt="Fall/Autumn" class="img-thumbnail">
				</div>
				<div class="col-md-3">
					<img src="images/fall2.jpg" alt="Fall/Autumn" class="img-thumbnail">
				</div>
				<div class="col-md-3">
					<img src="images/fall3.jpg" alt="Fall/Autumn" class="img-thumbnail">
				</div>
				<div class="col-md-3">
					<img src="images/fall4.jpg" alt="Fall/Autumn" class="img-thumbnail">
				</div>
			</div>
		</div>
		<!-- /container -->
	</main>
	<?php
	}
}
?>
		<?php
require_once('includes/footer.php');
?>
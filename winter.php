<?php
require_once('includes/header.php');

if (!isset($_SESSION['user_id'])) {
	echo "<p class='intro winter t15'>You are not authorized to access this content. Please login.</p>";
}
if (isset($_SESSION['user_id']) && isset($_SESSION['level'])) {
$user_id = $_SESSION['user_id'];
$level = $_SESSION['level'];

if ($level != 4) {
	echo "<p class='intro winter t15'>Winter is not you favorite season. You cannot access this content.</p>";
	require_once('includes/footer.php');
	die();
}
	if ($level == 4) {
?>
	<main role="main">
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron jumbotron-winter">
			<div class="container jumbo">
				<h1 class="display-3 text-center">WINTER</h1> </div>
		</div>
		<div class="container">
			<!-- Example row of columns -->
			<div class="row">
				<div class="col-md-12">
				<p class="intro winter">So you prefer Winter?<br> Here are a few quotes and images to make your day.</p>
				</div>		
			</div>
			<div class="row">
				<div class="col-md-4">
					<blockquote class="blockquote">People don't notice whether it's winter or summer when they're happy.
					</blockquote>
					<p>Anton Chekhov</p>
				</div>
				<div class="col-md-4">
					<blockquote class="blockquote">In winter, the stars seem to have rekindled their fires, the moon achieves a fuller triumph, and the heavens wear a look of a more exalted simplicity.
					</blockquote>
					<p>John Burroughs</p>
				</div>
				<div class="col-md-4">
					<blockquote class="blockquote">Once upon a time there was a piece of wood. It was not an expensive piece of wood. Far from it. Just a common block of firewood, one of those thick, solid logs that are put on the fire in winter to make cold rooms cozy and warm.
					</blockquote>
					<p>Carlo Collodi</p>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-3">
					<img src="images/winter1.jpg" alt="Winter" class="img-thumbnail">
				</div>
				<div class="col-md-3">
					<img src="images/winter2.jpg" alt="Winter" class="img-thumbnail">
				</div>
				<div class="col-md-3">
					<img src="images/winter3.jpg" alt="Winter" class="img-thumbnail">
				</div>
				<div class="col-md-3">
					<img src="images/winter4.jpg" alt="Winter" class="img-thumbnail">
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
<?php
require_once('includes/header.php');

if (!isset($_SESSION['user_id'])) {
	echo "<p class='intro spring t15'>You are not authorized to access this content. Please login.</p>";
}
if (isset($_SESSION['user_id']) && isset($_SESSION['level'])) {
$user_id = $_SESSION['user_id'];
$level = $_SESSION['level'];

if ($level != 1) {
	echo "<p class='intro spring t15'>Spring is not you favorite season. You cannot access this content.</p>";
	require_once('includes/footer.php');
	die();
}
	if ($level == 1) {
?>
<main role="main">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron jumbotron-spring">
        <div class="container jumbo">
            <h1 class="display-3 text-center">SPRING</h1>
        </div>
    </div>
    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-12">
                <p class="intro">So you prefer Spring?<br> Here are a few quotes and images to make your day.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <blockquote class="blockquote">Spring is nature’s way of saying, ‘Let’s Party!’</blockquote>
                <p>Robin Williams</p>
            </div>
            <div class="col-md-4">
                <blockquote class="blockquote">In the spring, I have counted 136 different kinds of weather inside of 24 hours.</blockquote>
                <p>Mark Twain</p>
            </div>
            <div class="col-md-4">
                <blockquote class="blockquote">The promise of spring’s arrival is enough to get anyone through the bitter winter!</blockquote>
                <p>Jen Selinsky</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <img src="images/chipmunk.jpg" alt="Chipmunk" class="img-thumbnail" data-toggle="modal" data-target="#seasonsVideo" onclick="playVid()">
            </div>
            <div class="col-md-3">
                <img src="images/belmontpark.jpg" alt="Belmont Park" class="img-thumbnail">
            </div>
            <div class="col-md-3">
                <img src="images/spring-bird.jpg" alt="Spring Bird" class="img-thumbnail">
            </div>
            <div class="col-md-3">
                <img src="images/spring-bluebell.jpg" alt="Bluebells" class="img-thumbnail">
            </div>
        </div>
    </div>
    <!-- /container -->
</main>
<!-- Home Video Modal -->
<div class="modal fade" id="seasonsVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="pauseVid()">X</button>
            <div class="embed-responsive embed-responsive-16by9">
                <video id="seasonVideo" class="embed-responsive-item" controls="controls" poster="images/chipmunk.jpg">
                    <source src="videos/spring.mp4" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>
<script>
    var vid = document.getElementById("seasonVideo");

    function playVid() {
        vid.play();
    }

    function pauseVid() {
        vid.pause();
    }
</script>
<?php
	}
}
?>
<?php
require_once('includes/footer.php');
?>
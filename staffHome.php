<?php
session_start();
include("session.php");
include_once 'include/staffHeader.php';
?>
	<section class="body">
		<div class="container">
			<?php
                            if (isset($_SESSION['userSessionName'])) {
                                $user_name = $_SESSION['userSessionName'];
                                $user_id = $_SESSION["userSession"];
                                echo "<h1>Welcome, $user_name</h1>";
                            }
            ?>
		</div>
	</section>
<?php
include_once 'include/footer.php';
?>
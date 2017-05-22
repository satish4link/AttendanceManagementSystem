<?php
session_start();
include_once 'include/header.php';
?>
	<section class="body">
		<div class="container">
			<h1>login</h1>
			<?php
				
				if (isset($_SESSION['message'])) {
				    echo "<p class='error'>" . $_SESSION['message'] . "</p>";
				}
			?>
			<form method="post" action="loginvalidation.php">
			<!-- align="center" -->
				<table align="center">
					<tr>
						<td>*UserType</td>
						<td>
							<select style="width:154px;" name="usertype">
								<option>Admin</option>
								<option>Faculty</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>*Username</td>
						<td><input type="text" name="uname" placeholder="Username"></td>
					</tr>
					<tr>
						<td>*Password</td>
						<td><input type="password" name="pword" placeholder="Password"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" value="login"></td>
					</tr>
				</table>
			</form>
		</div>
	</section>
<?php
include_once 'include/footer.php';
?>
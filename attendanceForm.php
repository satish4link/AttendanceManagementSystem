<?php
require_once 'include/staffHeader.php';

$username = $_GET["id"];
$d_name = $_GET["d_name"];
$sem_name = $_GET["sem_name"];
$subject_name = $_GET["subject_name"];
?>
<section class="body">
	<div class="container">
		<h1>Take Attendance</h1>
		<table align="center">
				<form method="post" action="takeAttendance.php">
					<tr>
						<td>*Department</td>
						<td>
							<input type="text" name="d_name" value="<?php echo $d_name; ?>">
						</td>
					</tr>
					<tr>
						<td>*Staff:</td>
						<td><input type="text" name="staff" value="<?php echo $username; ?>" /></td>
					</tr>
					<tr>
						<td>*Semester:</td>
						<td><input type="text" name="semester" value="<?php echo $sem_name; ?>" /></td>
					</tr>
					<tr>
						<td>*Subject:</td>
						<td><input type="text" name="subject" value="<?php echo $subject_name; ?>" /></td>
					</tr>
					<tr>
						<td>*Today's Date:</td>
						<td><input type="date" name="date"/></td>
					</tr>
					<tr>
						<td>*Period No:</td>
						<td><input type="number" name="period" placeholder="Period Number" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" value="Take Attendance" />
					</tr>
				</form>
			</table>
	</div>
</section>

<?php
include_once 'include/footer.php';
?>
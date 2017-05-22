<?php
session_start();
include("session.php");
$id = $_GET["id"];
include_once 'include/adminheader.php';
?>
	<section class="body">
		<div class="form-container">
			<h1>update student details</h1>
			<?php
            require_once 'classes/class.user.php';
            $user=new USER;

				if(isset($_POST["submit"])){
					$registration_code = trim($_POST["code"]);
                    $student_fname = trim($_POST["fname"]);
                    $student_lname = trim($_POST["lname"]);
                    $gender = trim($_POST["gender"]);
					$dob = trim($_POST["dob"]);
					$address = trim($_POST["address"]);
					$phone = trim($_POST["phone"]);
                    $email = trim($_POST["email"]);
					$department = trim($_POST["department"]);
					$semester = trim($_POST["semester"]);

					if($registration_code  == "" || $student_fname == "" || $student_lname == "" || $gender == "" || $dob == "" || $address == "" || $phone == "" || $email == "" || $department == "" || $semester == ""){
						echo "<p style='text-align:center; color:red; padding-bottom:10px; '>*All fields must be filled up*</p>";
					}else{						
						try{
							$result = $user->runQuery("UPDATE student_tbl SET registration_code='$registration_code', fname='$student_fname', lname='$student_lname', gender='$gender', dob='$dob', address='$address', phone='$phone', email='$email', d_id='$department', semester='$semester' WHERE student_id = '$id'");
							$stmt = $result->execute();
							if($stmt){
								echo "<p style='text-align:center; color:green; padding-bottom:10px; '>*Data Updated*</p>";
							}else{
								echo "<p style='text-align:center; color:red; padding-bottom:10px; '>*Something is worng, Try again.*</p>";
							}
						}catch(PDOException $ex){
							echo $ex->getMessage();
						}
					}	
				}

				$stmt = $user->runQuery("SELECT * FROM student_tbl WHERE student_id = '$id'");
				$stmt->execute();
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$registration_code = $row["registration_code"];
                    $student_fname = $row["fname"];
                    $student_lname = $row["lname"];
                    $gender = $row["gender"];
					$dob = $row["dob"];
					$address = $row["address"];
					$phone = $row["phone"];
                    $email = $row["email"];
					$department = $row["d_id"];
					$semester = $row["semester"];
				}
			?>
			<table align="center">
				<form method="post" action="">
					<tr>
						<td>*Registration Code:</td>
						<td>
							<input type="text" name="code" placeholder="Student001" value="<?php echo $registration_code; ?>">
							<p>Ex: Student001</p>
						</td>
					</tr>
					<tr>
						<td>*Student First Name:</td>
						<td><input type="text" name="fname" placeholder="First Name" value="<?php echo $student_fname; ?>"/></td>
					</tr>
					<tr>
						<td>*Student Last Name:</td>
						<td><input type="text" name="lname" placeholder="Last Name" value="<?php echo $student_lname; ?>"/></td>
					</tr>
					<tr>
						<td>*Gender</td>
						<td>
							<input type="radio" name="gender" value="Male" checked> Male<br>
							<input type="radio" name="gender" value="Female"> Female<br>
						</td>
					</tr>
					<tr>
						<td>*Date of Birth:</td>
						<td><input type="date" name="dob" value="<?php echo $dob; ?>"></td>
					</tr>
					<tr>
						<td>*Address:</td>
						<td><textarea name="address" cols="17"><?php echo $address; ?></textarea></td>
					</tr>
					<tr>
						<td>*Phone:</td>
						<td><input type="number" name="phone" placeholder="Phone" value="<?php echo $phone; ?>"></td>
					</tr>
					<tr>
						<td>*Email:</td>
						<td><input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>"/></td>
					</tr>
					<tr>
						<td>*Department:</td>
						<td>
							<select name="department" id="d_id">
								<option value="">-----------Select----------</option>
								<?php
									try{
						                $result=$user->runQuery("SELECT * FROM department");
						                $result->execute();
						                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
						                	if ($d_id == $row['d_id']) {
												echo "<option value='" . $row['d_id'] . "' selected>" . $row['d_name'] . "</option>";
											} else {
												echo "<option value='" . $row['d_id'] . "'>" . $row['d_name'] . "</option>";
											}
						                }
						            }catch(PDOException $ex){
						                echo $ex->getMessage();
						            }
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>*Semester:</td>
						<td>
							<select name="semester">
								<option>---------Semester-------</option>
								<option>SEMESTER 1</option>
								<option>SEMESTER 2</option>
								<option>SEMESTER 3</option>
								<option>SEMESTER 4</option>
								<option>SEMESTER 5</option>
								<option>SEMESTER 6</option>
								<option>SEMESTER 7</option>
								<option>SEMESTER 8</option>
							</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" value="Update" />
						<input type="reset" name="reset" value="Cancel" /></td>
					</tr>
				</form>
			</table>
		</div>
	</section>
	<br/>
<?php
include_once 'include/footer.php';
?>
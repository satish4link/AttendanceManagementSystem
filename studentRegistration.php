<?php
include_once 'include/adminheader.php';
?>
	<section class="body">
		<div class="form-container">
			<h1>student entry</h1>
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
					$subject = trim($_POST["subject"]);
					$semester = trim($_POST["semester"]);

					if($registration_code  == "" || $student_fname == "" || $student_lname == "" || $gender == "" || $dob == "" || $address == "" || $phone == "" || $email == "" || $subject == "" || $semester == ""){
						echo "<p style='text-align:center; color:red; padding-bottom:10px; '>*All fields must be filled up*</p>";
					}else{
						try{
							$result = $user->runQuery("INSERT INTO student_tbl(registration_code, fname, lname, gender, dob, address, phone, email, subject_id, semester) VALUES('$registration_code', '$student_fname', '$student_lname', '$gender', '$dob', '$address', '$phone', '$email', '$subject', '$semester')");
							$stmt = $result->execute();
							if($stmt){
								echo "<p style='text-align:center; color:green; padding-bottom:10px; '>*Data Inserted*</p>";
							}else{
								echo "<p style='text-align:center; color:red; padding-bottom:10px; '>*Something is worng, Try again.*</p>";
							}
						}catch(PDOException $ex){
							echo $ex->getMessage();
						}
					}	
				}
			?>
			<table align="center">
				<form method="post" action="">
					<tr>
						<td>*Registration Code:</td>
						<td>
							<input type="text" name="code" placeholder="Student001">
							<p>Ex: Student001</p>
						</td>
					</tr>
					<tr>
						<td>*Student First Name:</td>
						<td><input type="text" name="fname" placeholder="First Name" /></td>
					</tr>
					<tr>
						<td>*Student Last Name:</td>
						<td><input type="text" name="lname" placeholder="Last Name" /></td>
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
						<td><input type="date" name="dob"></td>
					</tr>
					<tr>
						<td>*Address:</td>
						<td><textarea name="address" cols="17"></textarea></td>
					</tr>
					<tr>
						<td>*Phone:</td>
						<td><input type="number" name="phone" placeholder="Phone"></td>
					</tr>
					<tr>
						<td>*Email:</td>
						<td><input type="email" name="email" placeholder="Email"></td>
					</tr>
					<tr>
						<td>*Subject:</td>
						<td>
							<select name="subject" id="subject_id">
								<option value="">-----------Select----------</option>
								<?php
									try{
						                $result=$user->runQuery("SELECT * FROM subject_tbl");
						                $result->execute();
						                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
						                	if ($d_id == $row['subject_id']) {
												echo "<option value='" . $row['subject_id'] . "' selected>" . $row['subject_name'] . "</option>";
											} else {
												echo "<option value='" . $row['subject_id'] . "'>" . $row['subject_name'] . "</option>";
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
						<td><input type="submit" name="submit" value="Submit" />
						<input type="reset" name="reset" value="Cancel" /></td>
					</tr>
				</form>
			</table>
		</div>
		<div class="container">
			<?php
				if(isset($_GET["mode"])){
			                $mode = $_GET["mode"];
			                if($mode == "del"){
			                    $id = $_GET["id"];
			                    $result = $user->runQuery("DELETE FROM student_tbl WHERE student_id = '$id'");
			                    $result->execute();
			                }
			                if($result){
			                    echo "<p>1 row deleted.</p>";
			                }
			            }
			?>
			<!-- align="center" -->
				<table align="center">
					<tr style="font-weight: bold;">
						<td>*Registration Code</td>
						<td>*Student Name</td>
						<td>*Subject</td>
						<td>*Semester</td>
					</tr>
					<?php
						function displayData($result)
			            {
			                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			                    print "<tr >";
			                        print "<td>".$row["registration_code"] . "</td>";
			                        print "<td>".$row["fname"] ." ".$row["lname"]. "</td>";
			                        print "<td>".$row["subject_name"] . "</td>";
			                        print "<td>".$row["semester"] . "</td>";
			                    print "</tr>";
			                }
			            }
			            try{
			                $result=$user->runQuery("SELECT student_tbl.registration_code, student_tbl.fname, student_tbl.lname, student_tbl.semester, subject_tbl.subject_name FROM student_tbl, subject_tbl WHERE student_tbl.subject_id = subject_tbl.subject_id");
			                $result->execute();
			                displayData($result);
			            }catch(PDOException $ex){
			                echo $ex->getMessage();
			            }
		            ?>
				</table>
		</div>
	</section>
<?php
include_once 'include/footer.php';
?>
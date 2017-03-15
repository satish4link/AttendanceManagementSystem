<?php
$id = $_GET["id"];
include_once 'include/adminheader.php';
?>
	<section class="body">
		<div class="form-container">
			<h1>update staff details</h1>
			<?php
            require_once 'classes/class.user.php';
            $user=new USER;

				$error="";
				if(isset($_POST["submit"])){
					$staff_code = trim($_POST["code"]);
                    $staff_fname = trim($_POST["fname"]);
                    $staff_lname = trim($_POST["lname"]);
					$password = trim($_POST["password"]);
					$dob = trim($_POST["dob"]);
					$address = trim($_POST["address"]);
					$degree = trim($_POST["degree"]);
					$phone = trim($_POST["phone"]);
                    $email = trim($_POST["email"]);
					$department = trim($_POST["department"]);
					$usertype = trim($_POST["usertype"]);

					$password = md5($password);

					if($staff_code  == "" || $staff_fname == "" || $staff_lname == "" || $password == "" || $dob == "" || $address == "" || $degree == "" || $phone == "" || $email == "" || $department == "" || $usertype == ""){
						echo "<p style='text-align:center; color:red; padding-bottom:10px; '>*All fields must be filled up*</p>";
					}else{						
						try{
							$result = $user->runQuery("UPDATE staff_tbl SET username='$staff_code', staff_fname='$staff_fname', staff_lname='$staff_lname', password='$password', dateOfBirth='$dob', address='$address', degree='$degree', phone='$phone', email='$email', d_id='$department', usertype='$usertype' WHERE staff_id = '$id'");
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

				$stmt = $user->runQuery("SELECT * FROM staff_tbl WHERE staff_id = '$id'");
				$stmt->execute();
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$staff_code = $row['username'];
                    $staff_fname = $row['staff_fname'];
                    $staff_lname = $row['staff_lname'];
					$password = $row['password'];
					$dob = $row['dateOfBirth'];
					$address = $row['address'];
					$degree = $row['degree'];
					$phone = $row['phone'];
                    $email = $row['email'];
					$usertype = $row['usertype'];
					$approve = $row['approve'];
				}
			?>
			<table align="center">
				<form method="post" action="">
					<tr>
						<td>*Staff Username:</td>
						<td>
							<input type="text" name="code" placeholder="JSmith" value="<?php echo $staff_code; ?>">
							<p>Ex: Jsmith(John Smith)</p>
						</td>
					</tr>
					<tr>
						<td>*Staff First Name:</td>
						<td><input type="text" name="fname" placeholder="First Name" value="<?php echo $staff_fname; ?>" /></td>
					</tr>
					<tr>
						<td>*Staff Last Name:</td>
						<td><input type="text" name="lname" placeholder="Last Name" value="<?php echo $staff_lname; ?>" /></td>
					</tr>
					<tr>
						<td>*Password:</td>
						<td><input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>" /></td>
					</tr>
					<tr>
						<td>*Date of Birth:</td>
						<td><input type="date" name="dob" value="<?php echo $dateOfBirth; ?>" /></td>
					</tr>
					<tr>
						<td>*Address:</td>
						<td><textarea name="address" cols="17"><?php echo $address; ?></textarea></td>
					</tr>
					<tr>
						<td>*Degree:</td>
						<td><input type="text" name="degree" placeholder="Degree" value="<?php echo $degree; ?>" /></td>
					</tr>
					<tr>
						<td>*Phone:</td>
						<td><input type="number" name="phone" placeholder="Phone" value="<?php echo $phone; ?>" /></td>
					</tr>
					<tr>
						<td>*Email:</td>
						<td><input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" /></td>
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
						<td>*User Type:</td>
						<td>
							<select name="usertype"s>
								<option>-----------Select----------</option>
								<option>Admin</option>
								<option>Faculty</option>
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
<?php
session_start();
include("session.php");
include_once 'include/adminheader.php';
?>
	<section class="body">
		<div class="form-container">
			<h1>staff entry</h1>
			<?php
            require_once 'classes/class.user.php';
            $user=new USER;

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
							$result = $user->runQuery("INSERT INTO staff_tbl(username, staff_fname, staff_lname, password, dateOfBirth, address, degree, phone, email, d_id, usertype) VALUES('$staff_code', '$staff_fname', '$staff_lname', '$password', '$dob', '$address', '$degree', '$phone', '$email', '$department', '$usertype')");
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
						<td>*Staff Username:</td>
						<td>
							<input type="text" name="code" id="s_username" placeholder="Jsmith" onkeyup="checkUsernameValid();" />
							<p>Ex: Jsmith(John Smith)</p>
						</td>
						<td><div id="u_valid"></div></td>
					</tr>
					<tr>
						<td>*Staff First Name:</td>
						<td><input type="text" name="fname" placeholder="First Name" /></td>
					</tr>
					<tr>
						<td>*Staff Last Name:</td>
						<td><input type="text" name="lname" placeholder="Last Name" /></td>
					</tr>
					<tr>
						<td>*Password:</td>
						<td><input type="password" name="password" placeholder="Password"></td>
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
						<td>*Degree:</td>
						<td><input type="text" name="degree" placeholder="Degree"></td>
					</tr>
					<tr>
						<td>*Phone:</td>
						<td><input type="number" name="phone" placeholder="Phone"></td>
					</tr>
					<tr>
						<td>*Email:</td>
						<td><input type="email" name="email" id="email_address" placeholder="Email" onkeyup="checkEmailValid();" /></td>
						<td><div id="freevalid"></div></td>
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
							<select name="usertype">
								<option>-----------Select----------</option>
								<option>Admin</option>
								<option>Faculty</option>
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
			<script>
                        function checkEmailValid(){
                            var emailValue = document.getElementById( "email_address" ).value; //Data collected from form field
                            
                             $.ajax({
                                 type: "POST",
                                 url: "ajax/checkingWithAjax.php",
                                 data: {email:emailValue}    //Key,value pair to be sent
                                 }).done(function( result ) {
                                    $("#freevalid").html(result);
                                    if(result=="Valid"){
                                        $('#freevalid').css('color', 'green');
                                        $("#submit").prop('disabled', false);
                                    }
                                    else{
                                        $('#freevalid').css('color', 'red');   
                                    }
                             });
                        }

                        function checkUsernameValid(){
                        	var usernameValue = document.getElementById( "s_username" ).value; //Data collected from form field
                            
                             $.ajax({
                                 type: "POST",
                                 url: "ajax/checkingWithAjax.php",
                                 data: {code:usernameValue}    //Key,value pair to be sent
                                 }).done(function( result ) {
                                    $("#u_valid").html(result);
                                    if(result=="Valid"){
                                        $('#u_valid').css('color', 'green');
                                        $("#submit").prop('disabled', false);
                                    }
                                    else{
                                        $('#u_valid').css('color', 'red');   
                                    }
                             });
                        }
                </script>
		</div>
		<div class="container">
			<?php
				if(isset($_GET["mode"])){
			                $mode = $_GET["mode"];
			                if($mode == "del"){
			                    $id = $_GET["id"];
			                    $result = $user->runQuery("DELETE FROM staff_tbl WHERE staff_id = '$id'");
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
						<td>*Staff Code</td>
						<td>*Staff Name</td>
						<td>*Department</td>
					</tr>
					<?php
						function displayData($result)
			            {
			                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			                    print "<tr >";
			                        print "<td>".$row["username"] . "</td>";
			                        print "<td>".$row["staff_fname"] ." ".$row["staff_lname"]. "</td>";
			                        print "<td>".$row["d_name"] . "</td>";
			                    print "</tr>";
			                }
			            }
			            try{
			                $result=$user->runQuery("SELECT staff_tbl.username, staff_tbl.staff_fname, staff_tbl.staff_lname, department.d_name FROM staff_tbl, department WHERE staff_tbl.d_id = department.d_id");
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
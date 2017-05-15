<?php
include_once 'include/adminheader.php';
?>
	<section class="body">
		<div class="form-container">
			<h1>student entry</h1>
			<?php
            require_once 'classes/class.user.php';
            $user=new USER;

            	if(isset($_POST["dsubmit"])){
					$department = trim($_POST["department"]);

					if($department == ""){
						echo "<p style='text-align:left; color:red; padding-left:20px; padding-bottom:10px; '>*Please enter Department name*</p>";
					}else{
						try{
							$result = $user->runQuery("INSERT INTO department(d_name) VALUES('$department')");
							$stmt = $result->execute();
							if($stmt){
								echo "<p style='text-align:left; color:green; padding-left:20px; padding-bottom:10px; '>*Data Inserted*</p>";
							}else{
								echo "<p style='text-align:left; color:red; padding-left:20px; padding-bottom:10px; '>*Something is worng, Try again.*</p>";
							}
						}catch(PDOException $ex){
							echo $ex->getMessage();
						}
					}	
				}

				if(isset($_POST["submit"])){
					$department = trim($_POST["department"]);
					$semester = trim($_POST["semester"]);
					$subject = trim($_POST["subject"]);

					if($department == "" || $semester == "" || $subject == ""){
						echo "<p style='text-align:center; color:red; padding-bottom:10px; '>*All fields must be filled up*</p>";
					}else{
						try{
							$result = $user->runQuery("INSERT INTO subject_tbl(d_id, sem_id, subject_name) VALUES('$department', '$semester', '$subject')");
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
			<table align="left" style="border: 1px solid #7e2199;">
				<form method="post" action="">
					<tr>
						<td style="padding: 10px; text-decoration:underline;">DEPARTMENT ENTRY</td>
						<td></td>
					</tr>
					<tr>
						<td>*Department:</td>
						<td>
							<input type="text" name="department" placeholder="Department">
							<p>Ex: BSC(Hons) Computing</p>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="dsubmit" value="Submit" />
						<input type="reset" name="reset" value="Cancel" /></td>
					</tr>
				</form>
			</table>
			<table align="center" style="border: 1px solid #7e2199;">
				<form method="post" action="">
					<tr>
						<td style="padding: 10px; text-decoration:underline;">SUBJECT ENTRY</td>
						<td></td>
					</tr>
					<tr>
						<td>*Department:</td>
						<td>
							<select name="department" id="d_id">
								<option value="">--------------Select-------------</option>
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
								<option>------------Semester----------</option>
								<?php
									try{
						                $result=$user->runQuery("SELECT * FROM semester");
						                $result->execute();
						                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
						                	if ($d_id == $row['sem_id']) {
												echo "<option value='" . $row['sem_id'] . "' selected>" . $row['sem_name'] . "</option>";
											} else {
												echo "<option value='" . $row['sem_id'] . "'>" . $row['sem_name'] . "</option>";
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
						<td>*Subject:</td>
						<td><input type="text" name="subject" placeholder="Subject"></td>
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
			<!-- align="center" -->
				<table align="center">
					<tr style="font-weight: bold;">
						<td>*Department</td>
						<td>*Semester</td>
						<td>*Subject</td>
						<td></td>
					</tr>
					<?php

						/* deleting subject */
						if(isset($_GET["mode"])){
			                $mode = $_GET["mode"];
			                if($mode == "del"){
			                    $id = $_GET["id"];
			                    $result = $user->runQuery("DELETE FROM subject_tbl WHERE subject_id = '$id'");
			                    $result->execute();
			                }
			                if($result){
			                    echo "<p>1 row deleted.</p>";
			                }
			            }


						function displayData($result)
			            {
			                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			                    print "<tr >";
			                        print "<td>".$row["d_name"] . "</td>";
			                        print "<td>".$row["sem_name"] . "</td>";
			                        print "<td>".$row["subject_name"] . "</td>";
			                        print "<td><a onclick='return confirmDel()' href=?mode=del&id=".$row['subject_id'].">Delete</a></td>";
			                    print "</tr>";
			                }
			            }
			            try{
			                $result=$user->runQuery("SELECT subject_tbl.subject_id, department.d_name, semester.sem_name, subject_tbl.subject_name FROM subject_tbl, department, semester WHERE subject_tbl.d_id = department.d_id AND subject_tbl.sem_id = semester.sem_id");
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
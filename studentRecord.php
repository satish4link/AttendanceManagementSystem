<?php
session_start();
include("session.php");
include_once 'include/adminheader.php';
?>
	<section class="body">
		<div class="form-container">
			<h1>student record</h1>
			<?php
            require_once 'classes/class.user.php';
            $user=new USER;

			?>
			<table align="center">
				<form method="post" action="">
					<tr>
						<td>Search Student:</td>
						<td>
							<input type="text" style="width:290px; padding: 5px;" name="code" placeholder="Search Staff by their Name, Phone or Department">
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" value="Search" />
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
						<td>*Gender</td>
						<td>*Date Of Birth</td>
						<td>*Address</td>
						<td>*Phone</td>
						<td>*Email</td>
						<td>*Subject</td>
						<td>*Semester</td>
						<td>Update/Delete</td>
					</tr>
					<?php
						if (isset($_POST['search'])) {
	    					$search = $_POST['code'];
	    					
	    					try{
				                $result=$user->runQuery("SELECT subject_tbl.subject_name, student_tbl.student_id, student_tbl.registration_code, student_tbl.fname, student_tbl.lname, student_tbl.gender, student_tbl.dob, student_tbl.address, student_tbl.phone, student_tbl.email, student_tbl.semester FROM student_tbl, subject_tbl WHERE CONCAT (student_tbl.registration_code, student_tbl.fname, student_tbl.lname, student_tbl.phone, department.d_name) LIKE '%" . $search . "%' AND student_tbl.subject_id = subject_tbl.subject_id");
				                $result->execute();
				                displayData($result);
				            }catch(PDOException $ex){
				                echo $ex->getMessage();
				            }	    					
	    				}else{
	    					try{
				                $result=$user->runQuery("SELECT subject_tbl.subject_name, student_tbl.student_id, student_tbl.registration_code, student_tbl.fname, student_tbl.lname, student_tbl.gender, student_tbl.dob, student_tbl.address, student_tbl.phone, student_tbl.email, student_tbl.semester FROM student_tbl, subject_tbl WHERE student_tbl.subject_id = subject_tbl.subject_id");
				                $result->execute();
				                displayData($result);
				            }catch(PDOException $ex){
				                echo $ex->getMessage();
				            }
	    				}

						function displayData($result)
			            {
			                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			                    print "<tr >";
			                        print "<td>".$row["registration_code"] . "</td>";
			                        print "<td>".$row["fname"] ." ". $row["lname"] ."</td>";
			                        print "<td>".$row["gender"] . "</td>";
			                        print "<td>".$row["dob"] . "</td>";
			                        print "<td>".$row["address"] . "</td>";
			                        print "<td>".$row["phone"] . "</td>";
			                        print "<td>".$row["email"] . "</td>";
			                        print "<td>".$row["subject_name"] . "</td>";
			                        print "<td>".$row["semester"] . "</td>";
			                        print "<td><a href='updateStudentDetails.php?id=".$row['student_id']."'>Update</a> | <a onclick='return confirmDel()' href=?mode=del&id=".$row['student_id'].">Delete</a></td>";
			                    print "</tr>";
			                }
			            }
		            ?>
				</table>
		</div>
	</section>
<?php
include_once 'include/footer.php';
?>
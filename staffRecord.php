<?php
session_start();
include("session.php");
include_once 'include/adminheader.php';
?>
	<section class="body">
		<div class="form-container">
			<h1>staff record</h1>
			<?php
            require_once 'classes/class.user.php';
            $user=new USER;

			?>
			<table align="center">
				<form method="post" action="">
					<tr>
						<td>Search Staff:</td>
						<td>
							<input type="text" style="width:320px; padding: 5px;" name="code" placeholder="Search Staff by their Name, Username or Department">
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="search" value="Search" />
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
						<td>*Username</td>
						<td>*Staff Name</td>
						<td>*Password</td>
						<td>*Date Of Birth</td>
						<td>*Address</td>
						<td>*Degree</td>
						<td>*Phone</td>
						<td>*Email</td>
						<td>*Department</td>
						<td>*User Type</td>
						<td>*Approve</td>
						<td>Update/Delete</td>
					</tr>
					<?php
					if (isset($_POST['search'])) {
    					$search = $_POST['code'];

    					try{
			                $result=$user->runQuery("SELECT staff_tbl.staff_id, staff_tbl.username, staff_tbl.staff_fname, staff_tbl.staff_lname, staff_tbl.password, staff_tbl.dateOfBirth, staff_tbl.address, staff_tbl.degree, staff_tbl.phone, staff_tbl.email, department.d_name, staff_tbl.usertype, staff_tbl.approve FROM staff_tbl, department WHERE CONCAT (staff_tbl.username, staff_tbl.staff_fname, staff_tbl.staff_lname, staff_tbl.degree, department.d_name) LIKE '%" . $search . "%' AND staff_tbl.d_id = department.d_id");
			                $result->execute();
			                displayData($result);
			            }catch(PDOException $ex){
			                echo $ex->getMessage();
			            }
    				}else{
    					try{
			                $result=$user->runQuery("SELECT staff_tbl.staff_id, staff_tbl.username, staff_tbl.staff_fname, staff_tbl.staff_lname, staff_tbl.password, staff_tbl.dateOfBirth, staff_tbl.address, staff_tbl.degree, staff_tbl.phone, staff_tbl.email, department.d_name, staff_tbl.usertype, staff_tbl.approve FROM staff_tbl, department WHERE staff_tbl.d_id = department.d_id");
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
			                        print "<td>".$row["username"] . "</td>";
			                        print "<td>".$row["staff_fname"] ." ". $row["staff_lname"] ."</td>";
			                        print "<td>".$row["password"] . "</td>";
			                        print "<td>".$row["dateOfBirth"] . "</td>";
			                        print "<td>".$row["address"] . "</td>";
			                        print "<td>".$row["degree"] . "</td>";
			                        print "<td>".$row["phone"] . "</td>";
			                        print "<td>".$row["email"] . "</td>";
			                        print "<td>".$row["d_name"] . "</td>";
			                        print "<td>".$row["usertype"] . "</td>";
			                        if($row["approve"]==0){
			                        			print "<td><a style='color:red;' href='approve.php?id=".$row['staff_id']."'>Not Approve</a></td>";
			                        		}else{
			                        			print "<td><p style='color:green;'>Approved</p></td>";
			                        		}
			                        print "<td><a href='updateStaffDetails.php?id=".$row['staff_id']."'>Update</a> | <a onclick='return confirmDel()' href=?mode=del&id=".$row['staff_id'].">Delete</a></td>";
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
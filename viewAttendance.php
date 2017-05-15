<?php
include_once 'include/adminheader.php';
$subject_name = $_GET['subject_name'];
?>
	<section class="body">
		<div class="container">
			<!-- align="center" -->
				<table align="center">
					<tr style="font-weight: bold;">
						<td>*Subject</td>
						<td>*Student</td>
						<td>*Status</td>
						<td>*Date</td>
					</tr>
					<?php
						require_once 'classes/class.user.php';
            			$user=new USER;
	    					try{
				                $result=$user->runQuery("SELECT subject_tbl.subject_name, attendance_tbl.subject, attendance_tbl.student, attendance_tbl.a_date, attendance_tbl.status FROM subject_tbl, attendance_tbl WHERE attendance_tbl.subject = subject_tbl.subject_name AND attendance_tbl.subject = '$subject_name'");
				                $result->execute();
				                displayData($result);
				            }catch(PDOException $ex){
				                echo $ex->getMessage();
				            }

						function displayData($result)
			            {
			                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			                    print "<tr >";
			                        print "<td>".$row["subject"] . "</td>";
			                        print "<td>".$row["student"] . "</td>";
			                        print "<td>".$row["status"] . "</td>";
			                        print "<td>".$row["a_date"] . "</td>";
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
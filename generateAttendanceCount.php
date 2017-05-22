<?php
session_start();
include("session.php");
include_once 'include/adminheader.php';
?>
	<section class="body">
		<div class="container">
			<!-- align="center" -->
				<table align="center">
					<tr style="font-weight: bold;">
						<td>*Subject</td>
						<td>*Student</td>
						<td>*Present</td>
						<td>*Absent</td>
						<td>*Late</td>
						<td>*Leave</td>
					</tr>
					<?php
						require_once 'classes/class.user.php';
            			$user=new USER;
	    				try{
				            $result=$user->runQuery("SELECT student, subject, 
						    CONCAT(COALESCE(SUM(CASE WHEN status = 'PRESENT' THEN 1 END),0),' days') as Present,
						    CONCAT(COALESCE(SUM(CASE WHEN status = 'ABSENT' THEN 1 END),0),' days') as Absent,
						    CONCAT(COALESCE(SUM(CASE WHEN status = 'LATE' THEN 1 END),0),' days') as Late,
						    CONCAT(COALESCE(SUM(CASE WHEN status = 'ONLEAVE' THEN 1 END),0),' days') as OnLeave
							FROM attendance_tbl 
							GROUP BY student");
				            $result->execute();
				            displayData($result);
				        }catch(PDOException $ex){
				            echo $ex->getMessage();
				        }

						function displayData($result)
			            {
			                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			                    print "<tr >";
			                		echo "<td>".$row['subject']."</td>";
			                        echo "<td>".$row['student']."</td>";
					                echo "<td>".$row['Present']."</td>";
					                echo "<td>".$row['Absent']."</td>";
					                echo "<td>".$row['Late']."</td>";
					                echo "<td>".$row['OnLeave']."</td>";
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
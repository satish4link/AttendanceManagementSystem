<?php
include_once 'include/adminheader.php';
?>
	<section class="body">
		<div class="container">
			<!-- align="center" -->
				<table align="center">
					<tr style="font-weight: bold;">
						<td>*Subject</td>
						<td></td>
					</tr>
					<?php
						require_once 'classes/class.user.php';
            			$user=new USER;
	    					try{
				                $result=$user->runQuery("SELECT * FROM subject_tbl");
				                $result->execute();
				                displayData($result);
				            }catch(PDOException $ex){
				                echo $ex->getMessage();
				            }

						function displayData($result)
			            {
			                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			                    print "<tr >";
			                        print "<td>".$row["subject_name"] . "</td>";
			                        print "<td><a href='viewAttendance.php?subject_name=".$row['subject_name']."'>View Attendance</a></td>";
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
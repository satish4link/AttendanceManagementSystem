<?php
require_once 'include/staffHeader.php';

if(isset($_POST['submit'])){
	$d_name = trim($_POST['d_name']);
	$staff = trim($_POST['staff']);
	$semester = trim($_POST['semester']);
	$subject = trim($_POST['subject']);
	$date = trim($_POST['date']);
	$period = trim($_POST['period']);
}
?>
<section class="body">
	<div class="container">
		<h1>Take Attendance</h1>
		<table align="center">
            <tr style="font-weight: bold;">
                <td>Student Name</td>
                <td>Subject Name</td>
                <td>Attendance</td>
            </tr>
            <?php
            	require_once 'classes/class.user.php';
            	$user=new USER;

            	if(isset($_GET["mode"])){
			                $mode = $_GET["mode"];
			                if($mode == "del"){
			                    $status = $_GET["status"];
			                    $fname = $_GET["fname"];
			                    $lname = $_GET["lname"];
			                    $subject_name = $_GET["subject_name"];
			                    echo $status."<br/>".$fname." ".$lname."<br/>".$subject_name;
			                    // $result = $user->runQuery("DELETE FROM staff_tbl WHERE staff_id = '$id'");
			                    // $result->execute();
			                }
			                if($result){
			                    echo "<p>1 row deleted.</p>";
			                }
			            }

            	try{
			        $result=$user->runQuery("SELECT student_tbl.student_id, student_tbl.fname, student_tbl.lname, subject_tbl.subject_name FROM student_tbl, subject_tbl WHERE student_tbl.student_id = subject_tbl.student_id AND subject_tbl.subject_name = '$subject'");
			        $result->execute();
			        displayData($result, $d_name, $staff, $semester, $subject, $date, $period);
	            }catch(PDOException $ex){
	            	echo $ex->getMessage();
			    }
			    function displayData($result, $d_name, $staff, $semester, $subject, $date, $period)
			            {
			                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			                    print "<tr >";
			                        print "<td>".$row["fname"] ." ". $row["lname"] ."</td>";
			                        print "<td>".$row["subject_name"] ."</td>";
			                        // if($row["approve"]==0){
			                        // 			print "<td><a style='color:red;' href='approve.php?id=".$row['staff_id']."'>Not Approve</a></td>";
			                        // 		}else{
			                        // 			print "<td><p style='color:green;'>Approved</p></td>";
			                        // 		}
			                        // print "<td><a href='updateStaffDetails.php?id=".$row['staff_id']."'>Update</a> | <a onclick='return confirmDel()' href=?mode=del&id=".$row['staff_id'].">Delete</a></td>";
			                        print "<td><a style='color:green;' onclick='return confirmDel()' href=?mode=del&id=".$row['fname'].">PRESENT</a></td>";
			                    print "</tr>";
			                }
			            }
            ?>
        </table>
        <br/><br/>
        <h1> Attendance Record</h1>
		<table align="center">
            <tr style="font-weight: bold;">
                <td>Subject</td>
                <td>Date</td>
                <td>Period No</td>
                <td>Student</td>
                <td>Attendance</td>
            </tr>
            <?php
            	require_once 'classes/class.user.php';
            	$user=new USER;

            	try{
			        $result=$user->runQuery("SELECT * FROM attendance_tbl WHERE subject = '$subject'");
			        $result->execute();
			        displayAttendanceData($result);
	            }catch(PDOException $ex){
	            	echo $ex->getMessage();
			    }
			    function displayAttendanceData($result)
			            {
			                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			                    print "<tr >";
			                    	print "<td>".$row["subject"] ."</td>";
			                        print "<td>".$row["date"] ."</td>";
			                        print "<td>".$row["period_no"] ."</td>";
			                        print "<td>".$row["student"] ."</td>";
			                        if($row["attendance"]=='PRESENT'){
			                        	print "<td><p style='color:green;'>PRESENT</p></td>";
			                        }else if($row["attendance"]=='ABSENT'){
			                        	print "<td><p style='color:red;'>ABSENT</p></td>";
			                        }else if($row["attendance"]=='LATE'){
			                        	print "<td><p style='color:yellow;'>LATE</p></td>";
			                        }else if($row["attendance"]=='ON LEAVE'){
			                        	print "<td><p style='color:black;'>ON LEAVE</p></td>";
			                        }			                    
			                    print "</tr>";
			                }
			            }
            ?>
        </table>
	</div>
</section>
<?php
require_once 'include/footer.php';
?>
<?php
require_once 'include/staffHeader.php';
?>
	<section class="body">
		<div class="container">
			<h1>Class Attendance</h1>
            <table align="center">
                    <tr style="font-weight: bold;">
                        <td>Username</td>
                        <td>Department</td>
                        <td>Semester</td>
                        <td>Subject</td>
                        <td></td>
                    </tr>
                    <?php
                        require_once 'classes/class.user.php';
                        $user=new USER;

                        if (isset($_SESSION['userSessionName'])) {
                                $user_name = $_SESSION['userSessionName'];
                                $user_id = $_SESSION["userSession"];
                            }
                              
                            try{
                                $result=$user->runQuery("SELECT staff_tbl.staff_id, staff_tbl.username, department.d_name, semester.sem_name, subject_tbl.subject_name FROM staff_tbl, department, semester, subject_tbl WHERE staff_tbl.d_id = department.d_id AND subject_tbl.d_id = department.d_id AND subject_tbl.sem_id = semester.sem_id AND staff_tbl.username = '$user_name'");
                                $result->execute();
                                displayData($result);
                            }catch(PDOException $ex){
                                echo $ex->getMessage();
                            }

                        function displayData($result)
                        {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                print "<tr >";
                                    print "<td>".$row["username"] ."</td>";
                                    print "<td>".$row["d_name"] . "</td>";
                                    print "<td>".$row["sem_name"] . "</td>";
                                    print "<td>".$row["subject_name"] . "</td>";
                                    print "<td><a href='attendanceForm.php?id=".$row['username']."&d_name=".$row['d_name']."&sem_name=".$row['sem_name']."&subject_name=".$row['subject_name']."'>Take Attendance</a></td>";
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
<?php
require_once 'include/staffHeader.php';
?>
	<section class="body">
		<div class="container">
			<h1>Class Attendance</h1>
            <table align="center">
                <tr>
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
                                $result=$user->runQuery("SELECT staff_tbl.username, subject_tbl.subject_name FROM staff_tbl, subject_tbl WHERE subject_tbl.d_id = staff_tbl.d_id AND staff_tbl.username = '$user_name'");
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
                                    print "<td><a href='takeAttendance.php?subject_name=".$row['subject_name']."'>Take Attendance</a></td>";
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
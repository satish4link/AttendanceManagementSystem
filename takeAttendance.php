<?php
session_start();
include("session.php");
require_once 'include/staffHeader.php';
$subject = $_GET["subject_name"];
?>
	<section class="body">
		<div class="container">
			<h1>Take Attendance</h1>
            <?php
            require_once 'classes/class.user.php';
            $user=new USER;

                $c_date = date("Y-m-d");

                if(isset($_POST["submit"])){

                    if(empty($_POST['attend'])){
                        echo "<p style='text-align:center; color:red; padding-bottom:10px; '>*No status selected*</p>";
                    }else{
                    $attend = $_POST['attend'];
                    //print_r($attend);
                            try{
                                $result=$user->runQuery("SELECT DISTINCT a_date, subject FROM attendance_tbl");
                                $result->execute();
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        $db_date = $row['a_date'];
                                        $db_subject = $row['subject'];
                                        // or use array
                                    }
                                    if($db_subject == $subject && $db_date == $c_date){
                                    // if(in_array($subject, $db_subject) && in_array($c_date, $db_date)){
                                        echo "<p style='text-align:center; color:red; padding-bottom:10px; '>*Attendance already taken for this subject*</p>";
                                    }else{
                                        foreach ($attend as $atn_key => $atn_value) {
                                            
                                                try{
                                                    if ($atn_value == "PRESENT") {
                                                        $result=$user->runQuery("INSERT INTO attendance_tbl(subject, student, a_date, status) VALUES('$subject', '$atn_key', '$c_date', 'PRESENT')");
                                                    }else if ($atn_value == "ABSENT") {
                                                        $result=$user->runQuery("INSERT INTO attendance_tbl(subject, student, a_date, status) VALUES('$subject', '$atn_key', '$c_date', 'ABSENT')");
                                                    }else if ($atn_value == "LATE") {
                                                        $result=$user->runQuery("INSERT INTO attendance_tbl(subject, student, a_date, status) VALUES('$subject', '$atn_key', '$c_date', 'LATE')");
                                                    }else if ($atn_value == "ONLEAVE") {
                                                        $result=$user->runQuery("INSERT INTO attendance_tbl(subject, student, a_date, status) VALUES('$subject', '$atn_key', '$c_date', 'ONLEAVE')");
                                                    }
                                                    $stmt = $result->execute();
                                                    
                                                }catch(PDOException $ex){
                                                    echo $ex->getMessage();
                                                }
                                        }
                                        if($stmt){
                                            echo "<p style='text-align:center; color:green; padding-bottom:10px; '>*Attendance Recorded*</p>";
                                        }else{
                                            echo "<p style='text-align:center; color:red; padding-bottom:10px; '>*Something is worng, Try again.*</p>";
                                        }
                                    }
                                
                                }catch(PDOException $ex){
                                    echo $ex->getMessage();
                                } 
                    }
                }
            ?>
            <table align="center">
                <form method="post" action="">
                <h2>Today is: <?php echo $c_date ?></h2>
                <tr style="font-weight: bold;">
                    <td>*Student ID</td>
                    <td>*Student Name</td>
                    <td>*Subject Name</td>
                    <td>*Attendance</td>
                </tr>
                <?php
                    try{
                        $result=$user->runQuery("SELECT student_tbl.fname, student_tbl.lname, student_tbl.student_id, subject_tbl.subject_name FROM student_tbl, subject_tbl WHERE student_tbl.subject_id = subject_tbl.subject_id AND subject_tbl.subject_name = '$subject'");
                        $result->execute();
                        displayData($result, $subject);
                    }catch(PDOException $ex){
                        echo $ex->getMessage();
                    }
                    function displayData($result,$subject)
                            {
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    print "<tr >";
                                        print "<td>".$row['student_id']."</td>";
                                        $name = $row["fname"] ." ". $row["lname"];
                                        print "<td>".$name."</td>";
                                        print "<td>".$subject."</td>";
                                        print "<td>
                                            
                                                <input type='radio' name='attend[".$name."]' value='PRESENT'> PRESENT
                                                <input type='radio' name='attend[".$name."]' value='ABSENT'> ABSENT
                                                <input type='radio' name='attend[".$name."]' value='LATE'> LATE  
                                                <input type='radio' name='attend[".$name."]' value='ONLEAVE'> ONLEAVE  
                                             
                                        </td>";
                                    print "</tr>";
                                }
                            }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" value="Submit">
                        </td>
                    </tr>
                </form>
            </table>
		</div>
	</section>
<?php
include_once 'include/footer.php';
?>
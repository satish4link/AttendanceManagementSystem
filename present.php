<?php
$f_name = $_GET['f_name'];
$l_name = $_GET['l_name'];
$d_name = $_GET['d_name'];
$staff = $_GET['staff'];
$semester = $_GET['semester'];
$subject = $_GET['subject'];
$date = $_GET['date'];
$period = $_GET['period'];
$status = $_GET['status'];

$student = $f_name." ".$l_name;

echo $student."<br/>".$d_name."<br/>".$staff."<br/>".$semester."<br/>".$subject."<br/>".$date."<br/>".$period."<br/>".$status."<br/>";


require_once 'classes/class.user.php';
            	$user=new USER;
if($status = '1'){
	try{
		$result=$user->runQuery("INSERT INTO attendance_tbl(department, staff, subject, semester, student, date, period_no, attendance) VALUES('$d_name', '$staff', '$subject', '$semester','$student', '$date', '$period', 'PRESENT')");
		$stmt=$result->execute();
		if($stmt){
			echo "yes1";
		}else{
			echo "no1";
		}
	}catch(PDOException $ex){
		    echo $ex->getMessage();
	}
}else if($status = '2'){
	try{
		$result=$user->runQuery("INSERT INTO attendance_tbl(department, staff, subject, semester, student, date, period_no, attendance) VALUES('$d_name', '$staff', '$subject', '$semester','$student', '$date', '$period', 'ABSENT')");
		$stmt=$result->execute();
		if($stmt){
			echo "yes2";
		}else{
			echo "no2";
		}
	}catch(PDOException $ex){
		    echo $ex->getMessage();
	}
}else if($status = '3'){
	try{
		$result=$user->runQuery("INSERT INTO attendance_tbl(department, staff, subject, semester, student, date, period_no, attendance) VALUES('$d_name', '$staff', '$subject', '$semester','$student', '$date', '$period', 'LATE')");
		$stmt=$result->execute();
		if($stmt){
			echo "yes3";
		}else{
			echo "no3";
		}
	}catch(PDOException $ex){
		    echo $ex->getMessage();
	}
}else if($status = '4'){
	try{
		$result=$user->runQuery("INSERT INTO attendance_tbl(department, staff, subject, semester, student, date, period_no, attendance) VALUES('$d_name', '$staff', '$subject', '$semester','$student', '$date', '$period', 'ON LEAVE')");
		$stmt=$result->execute();
		if($stmt){
			echo "yes4";
		}else{
			echo "no4";
		}
	}catch(PDOException $ex){
		    echo $ex->getMessage();
	}
}
	

?>
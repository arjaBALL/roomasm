<?php
include('./connection/session.php');
include('connection/dbcon.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get form data
	$firstName = $conn->real_escape_string($_POST['firstName']);
	$lastName = $conn->real_escape_string($_POST['lastName']);

	// Check for duplicate teacher
	$check_teacher_sql = "SELECT * FROM teachers WHERE FirstName = '$firstName' AND LastName = '$lastName'";
	$teacher_result = $conn->query($check_teacher_sql);
	if ($teacher_result->num_rows > 0) {
		echo "<script>alert('Teacher already exists.'); window.location.href='add_teacher.php';</script>";
		exit();
	}

	// Insert teacher into database
	$sql = "INSERT INTO teachers (FirstName, LastName) VALUES ('$firstName', '$lastName')";
	if ($conn->query($sql) === TRUE) {
		echo "<script>alert('Teacher added successfully!'); window.location.href='add_teacher.php';</script>";
	} else {
		echo "Error: " . $conn->error;
	}
}
?>
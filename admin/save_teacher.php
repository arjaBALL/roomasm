<?php
include('./connection/session.php');
include('connection/dbcon.php');

// Initialize response array
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get form data
	$firstName = $conn->real_escape_string($_POST['firstName']);
	$lastName = $conn->real_escape_string($_POST['lastName']);

	// Check for duplicate teacher
	$check_teacher_sql = "SELECT * FROM teachers WHERE FirstName = '$firstName' AND LastName = '$lastName'";
	$teacher_result = $conn->query($check_teacher_sql);
	if ($teacher_result->num_rows > 0) {
		// Teacher already exists
		$response['status'] = 'error';
		$response['message'] = 'Error: Teacher already exists.';
		echo json_encode($response);
		exit();
	}

	// Insert teacher into database
	$sql = "INSERT INTO teachers (FirstName, LastName) VALUES ('$firstName', '$lastName')";
	if ($conn->query($sql) === TRUE) {
		// Teacher successfully added
		$response['status'] = 'success';
		$response['message'] = 'Teacher added successfully!';
		echo json_encode($response);
	} else {
		// Error while adding teacher
		$response['status'] = 'error';
		$response['message'] = 'Error: ' . $conn->error;
		echo json_encode($response);
	}
}
?>
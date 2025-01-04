<?php
include('./connection/dbcon.php');
include('./connection/session.php');

// Handle form submission for adding subject
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $subjectName = $conn->real_escape_string($_POST['subjectName']);
    $subjectDescription = $conn->real_escape_string($_POST['subjectDescription']);
    $teacherID = $_POST['teacherID'];

    // Check for duplicate subject
    $check_subject_sql = "SELECT * FROM subjects WHERE SubjectName = '$subjectName'";
    $subject_result = $conn->query($check_subject_sql);
    if ($subject_result->num_rows > 0) {
        echo "<script>alert('Subject already exists.'); window.location.href='add_subject.php';</script>";
        exit();
    }

    // Insert subject into database
    $sql = "INSERT INTO subjects (SubjectName, SubjectDescription, TeacherID) 
            VALUES ('$subjectName', '$subjectDescription', '$teacherID')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Subject added successfully!'); window.location.href='add_subject.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch teachers for the dropdown
$teachers_query = "SELECT TeacherID, CONCAT(FirstName, ' ', LastName) AS TeacherName FROM teachers";
$teachers_result = $conn->query($teachers_query);
?>
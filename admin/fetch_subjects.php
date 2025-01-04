<?php
if (isset($_GET['TeacherID'])) {
    $TeacherID = $_GET['TeacherID'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'sched_db');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Fetch subjects for the selected teacher
    $sql = "SELECT SubjectID, SubjectName FROM subjects WHERE TeacherID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $TeacherID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['SubjectID'] . "'>" . $row['SubjectName'] . "</option>";
        }
    } else {
        echo "<option value=''>No subject available</option>";
    }

    $stmt->close();
    $conn->close();
}
?>
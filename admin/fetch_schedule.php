<?php
include('./connection/dbcon.php');
include('./connection/session.php');


$sql_fetch = "
    SELECT 
        schedules.schedule_id, 
        floors.floor_number, 
        rooms.room_name, 
        schedules.day_of_week, 
        schedules.start_time, 
        schedules.end_time, 
        subjects.SubjectName, 
        teachers.FirstName, 
        teachers.LastName
    FROM 
        schedules
    INNER JOIN floors ON schedules.floor_id = floors.floor_id
    INNER JOIN rooms ON schedules.room_id = rooms.room_id
    INNER JOIN subjects ON schedules.SubjectID = subjects.SubjectID
    INNER JOIN teachers ON schedules.TeacherID = teachers.TeacherID
    ORDER BY schedules.day_of_week, schedules.start_time
";

// Execute query and return result
$result = $conn->query($sql_fetch);

return $result;
?>
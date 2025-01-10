<?php
include('./connection/session.php');
include('./connection/dbcon.php');

// Fetch POST data
$get_id = $_POST['get_id'];
$room_name = $_POST['room_name'];
$Description = $_POST['floor_id'];

// Update the room details in the rooms table
$update_sql = "UPDATE rooms SET room_name='$room_name', floor_id='$Description' WHERE room_id='$get_id'";
mysqli_query($conn, $update_sql) or die(mysqli_error($conn));

// Fetch user details for logging the action
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE User_id=$id_session");
$user_row = mysqli_fetch_array($user_query);
$type = $user_row['User_Type'];

// Log the action in the history table
$log_sql = "INSERT INTO history (date, action, data, user) VALUES (NOW(), 'Update Entry Room', '$room_name', '$type')";
mysqli_query($conn, $log_sql) or die(mysqli_error($conn));

// Redirect back to the room page
header('Location: room.php');
?>
<?php
include('./connection/session.php');
include('./components/header.php');
include('./connection/dbcon.php');
include('./components/nav-top1.php');
include('./components/main.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select with Checkboxes</title>
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <!-- jQuery (Make sure jQuery is included) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include jQuery (required by Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
</head>

<div class="wrapper ">
    <div id="element" class="hero-body-schedule">
        <h2>
            <font color="white">Add Schedule List</font>
        </h2>
        <a class="btn btn-primary" href="schedule.php"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a>
        <hr>
        <form id="save_voter" class="form-horizontal" method="POST" action="save_schedule.php"
            onsubmit="return validateForm()">
            <fieldset>
                </br>
                <div class="hai_naku">
                    <ul class="thumbnails_new_voter">
                        <li class="span3">
                            <div class="thumbnail_new_voter">

                                <div class="control-group">
                                    <label class="control-label" for="input01">Floor:</label>
                                    <div class="controls">
                                        <!-- Floor Dropdown -->
                                        <select id="floor" class="span3333" name="floor" onchange="fetchRooms()">
                                            <option value="">Select Floor</option>
                                            <?php include_once('fetch_floor.php'); ?>
                                            <!-- Include PHP to fetch floor options -->
                                        </select>


                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="input01">Rooms:</label>
                                        <div class="controls">
                                            <!-- Floor Dropdown -->

                                            <!-- Room Dropdown (Dynamic) -->
                                            <select id="room" class="span3333" name="room" required>
                                                <option value="">Select Room</option>
                                            </select>
                                        </div>

                                        <!-- JavaScript -->
                                        <script>
                                            function fetchRooms() {
                                                var floorId = $('#floor').val();  // Get selected floor ID
                                                $('#room').html('<option>Loading...</option>'); // Show loading message in room dropdown

                                                $.ajax({
                                                    url: 'fetch_rooms.php', // The current PHP file that handles both floor and room fetching
                                                    type: 'GET',
                                                    data: { floor_id: floorId },  // Send selected floor ID to the server
                                                    success: function (response) {
                                                        $('#room').html(response);  // Update room dropdown with the fetched room options
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label" for="input01">Day of Lecture:</label>
                                        <div class="controls">
                                            <select style="width: 82%;" id="schedule-day-input" name="day_of_week"
                                                required>
                                                <option value="Sunday">Sunday</option>
                                                <option value="Monday">Monday</option>
                                                <option value="Tuesday">Tuesday</option>
                                                <option value="Wednesday">Wednesday</option>
                                                <option value="Thursday">Thursday</option>
                                                <option value="Friday">Friday</option>
                                                <option value="Saturday">Saturday</option>
                                            </select>
                                        </div>
                                        <script>
                                            // Show and hide the dropdown list
                                            document.getElementById("schedule-day-input").addEventListener("click", function () {
                                                const list = document.getElementById("checkbox-list");
                                                list.style.display = (list.style.display === "none" || list.style.display === "") ? "block" : "none";
                                            });

                                            // Update the input field with selected days
                                            const checkboxes = document.querySelectorAll(".checkbox");
                                            checkboxes.forEach(function (checkbox) {
                                                checkbox.addEventListener("change", function () {
                                                    const selectedDays = [];
                                                    checkboxes.forEach(function (checkbox) {
                                                        if (checkbox.checked) {
                                                            selectedDays.push(checkbox.value);
                                                        }
                                                    });
                                                    document.getElementById("schedule-day-input").value = selectedDays.join(", ");
                                                });
                                            });

                                            // Close the dropdown if clicking outside
                                            window.addEventListener("click", function (e) {
                                                const dropdown = document.getElementById("checkbox-list");
                                                if (!dropdown.contains(e.target) && e.target !== document.getElementById("schedule-day-input")) {
                                                    dropdown.style.display = "none";
                                                }
                                            });
                                        </script>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="input01">Time Start:</label>
                                        <div class="controls">
                                            <input type="time" id="start-time" name="start_time" style="width: 40%;"
                                                required>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="input01">Time End:</label>
                                        <div class="controls">

                                            <input type="time" id="end-time" name="end_time" style="width: 40%;"
                                                required>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="input01">Teacher:</label>
                                        <div class="controls">
                                            <select id="teacher" class="span3333" name="teacher"
                                                onchange="fetchSubjects()">
                                                <option value="">Select Teacher</option>
                                                <?php
                                                // Fetch teachers from the database
                                                include_once('fetch_teachers.php');
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="input01">Rooms:</label>
                                        <div class="controls">
                                            <select id="subject" name="subject" required>
                                                <option value="">Select Subject</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- JavaScript -->
                                    <script>
                                        function fetchSubjects() {
                                            var TeacherID = $('#teacher').val();  // Get selected teacher ID
                                            $('#subject').html('<option>Loading...</option>'); // Show loading message in subject dropdown

                                            $.ajax({
                                                url: 'fetch_subjects.php', // The PHP file that handles fetching subjects
                                                type: 'GET',
                                                data: { TeacherID: TeacherID },  // Send selected teacher ID to the server
                                                success: function (response) {
                                                    $('#subject').html(response);  // Update subject dropdown with the fetched subject options
                                                }
                                            });
                                        }
                                    </script>


                                    <div class="control-group">
                                        <div class="controls">
                                            <button id="save_voter" class="btn btn-primary" name="save"><i
                                                    class="icon-save icon-large"></i>Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </fieldset>
        </form>
    </div>
</div>

</div>
</li>
</ul>
</div>
</fieldset>
</form>
</div>
</div>

<script>
</script>

<?php include('footer.php'); ?>
<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3> </h3>
    </div>
    <div class="modal-body">
        <p>
            <font color="gray">Are You Sure you Want to LogOut?</font>
        </p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">No</a>
        <a href="logout.php" class="btn btn-primary">Yes</a>
    </div>
</div>

</html>
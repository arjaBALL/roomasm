<?php
include('./connection/session.php');
include('./components/header.php');
include('./connection/dbcon.php');
include('./components/nav-top1.php');
include('./components/main.php');
?>

<div class="wrapper">
	<div id="element" class="hero-body-subject-add">
		<div class="nav-content">
			<h2>
				<font color="black">Add Subject</font>
			</h2>
			<a class="btn btn-primary" href="subject.php"><i class=" icon-arrow-left icon-large"></i>&nbsp;Back</a>
			<hr>
			<form id="save_voter" class="form-horizontal" method="POST" action="save_subject.php">
				<fieldset>
					</br>
					<div class="add_subject">
						<ul class="thumbnails_new_voter">
							<li class="span3">
								<div class="thumbnail_new_voter">
									<div class="control-group">
										<label class="control-label" for="input01">Subject Name:</label>
										<div class="controls">
											<input type="text" name="subjectName" required class="Subject_Code"
												id="span900">
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="input01">Subject Description:</label>
										<div class="controls">
											<input type="text" name="subjectDescription" class="subjectDescription"
												id="span9009">
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="input01">Teacher:</label>
										<div class="controls">
											<select id="select-teacher" class="span3333" name="teacherID" required>
												<option value="">Select a Teacher</option>
												<?php
												include 'fetch_teacher.php';
												while ($teacher = $teachers_result->fetch_assoc()) { ?>
													<option value="<?php echo $teacher['TeacherID']; ?>">
														<?php echo $teacher['TeacherName']; ?>
													</option>
												<?php } ?>
											</select>
										</div>
									</div>



									<div class="control-group">
										<div class="controls">
											<button id="save_voter" class="btn btn-primary" name="save"><i
													class="icon-save icon-large"></i>Save</button>
										</div>
									</div>


				</fieldset>
			</form>


		</div>





	</div>
</div>
</body>
<div class="modal hide fade" id="myModal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">�</button>
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
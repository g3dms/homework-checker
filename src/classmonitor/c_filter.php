<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<title>View Due Homework</title>
	<link rel="stylesheet" href="../styles.css">
	<link rel="icon" type="image/x-icon" href="https://file.garden/ZxeJbwpMpVUTaKTZ/LogoShort.png">
</head>


<body>

	<div id="headerArea">
		<div id="header">
			<div class="child">
				<img src="https://file.garden/ZxeJbwpMpVUTaKTZ/LogoLong.png" style="height: 8rem; width: auto">
			</div>


			<div class="child">
				<?php
				include("../connection.php");

				$servername = "localhost";
				$username = "root";
				$password = "";
				$db_name = "ictsba";
				$conn = mysqli_connect($servername, $username, $password, $db_name, 3306);

				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}

				$q = "SELECT monitorclass, class FROM login WHERE username = '{$_SESSION['user']}'";
				$result = mysqli_query($conn, $q);

				if (mysqli_num_rows($result) > 0) {

					$subject = "";

					while ($row = mysqli_fetch_assoc($result)) {
						// Get class
						$class = $row["class"];
						echo "Welcome, Student (" .  $class . ")";
						echo "<br><a href=\"../index.php\"><i>Log out?</i><a>";
					}
				}

				$conn->close();
				?>
			</div>
		</div>

		<hr>
		<nav id="navbar">
			<div class="buttons">
				<button id="home"><a href="c_home.php#teleport">Homepage</a></button>
				<button id="add"><a href="c_addhw.php#teleport">Add Homework</a></button>
				<button id="view"><a href="c_viewhw.php#teleport">View & Submit Homework</a></button>
			</div>
		</nav>
		<hr>
	</div>

	<h2 id="teleport">Due homework</h2>
	<form method="POST" action="c_filter.php#teleport">

		<div class="container">
			Filter by subject: <select name="subject" id="subject">
				<option value="all">All</option>
				<option value="eng">English</option>
				<option value="chi">Chinese</option>
				<option value="maths">Maths</option>
				<option value="ls">Liberal Studies</option>
				<option value="csd">CSD</option>
				<option value="pe">P.E.</option>
				<option value="is">Integrated Science</option>
				<option value="chem">Chemistry</option>
				<option value="ict">ICT</option>
				<option value="chist">Chinese History</option>
				<option value="bm">BAFS (BM)</option>
				<option value="ba">BAFS (BA)</option>
				<option value="phys">Physics</option>
				<option value="ths">THS</option>
				<option value="geo">Geography</option>
				<option value="bio">Biology</option>
				<option value="hist">History</option>
				<option value="econ">Economics</option>
				<option value="elit">English Literature</option>
				<option value="m1">M1</option>
				<option value="m2">M2</option>
			</select>
			<br>
		</div>
		<br>

		<input type="submit" id="button" value="Filter" name="filterhw">
	</form>

	<br>


	<form method="POST" action="c_viewhw.php#teleport"> <!--Form: checkboxes for homework-->
		<table align="center">
			<?php
			// Connect to database
			include("../connection.php");

			$servername = "localhost";
			$username = "root";
			$password = "";
			$db_name = "ictsba";
			$conn = mysqli_connect($servername, $username, $password, $db_name, 3306);

			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			// Turning abbreviation into subject name
			$subject_map = [
				'eng' => 'English',
				'chi' => 'Chinese',
				'maths' => 'Maths',
				'ls' => 'Liberal Studies',
				'csd' => 'CSD',
				'pe' => 'P.E.',
				'is' => 'Integrated Science',
				'chem' => 'Chemistry',
				'ict' => 'ICT',
				'chist' => 'Chinese History',
				'bm' => 'BAFS (BM)',
				'ba' => 'BAFS (BA)',
				'phys' => 'Physics',
				'ths' => 'THS',
				'geo' => 'Geography',
				'bio' => 'Biology',
				'hist' => 'History',
				'econ' => 'Economics',
				'elit' => 'English Literature',
				'm1' => 'M1',
				'm2' => 'M2',
			];

			// Homework table: due class subject name instructions
			if ($_POST["subject"] == 'all') {
				$homework_query = "SELECT
								h.id,
								h.due,
								h.class,
								h.subject,
								h.name,
								h.instructions,
								l.E1,
								l.E2,
								l.E3,
								l.E4
							FROM homework h
							JOIN login l ON h.class = l.class
							WHERE
								l.username = '{$_SESSION['user']}';";
			} else {
				$homework_query = "SELECT
						h.id,
						h.due,
						h.class,
						h.subject,
						h.name,
						h.instructions,
						l.E1,
						l.E2,
						l.E3,
						l.E4
					FROM homework h
					JOIN login l ON h.class = l.class
					WHERE
						l.username = '{$_SESSION['user']}'
					AND
						h.subject = '{$_POST['subject']}';";
			}

			$submission_query = "SELECT
							s.homework_id
						FROM submission s
						WHERE
							s.student_id = '{$_SESSION['user']}';";

			$homeworks = mysqli_query($conn, $homework_query);
			$submissions = mysqli_query($conn, $submission_query);

			$submitted_hwids = [];
			while ($submission_row = mysqli_fetch_array($submissions)) {
				array_push($submitted_hwids, $submission_row["homework_id"]);
			}

			if (mysqli_num_rows($homeworks) > 0) {
				echo "<tr>
						<th>Completed?</th>
						<th>Due Date</th>
						<th>Subject</th>
						<th>Assignment Name</th>
						<th>Instructions</th>
						</tr>";

				// Output each row
				while ($homework_row = mysqli_fetch_assoc($homeworks)) {
					// Filtering homework by subjects & electives
					$allowed_subjects = [
						$homework_row['E1'],
						$homework_row['E2'],
						$homework_row['E3'],
						$homework_row['E4'],
						'eng',
						'chi',
						'csd',
						'is',
						'pe',
						'ls'
					];

					if ((in_array($homework_row['subject'], $allowed_subjects))) {
						// Checks if user account & homework id is in submission table
						// If true, echo "Complete"
						// Else, echo a checkbox with value as homework id (id in table homework)
						$hwid = $homework_row['id'];

						// Format date
						$due = !empty($homework_row['due']) && strtotime($homework_row['due']) >= 0 ? $homework_row['due'] : 'N.A.';
						if ($due !== 'N.A.') {
							$due = date('Y-m-d H:i', strtotime($due));
						}

						$abbreviation = $homework_row['subject'];
						$subject = $subject_map[$abbreviation];

						// Output N.A. if instructions are empty
						$instructions = !empty($homework_row['instructions']) ? $homework_row['instructions'] : 'N.A.';

						echo "<tr>";

						if (in_array($homework_row['id'], $submitted_hwids)) {
							echo "<td>Completed</td>";
						} else {
							echo "<td><input type=\"checkbox\" name=\"homework[]\" value=\"{$hwid}\"></td>";
						}

						// Echo due date, subject, assignment name, instructions
						echo "<td>" . ($due) . "</td>";
						echo "<td>" . ($subject) . "</td>";
						echo "<td>" . ($homework_row['name']) . "</td>";
						echo "<td>" . ($instructions) . "</td>";
						echo "</tr>";
					}
				}
				echo "</table>";
			} else {
				// If no homework that matches class found
				echo "No homework found for this subject.<br>";
			}

			?>
			<br><input type="submit" id="button" value="Submit" name="submithw">
	</form>

	<!-- Update submitted homework -->
	<?php
	include('../connection.php');

	if (isset($_POST['submithw'])) {

		// Submitting each homework id as that
		foreach ($_POST['homework'] as $homework_id) {
			$stmt = mysqli_stmt_init($conn);
			$q3 = "INSERT INTO submission (student_id, homework_id) VALUES (?, ?)";

			if (!mysqli_stmt_prepare($stmt, $q3)) {
				die(mysqli_error($conn));
			}

			mysqli_stmt_bind_param($stmt, "ss", $_SESSION['user'], $homework_id);
			mysqli_stmt_execute($stmt);
		}
		exit();
	}

	$_POST['submithw'] = null;

	?>
</body>

</html>
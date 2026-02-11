<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<title>View All Homework</title>
	<link rel="stylesheet" href="../styles.css">
	<link rel="icon" type="image/x-icon" href="https://file.garden/ZxeJbwpMpVUTaKTZ/LogoShort.png">
</head>

<body style="text-align: center;">

	<div id="headerArea">
		<div id="header">
			<div class="child">
				<img src="https://file.garden/ZxeJbwpMpVUTaKTZ/LogoLong.png" style="height: 8rem; width: auto">
			</div>

			<div class="child">
				Welcome, Teacher
				<br><a href="../index.php"><i>Log out?</i><a>
			</div>

			<hr>
			<nav id="navbar">
				<div class="buttons">
					<button id="home"><a href="t_home.php#teleport">Homepage</a></button>
					<button id="add"><a href="t_addhw.php#teleport">Add Homework</a></button>
					<button id="view"><a href="t_view.php#teleport">View All Homework</a></button>
					<button id="view"><a href="t_check.php#teleport">Check Submissions</a></button>
				</div>
			</nav>
			<hr>
		</div>

		<h2 id="teleport">All homework</h2>
		<!-- Future function: filter by due date -->
		<form method="POST" action="t_filter.php#teleport">
			<div class="row">
				<div class="column">
					<div class="container">
						Filter by subject: <select name="subject" id="subject">
							<option value="allsub">All</option>
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

				</div>
				<div class="column">
					<div class="container">
						Filter by class: <select name="class" id="class">
							<option value="allclass">All</option>
							<option value="S1G1">S1G1</option>
							<option value="S1G2">S1G2</option>
							<option value="S1G3">S1G3</option>
							<option value="S1G4">S1G4</option>
							<option value="S2G1">S2G1</option>
							<option value="S2G2">S2G2</option>
							<option value="S2G3">S2G3</option>
							<option value="S2G4">S2G4</option>
							<option value="S3A">S3A</option>
							<option value="S3B">S3B</option>
							<option value="S3C">S3C</option>
							<option value="S4A">S4A</option>
							<option value="S4B">S4B</option>
							<option value="S4C">S4C</option>
							<option value="S5A">S5A</option>
							<option value="S5B">S5B</option>
							<option value="S5C">S5C</option>
							<option value="S6A">S6A</option>
							<option value="S6B">S6B</option>
							<option value="S6C">S6C</option>

						</select>

					</div>
					<br>

				</div>
			</div>
			<input type="submit" id="button" value="Filter" name="filterhw">
			<br>
		</form>

		<br>

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

			// Filter by class
			// homework: due class subject name instructions
			$q = "SELECT * FROM homework h;";


			//SELECT db1.table1.column1, db2.table2.column2 FROM db1.table1 JOIN db2.table2 ON db1.table1.common_column = db2.table2.common_column;
			$result = mysqli_query($conn, $q);

			// Further filter by extra subjects / electives should be added in query

			if (mysqli_num_rows($result) > 0) {
				echo "<tr>
				<th>Due Date</th>
                <th>Class</th>
				<th>Subject</th>
				<th>Assignment Name</th>
				<th>Instructions</th>
				</tr>";

				// Output each row
				while ($row = mysqli_fetch_assoc($result)) {
					// Format date
					$due = !empty($row['due']) && strtotime($row['due']) >= 0 ? $row['due'] : 'N.A.';
					if ($due !== 'N.A.') {
						$due = date('Y-m-d H:i', strtotime($due)); // Format the date
					}

					// Associative array to map abbreviations to full subject names
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

					$abbreviation = $row['subject'];
					$subject = $subject_map[$abbreviation];
					$instructions = !empty($row['instructions']) ? $row['instructions'] : 'N.A.';

					// Output everything
					echo "<tr>";
					echo "<td>" . ($due) . "</td>";
					echo "<td>" . ($row['class']) . "</td>";
					echo "<td>" . ($subject) . "</td>";
					echo "<td>" . ($row['name']) . "</td>";
					echo "<td>" . ($instructions) . "</td>";
					echo "</tr>";
				}
			}
			echo "</table>";


			?>

		</table>
</body>

</html>
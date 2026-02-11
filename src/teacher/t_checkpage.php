<!DOCTYPE html>
<html>

<head>
    <title>Check Submissions</title>
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
             l.username = '{$_POST['stuid']}';";

            $submission_query = "SELECT
                 s.homework_id
            FROM submission s
            WHERE
                s.student_id = '{$_POST['stuid']}';";

            $student_query = "SELECT username FROM login;";

            $homeworks = mysqli_query($conn, $homework_query);
            $submissions = mysqli_query($conn, $submission_query);
            $students = mysqli_query($conn, $student_query);

            $submitted_hwids = [];

            while ($submission_row = mysqli_fetch_array($submissions)) {
                array_push($submitted_hwids, $submission_row["homework_id"]);
            }

            if (mysqli_num_rows($homeworks) > 0) {
                echo "<h2 id=\"teleport\">" . $_POST["stuid"] . "'s Homework</h2>";
                echo "<tr><th>Completed?</th><th>Subject</th><th>Due Date</th><th>Assignment</th><th>Instructions</th></td>";

                while ($homework_row = mysqli_fetch_assoc($homeworks)) {
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
                    $abbreviation = $homework_row['subject'];
                    $subject = $subject_map[$abbreviation];

                    if (in_array($homework_row['subject'], $allowed_subjects)) {
                        echo "<tr>";

                        if (in_array($homework_row['id'], $submitted_hwids)) {
                            echo "<td style=\"color:green;\">Completed</td>";
                        } else {
                            echo "<td style=\"color:red;\">Incomplete</td>";
                        }
                        $due = !empty($homework_row['due']) && strtotime($homework_row['due']) >= 0 ? $homework_row['due'] : 'N.A.';
                        if ($due !== 'N.A.') {
                            $due = date('Y-m-d H:i', strtotime($due));
                        }

                        $instructions = !empty($homework_row['instructions']) ? $homework_row['instructions'] : 'N.A.';

                        echo "<td>" . ($subject) . "</td>";
                        echo "<td>" . ($due) . "</td>";
                        echo "<td>" . ($homework_row['name']) . "</td>";
                        echo "<td>" . ($instructions) . "</td>";
                        echo "</tr>";
                    }
                }
            } else {
                echo "<br><h2>This student has no homework /<br>Please enter a valid student ID</h2>";
            }

            ?>
        </table>
        <br><a href="t_check.php#teleport"><button>Back</button></a>



</body>

</html>
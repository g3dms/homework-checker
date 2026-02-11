<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Homepage</title>
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

    <h2 id="teleport">Homepage</h2>
    <div class="row">
        <div class="column">
            <div class="container">
                <h3>Where to?</h3>

                <p><a href="c_addhw.php">Add Homework</a></p>
                <p><a href="c_viewhw.php">View & Submit Homework</a></p>
            </div>
        </div>
        <div class="column">
            <div class="container">
                <h2>You have
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

                    $finishedhomeworks_query = "SELECT * FROM submission WHERE student_id = '{$_SESSION['user']}';";

                    $homework_query = "SELECT
							*
						FROM homework h
						JOIN login l ON h.class = l.class
						WHERE
							l.username = '{$_SESSION['user']}';";

                    $homeworks = mysqli_query($conn, $homework_query);
                    $finishedhomeworks = mysqli_query($conn, $finishedhomeworks_query);
                    $count = 0;

                    while ($homework_row = mysqli_fetch_assoc($homeworks)) {
                        if ((mysqli_num_rows($homeworks) > 0) && (mysqli_num_rows($finishedhomeworks) > 0)) {

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

                            if (in_array($homework_row['subject'], $allowed_subjects)) {
                                $count += 1;
                            }

                            $homeworks_count = $count;
                            $finishedhomeworks_count = mysqli_num_rows($finishedhomeworks);
                        }
                    }

                    if ($count - $finishedhomeworks_count == 0) {
                        echo "no";
                    } else {
                        echo $count - $finishedhomeworks_count;
                    }


                    ?>
                    due homework(s)</h2>
            </div>
        </div>
    </div>

</body>

</html>
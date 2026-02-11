<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Add Homework</title>
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

  <h2 id="teleport">Homework input</h2>

  <div class="container">
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
        // Get class & monitor subject from username
        $subject = $row["monitorclass"];
        $class = $row["class"];
        $subjecti = $row["monitorclass"];

        // Associative array to map abbreviations to full subject names
        $subject_map = [
          'eng' => 'English',
          'chi' => 'Chinese',
          'maths' => 'Maths',
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

        $abbreviation = $row['monitorclass'];
        $subject = isset($subject_map[$abbreviation]) ? $subject_map[$abbreviation] : $abbreviation;

        echo "Class: " .  $class
          . "<br>Subject: " . $subject . "<br>";
      }
    }

    $conn->close();

    ?>

    <!--  WHERE username = '{$_SESSION['user']}' AND password = '{$_SESSION['pass']}'; -->
    <form method="POST">

      <!-- Monitors can only add assignments to their monitor class & subject -->

      Assignment name: <br> <input type="text" id="name" name="name" required>
      <br>

      Instructions: <br> <input type="textarea" id="instructions" name="instructions">
      <br>

      Due date: <br> <input type="datetime-local" id="due" name="due">
      <br>

      <br><input type="submit">

    </form>
  </div>

  <?php
  // INSERT INTO TABLE: due, class, subject, name, instructions
  // class & subject automatically added from login table into homework table
  include('../connection.php');

  if (isset($_POST['due']) && isset($_POST['name']) && isset($_POST['instructions'])) {

    $stmt = mysqli_stmt_init($conn);
    $q = "INSERT INTO homework (due, class, subject, name, instructions) VALUES (?, ?, ?, ?, ?)";

    if (!mysqli_stmt_prepare($stmt, $q)) {
      die(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "sssss", $_POST['due'], $class, $subjecti, $_POST['name'], $_POST['instructions']);
    mysqli_stmt_execute($stmt);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
  }
  ?>

</body>

</html>
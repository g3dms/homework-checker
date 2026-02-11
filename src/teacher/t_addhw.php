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

    <h2 id="teleport">Homework input</h2>

    <div class="container">
      <form method="POST">

        Class: <br> <select name="class" id="class">
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
        <br>

        Subject: <br> <select name="subject" id="subject">
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

    include('../connection.php');

    if (isset($_POST['due']) && isset($_POST['name']) && isset($_POST['instructions'])) {

      $stmt = mysqli_stmt_init($conn);
      $q = "INSERT INTO homework (due, class, subject, name, instructions) VALUES (?, ?, ?, ?, ?)";

      if (!mysqli_stmt_prepare($stmt, $q)) {
        die(mysqli_error($conn));
      }

      mysqli_stmt_bind_param($stmt, "sssss", $_POST['due'], $_POST['class'], $_POST['subject'], $_POST['name'], $_POST['instructions']);
      mysqli_stmt_execute($stmt);
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      die();
    }
    ?>

</body>

</html>
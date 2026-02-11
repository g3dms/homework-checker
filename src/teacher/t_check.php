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

    <!-- 
  Things to add:
  Input student ID -> Output all their homework & completion status    
  -->

    <h2 id="teleport">Check submissions</h2>

    <div class="container">
      <form method="POST" style="font-size: 1rem;" action="t_checkpage.php#teleport">
        Student ID: <input type="text" id="stuid" name="stuid">
        <input type="submit">
      </form>
    </div>

</body>

</html>
<?php      
	session_start();

	include('connection.php');

	if(isset($_POST['submit'])){
		$username = $_POST['user'];  
		$password = $_POST['pass'];

        $username = mysqli_real_escape_string($conn, $username);  
        $password = mysqli_real_escape_string($conn, $password);

		$_SESSION['user'] = $username;
		$_SESSION['pass'] = $password;
      
        $sql = "SELECT * from login where username = '$username' and password = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
		if($row["monitorbool"]==1){
			header("location:classmonitor/c_home.php");
		}
		elseif($row["usertype"]=="teacher"){
			header("location:teacher/t_home.php");
		}
		elseif($row["usertype"]=="student"){
			header("location:student/s_home.php");
		}else{
			header("location:index_w.php");
		}

	}
?>  

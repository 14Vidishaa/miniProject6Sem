<?php
session_start();


$host = 'localhost';
$username = 'root';
$password = '';
$database = 'voting';


$mysqli = new mysqli($host, $username, $password, $database);


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$mobile = $_POST['mobile'];
$password = $_POST['pass'];
$role = $_POST['type'];


$query = "SELECT * FROM user WHERE mobile='$mobile'";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

  
    if ($password == $row['password'] && $role == $row['role']) {
        
        $groups_query = "SELECT * FROM user WHERE role=2";
        $groups_result = $mysqli->query($groups_query);
        $groupsdata = $groups_result->fetch_all(MYSQLI_ASSOC);

        
        $_SESSION['userdata'] = $row;
        $_SESSION['groupsdata'] = $groupsdata;

        
        header("Location: dashboard.php");
       
    } else {
        
        echo '<script>alert("Wrong password or wrong role"); window.location = "index.html";</script>';
    }
} else {
   
    echo '<script>alert("Not registered mobile number"); window.location = "index.html";</script>';
}


$mysqli->close();
?>

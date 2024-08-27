<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();


        $connection = mysqli_connect("localhost", "root", "", "voting");

        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        

        $votes = $_POST['gvotes'];
        $total_votes = $votes + 1;

        $gid = $_POST['gid'];
        $uid = $_SESSION['userdata']['id'];

       
        $update_votes = mysqli_query($connection, "UPDATE user SET votes='$total_votes' WHERE id='$gid'");

        $update_user_status = mysqli_query($connection, "UPDATE user SET status=1 WHERE id='$uid'");

        
        if ($update_user_status && $update_votes) {
           
            $groups_query = "SELECT * FROM user WHERE role=2";
            $groups_result = mysqli_query($connection, $groups_query);
            $groupsdata = mysqli_fetch_all($groups_result, MYSQLI_ASSOC);

            
            $_SESSION['userdata']['status'] = 1;
            $_SESSION['groupsdata'] = $groupsdata;

           
            echo '<script>alert("Votes updated successfully"); window.location = "dashboard.php";</script>';
        } else {
            
            echo '<script>alert("Failed to update votes or user status"); window.location = "dashboard.php";</script>';
        }

        mysqli_close($connection);
    ?>
</body>
</html>



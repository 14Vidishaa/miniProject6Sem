<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $name = $_REQUEST['name'];
        $mobile = $_REQUEST['mobile'];
        $pass = $_REQUEST['password'];
        $cpass = $_REQUEST['cpass'];
        $address = $_REQUEST['address'];
        $image = $_FILES['photo']['name'];
        $tmp_name = $_FILES['photo']['tmp_name'];
        $role = $_REQUEST['role'];

        if($pass==$cpass){
             move_uploaded_file($tmp_name,"uploads/$image");

            $connection = mysql_connect("localhost","root","","voting");
            $db = mysql_select_db("voting",$connection);
         
            $query = "INSERT into user value(0,'$name','$mobile','$pass','$address','$image','$role',0,0)"; 
            $result = mysql_query($query) or die("Query Failed".mysql_error());
            if($result){
                echo '<script>
                alert("Registration Successfull");
                window.location = "index.html";
            </script>';
            }
            else{
                echo '<script>
                alert("some error occured");
                window.location = "register.html";
            </script>';
            }
        }
        else{
            // echo "passsword and comfirm password are not same";
            echo '<script>
                alert("password or confrim password are not same");
                window.location = "register.html";
            </script>';
        }

         
    ?>
</body>
</html>
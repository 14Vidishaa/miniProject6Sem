
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>

<style>
    #backbtn{
        border-radius: 5px;
        width : 60px;
        background-color: rgb(43, 121, 157);
        color: white;
        font-size: 15px;
        float : left;
        margin : 10px;
    }

    #logoutbtn{
        border-radius: 5px;
        width : 60px;
        background-color: rgb(43, 121, 157);
        color: white;
        font-size: 15px;
        float : right;
        margin : 10px;
    }  
    #profile{
        background-color: white;
        width: 30%;
        padding: 20px;
        margin-left : 20px;
        margin-top : 20px;
        float : left;
    }

    #group{
        background-color: white;
        width: 60%;
        padding: 20px;
        margin-top : 20px;
        float : right;
    }

    #votebtn{
        border-radius: 5px;
        width : 60px;
        background-color: rgb(43, 121, 157);
        color: white;
        font-size: 15px;
        
    }

    #voted{
        border-radius: 5px;
        width : 60px;
        background-color: green;
        color: white;
        font-size: 15px;
    }

  
</style>


<?php
    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location: index.html");
    }

    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];

    if($_SESSION['userdata']['role']==2){
        $status = '<b style ="color:black">group</b>';
    }
    elseif($_SESSION['userdata']['status']==0){
        $status = '<b style="color:red">Not Voted</b>';
    }
    else{
        $status = '<b style="color:green">Voted</b>';
    }

?>
<div id="mainSection">
    <center>
    <div id="headerSection">
        <a href="../"><button id="backbtn">Back</button></a>
        <a href="logout.php"><button id="logoutbtn">Logout</button></a>
        <h1>Online Voting System</h1>
    </div>
</center>
    <hr>
    <div id="profile">
            <center><img src="uploads/<?php echo $userdata['photo'] ?>" height="200px" width="200px"><br><br></center>
            <b>Name : </b> <?php echo $userdata['name']  ?><br><br>
            <b>Mobile : </b> <?php echo $userdata['mobile']  ?><br><br>
            <b>Address : </b><?php echo $userdata['address']  ?><br><br>
            <b>Status : </b><?php echo $status  ?><br><br>
    </div>
    <div id="group">
        
          <?php
          
            if($_SESSION['groupsdata'] && $_SESSION['userdata']['role']!=2){
                
                for($i=0; $i<count($groupsdata); $i++){
                   ?>
                   <div>
                        <img style="float: right" src="uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100">
                        <b>Group Name : </b><?php echo $groupsdata[$i]['name']?><br><br>
                        <b>Votes : </b><?php echo $groupsdata[$i]['votes']?><br><br>
                        <form method="POST" action="vote.php">
                            <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                            <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">  

                            <?php
                                if($_SESSION['userdata']['status']==0){
                                    ?>
                                    <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                    <?php
                                }
                               
                                elseif ($_SESSION['userdata']['role']==2){ ?>
                                    <button disabled type="button" name="votebtn" value="Vote" id="voted">Group</button>
                                    <?php
                                }
                                else{
                                    ?>
                                    <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>
                                    <?php
                                }
                            ?>


                           
                        </form><br><br>
                        <hr>
                    </div>
                   <?php
                }
            }
            else{
                echo "Total number of votes : ";
                echo $_SESSION['userdata']['votes'];
            }
          ?>
    </div>
</div>

</body>
</html>
<?php
session_start();

include("connection.php");
include("function.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{

    //something was posted
    $Firstname = $_POST['Firstname'];
    $Laststname = $_POST['Laststname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($Lastname) && && !empty($email) !empty($password))
    {
        //read from database
        $userID = random_num(20);
        $query = "select * from users where email = '$email' limit 1";
        $result = mysqli_query($con, $query);

        

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);

                if($user_data['password'] === $password)
                {

                    $_SESSION['userID'] = $user_data['userID'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        echo "wrong username or password";
    }else
    {
        echo "Please enter valid information";
    }
}


?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<style type="text/css">

 #text{
    height: 25px;
    border-radius: 5px;
    padding:4px;
    border: solid thin #aaa;
    width: 100%;
}

#button{
    padding: 10px;
    width: 100px;
    color: white;
    background-color: Lightblue;
    border: none;
}

#box{
    background-color: grey;
    margin: auto;
    width: 300px;
    padding: 20px;
}
</style>

<div id="box">

<form method="post">
    <div style="font-size: 20px; margin: 10px; color: white;">Login</div>
    <input id="text" type="text" name="user_name"><br><br>
    <input id="text" type="password" name="password"><br><br>
    <input id="button" type="submit" value="Login"><br><br>

    <a href="signup.php">Click to Signup</a>
</form>
</div>
    
</body>
</html>
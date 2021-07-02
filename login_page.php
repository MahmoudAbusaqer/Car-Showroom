<?php
$conn = new mysqli("localhost", "root", "", "car_showroom");
$is_found = false;
$select = "Select * from `users` ";
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $selectByUsernameQuery = "SELECT * FROM `users` where `username`='".$username."';";
    if($result = $conn->query($selectByUsernameQuery)){
        while ($row = $result->fetch_row()){
            if ($row[1] == $username && $row[2] == $password){
                header('REFRESH:0; URL=view_cars.php');
                $is_found = true;
                break;
            }
        }
        if ($is_found == false){
            echo "<script> alert('Username or Password is wrong') </script>";
        }
    }
}
if(isset($_POST['rem']) ){
    setcookie("name",$_POST['username'],time()+6000);
    setcookie("pass",$_POST['password'],time()+6000);
}
    ?>
<!DOCTYPE html>
<html lang="">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.css">
    <title>Log In</title>
    <style>
        body {
            margin: 0;
            width: 100%;
            height: 100vh;
            font-family: "Exo", sans-serif;
            background-color: rgba(0, 0, 0, 0.8);
        }
        .bigbackground {
            background-color: rgba(0, 0, 0, 0.8);
            background-image: url(images/login-page-image.jpg);
            background-size: cover;
            background-position: center;
            box-shadow: 0px 0px 10px #000;
            position: absolute;
            top: 0px;
            left: 0px;
            bottom:0px;
            width: 830px;
            height: auto;

        }
        .smallbackground {
            margin: auto;
            padding: 40px;
            border-radius: 5px;
            position: absolute;
            top: 100px;
            left: 850px;
            right: 50px;
            width: 500px;
        }

        .smallbackground .header-text {
            font-size: 32px;
            font-weight: 600;
            padding-bottom: 40px;
            text-align: center;
        }

        #remember{
            margin: -10px 0px;
            width: 10%;
        }
        .smallbackground input {
            padding: 10px;
            margin: 15px 0px;
            border-radius: 10px;
            width: 95%;
            font-size: 16px;
            font-family: 'Sans-serif';
            text-align: center;
        }

        .smallbackground button {
            background-color: #0099e5;
            color: #fff;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            width: 50%;
            font-size: 18px;
            padding: 10px;
            margin: 10px 95px;
        }
        h1{
            color: white;
            font-family: 'Sans-serif';
            font-weight: bolder;
        }
        label{
            color: white;
        }
        p{
            font-family: 'Times New Roman';
            font-size: 18px;
            font-weight: bolder;
        }
    </style>
</head>

<body>
<div class="bigbackground">
    <div class="smallbackground">
        <div class="header-text"><h1>Login Here</h1></div>
        <form name="userLogin" method="post">
            <input type="text" placeholder="Username" id="username" name="username" value="<?php if (isset($_COOKIE['name'])){echo $_COOKIE['name'];}?>">
            <input type="password" placeholder="Password" id="password"name="password" value="<?php if (isset($_COOKIE['pass'])){echo $_COOKIE['pass'];}?>">
            <span><input type="checkbox" id="remember" name="rem" <?php if (isset($_COOKIE['name'])){?>checked <?php } ?>><label>Remember me</label></span>
            <button type="submit" id="button" value="login" name="login">Login</button>
        </form>
    </div>
</div>
</body>
</html>

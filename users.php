<?php
$conn = new mysqli("localhost", "root", "", "car_showroom");
if ($conn -> connect_error){
     die("Connection failed: ".$conn->connect_error);
}
$id = "";
$username = "";
$password = "";
$full_name = "";
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $selectByIdQuery = "SELECT * FROM `users` where `id`='".$id."';";
    if($result = $conn->query($selectByIdQuery)){
        while ($row = $result->fetch_row()){
            $username = $row[1];
            $password = $row[2];
            $full_name = $row[3];
        }
    }
}
if (isset($_POST['add'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];
    $insertQuery = "INSERT INTO `users` (`username`, `password`, `full_name`) VALUES('$username', '$password', '$full_name')";
    $conn->query($insertQuery);
    header('REFRESH:3');
    echo "This user user successfully added into the System";
}
if (isset($_POST['update'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];
    $updateQuery = "UPDATE `users` SET username='$username', password='$password', full_name='$full_name' where id =".$id;
    $conn->query($updateQuery);
    header('REFRESH:3; URL=users.php');
    echo "This user was successfully updated<br><br>";
}
if (isset($_POST['delete']) && isset($_GET['id'])){
    $deleteQuery = "DELETE FROM `users` where  `id`='".$_GET['id']."';";
    $conn->query($deleteQuery);
    header('REFRESH:3; URL=users.php');
    echo "This user was successfully deleted<br><br>";
}
if (isset($_POST['view'])){
    header('REFRESH:0 URL= view_cars.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
</head>
<body>
    <h1>Website Users Information</h1>
    <form method="post">
    Username: <input type="text" placeholder="Username" name="username" value="<?php echo $username;?>"><br><br>
    Password: <input type="text" placeholder="Password" name="password" value="<?php echo $password; ?>"><br><br>
    Full Name: <input type="text" placeholder="Full Name" name="full_name" value="<?php echo $full_name; ?>"><br><br>
    <input name="add" type="submit" value="Add User">
    <input name="update" type="submit" value="Update User">
    <input name="delete" type="submit" value="Delete User"><br><br>
        <input name="view" type="submit" value="View Cars">
    </form><br><br>

<?php
echo "<table border='1''>";
echo  "<tr>";
echo    "<th>Username</th>";
echo    "<th>Password</th>";
echo    "<th>Full Name</th>";
echo    "<th>Select</th>";
//echo    "<th>Delete</th>";
echo  "</tr>";
$query = "Select * from `users`";
if($result = $conn->query($query)){
    while ($row = $result->fetch_row()){
        echo "<tr>";
        echo    "<td>". $row[1]."</td>";
        echo    "<td>".$row[2]."</td>";
        echo    "<td>".$row[3]."</td>";
        echo    "<td><a href='?id=".$row[0]."'><input type='submit' name='select' value='Select'></a></td>";
        echo "</tr>";
    }
}

$conn->close();
?>

</body>
</html>

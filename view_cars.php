<?php
$conn = new mysqli("localhost", "root", "", "car_showroom");
if ($conn -> connect_error){
     die("Connection failed: ".$conn->connect_error);
}
if (isset($_POST['add'])){
    header('REFRESH:0 URL= add_car.php');
}if (isset($_POST['view_Users'])){
    header('REFRESH:0 URL= users.php');
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View All Cars</title>
</head>
<body>
    <h1>All Cars</h1>

<?php
echo "<table border='1''>";
echo  "<tr>";
echo    "<th>Manufacturer</th>";
echo    "<th>Model</th>";
echo    "<th>Price</th>";
echo    "<th>Image</th>";
echo    "<th>Delete</th>";
echo    "<th>Update</th>";
echo  "</tr>";
$query = "Select * from `cars`";
if($result = $conn->query($query)){
    while ($row = $result->fetch_row()){
        echo "<tr>";
        echo    "<td>". $row[1]."</td>";
        echo    "<td>".$row[2]."</td>";
        echo    "<td>".$row[3]."</td>";
        echo    "<td><img src='images/".$row[4]."' alt='image of a car'></td>";
        echo    "<td><a href='?id=".$row[0]."'><input type='submit' name='delete' value='Delete'></a></td>";
        echo    "<td><a href='update_car.php?id=".$row[0]."'><input type='submit' name='update' value='Update'></a></td>";
        echo "</tr>";
    }
}
if(isset($_GET['id'])){
    $deleteQuery = "DELETE FROM `cars` where  `id`='".$_GET['id']."';";
    $conn->query($deleteQuery);
    header('REFRESH:3; URL=view_cars.php');
    echo "This car was successfully deleted<br><br>";
}
$conn->close();
?>
<form method="post">
    <input name="add" type="submit" value="Add New Car">
    <input name="view_Users" type="submit" value="View Users"><br>
</form>
</body>
</html>

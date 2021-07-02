<?php
$conn = new mysqli("localhost", "root", "", "car_showroom");
if ($conn -> connect_error){
     die("Connection failed: ".$conn->connect_error);
}
if (isset($_POST['add'])){
    $manufacturer = $_POST['manufacturer'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $insertQuery = "INSERT INTO `cars` (`manufacturer`, `model`, `price`, `image`) VALUES('$manufacturer', '$model', '$price', '$image')";
    $conn->query($insertQuery);
    header('REFRESH:3');
    echo "This Car was successfully added into the System";
    $conn->close();
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
    <title>Add New Car</title>
</head>
<body>
<h1>Add New Car</h1>
<form method="post">
    Manufacturer: <input type="text" placeholder="Manufacturer" name="manufacturer" value="" ><br><br>
    Model: <input type="text" placeholder="Model" name="model" value=""><br><br>
    Price: <input type="text" placeholder="Price" name="price" value=""><br><br>
    Image: <input type="text" placeholder="Image" name="image" value=""><br><br>
    <button name="add" type="submit">Add</button>
    <input name="view" type="submit" value="View Cars">
</form>

</body>
</html>

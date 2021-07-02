<?php
$conn = new mysqli("localhost", "root", "", "car_showroom");
if ($conn -> connect_error){
     die("Connection failed: ".$conn->connect_error);
}
$id = "";
$manufacturer = "";
$model = "";
$price = "";
$image = "";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $selectByIdQuery = "SELECT * FROM `cars` where `id`='".$id."';";
    if($result = $conn->query($selectByIdQuery)){
        while ($row = $result->fetch_row()){
            $manufacturer = $row[1];
            $model = $row[2];
            $price = $row[3];
            $image = $row[4];
        }
    }
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
    <title>Update Car</title>
</head>
<body>
<h1>Update a Car that you selected</h1>
<form method="post">
    Manufacturer: <input type="text" placeholder="Manufacturer" name="manufacturer" value="<?php echo $manufacturer;?>" ><br><br>
    Model: <input type="text" placeholder="Model" name="model" value="<?php echo $model;?>"><br><br>
    Price: <input type="text" placeholder="Price" name="price" value="<?php echo $price;?>"><br><br>
    Image: <input type="text" placeholder="Image" name="image" value="<?php echo $image;?>"><br><br>
    <button class="btn btn-secondary" name="update" href="" type="submit">Update</button>
    <input name="view" type="submit" value="View Cars">
    <?php
    if (isset($_POST['update'])){
        $manufacturer = $_POST['manufacturer'];
        $model = $_POST['model'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $updateQuery = "UPDATE `cars` SET manufacturer='$manufacturer', model='$model', price='$price', image='$image' where id =".$id;
        $conn->query($updateQuery);
        header('REFRESH:3; URL=update_car.php');
        echo "This car was successfully updated<br><br>";
        $conn->close();
    }
    ?>
    <br><br>
</form>
</body>
</html>
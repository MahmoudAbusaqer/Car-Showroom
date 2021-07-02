<?php
$conn = new mysqli("localhost", "root", "", "car_showroom");
if ($conn -> connect_error){
     die("Connection failed: ".$conn->connect_error);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Car Showroom</title>
</head>
<body>
<h1>Welcome to Car Showroom</h1>
<h3>Here you can find any car you want</h3>
<?php
echo "<table border='1''>";
echo  "<tr>";
echo    "<th>Manufacturer</th>";
echo    "<th>Model</th>";
echo    "<th>Price</th>";
echo    "<th>Image</th>";
echo  "</tr>";
$query = "Select * from `cars`";
if($result = $conn->query($query)){
    while ($row = $result->fetch_row()){
        echo "<tr>";
        echo    "<td>". $row[1]."</td>";
        echo    "<td>".$row[2]."</td>";
        echo    "<td>".$row[3]."</td>";
        echo    "<td><img src='images/".$row[4]."'></td>";
        echo "</tr>";
    }
}
$conn->close();
?>
</body>
</html>

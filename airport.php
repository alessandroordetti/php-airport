<?php 

$servername = "localhost";
$username = "alessandro";
$password = "alessandro";
$dbname = "flights_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// If connection gets well echo this below
echo 'Connection success'; 

echo '<br> <br>';

// Selecting all datas from airports table
$sql = 'SELECT flights.price, airports.code, flights.code_arrival FROM airports JOIN flights ON flights.airport_id = airports.id';

// Creating variable object
$result = mysqli_query($conn, $sql);

// Fetching the received datas into a ciclable array
$datas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result from memory
mysqli_free_result($result);

// Close connection with db to avoid overwrite on it
mysqli_close($conn);

// Print on screen the fetched datas that we received
var_dump($datas);

echo '<br> <br>';

// Array of all prices at first empty
$pricesArray = [];

// Array of all codes at first empty
$codesArray = [];

// Collect all prices and codes then pushed them into relative arrays above
foreach ($datas as $data) {
    $prices = $data["price"];
    array_push($pricesArray, $prices);

    $codes = $data["code"];
    array_push($codesArray, $codes);
}

// Combine the two arrays
$combinedArray = array_combine($codesArray, $pricesArray);

// Look for the minimum price in pricesArrays
$lowestPrice = min($pricesArray);

// Finally search the lowest airplane code
$lowestAirplaneCode = array_search($lowestPrice, $combinedArray);




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div id="wrapper">
        <h1>
            L'aereo più economico costa <?php echo $lowestPrice ?>€ e il suo relativo codice è <?php echo $lowestAirplaneCode ?>
        </h1> 
    </div>
</body>
</html>

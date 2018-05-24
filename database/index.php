<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT id, firstname, lastname FROM Suggerimenti";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - " . $row["email"]. " " . $row["testo"]. "  ".$row["data"]."<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!doctype html>
<html>
<head>
<title>CUSTOMER REGISTRATION LIST</title>
</head>
<body>
<h3 align="center">CUSTOMER REGISTRATION LIST</h3>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
//create and execute query
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);
//check if records were returned
if ($result->num_rows > 0) {
//create a table to display the record
echo '<table cellpadding=10 cellspacing=0 border=1 align="center">';
echo '<tr><td align="center"><b>Name</b></td>
<td align="center"><b>No phone</b></td>
<td align="center"><b>Email</b></td>
<td align="center"><b>Room Type </b></td>
<td align="center"><b>Adults</b></td>
<td align="center"><b>Children</b></td>
<td align="center"><b>Check-in</b></td>
<td align="center"><b>Check-out</b></td>
<td align="center"><b>Lunch</b></td>
<td align="center"><b>Dinner</b></td>
</tr>';
// output data of each row
while($row = $result->fetch_assoc()) {
echo '<tr>';
echo '<td align="center">'.$row["name"].'</td>';
echo '<td align="center">'.$row["phone"].'</td>';
echo '<td align="center">'.$row["email"].'</td>';
echo '<td align="center">'.$row["room"].'</td>';
echo '<td align="center">'.$row["adults"].'</td>';
echo '<td align="center">'.$row["children"].'</td>';
echo '<td align="center">'.$row["checkin"].'</td>';
echo '<td align="center">'.$row["checkout"].'</td>';
echo '<td align="center">'.$row["lunch"].'</td>';
echo '<td align="center">'.$row["dinner"].'</td>';
echo '</tr>';
}
}
else {
echo "0 results"; //if no record found in the database
}
//close connection
$conn->close();
echo '<p><a href="adminMenu.php">Back to Main Menu</a></p>';
?>
</body>
</html>
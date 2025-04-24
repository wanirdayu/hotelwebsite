<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'hotel';

// Sambung ke database
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari borang
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$room = $_POST['room'];
$adults = $_POST['adults'];
$children = $_POST['children'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$lunch = isset($_POST['lunch']) ? 1 : 0;
$dinner = isset($_POST['dinner']) ? 1 : 0;
$voucher = $_POST['voucher'];
$payment = $_POST['payment'];

// Harga asas ikut bilik
$prices = [
  "superior-single" => 180,
  "superior" => 200,
  "deluxe" => 280,
  "suite" => 380,
  "family" => 500
];

$days = (strtotime($checkout) - strtotime($checkin)) / (60 * 60 * 24);
$roomPrice = $prices[$room] * $days;
$breakfast = ($adults * 25 + $children * 20) * $days;
$lunchPrice = $lunch ? ($adults * 30 + $children * 25) : 0;
$dinnerPrice = $dinner ? ($adults * 30 + $children * 25) : 0;

$total = $roomPrice + $breakfast + $lunchPrice + $dinnerPrice;

// Simpan dalam database
$stmt = $conn->prepare("INSERT INTO bookings (name, phone, email, room, adults, children, checkin, checkout, lunch, dinner, voucher, payment_method, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssiississsd", $name, $phone, $email, $room, $adults, $children, $checkin, $checkout, $lunch, $dinner, $voucher, $payment, $total);

if ($stmt->execute()) {
  echo "Booking successful! Thank you.";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
<form>
  <input type="button" value="Back to Homepage" onclick="window.location.href='index.html'">
</form>
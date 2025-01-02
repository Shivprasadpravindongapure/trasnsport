<?php
include 'conn.php';

$pickup = $_GET['pickup'];
$dropoff = $_GET['dropoff'];

if (!empty($pickup) && !empty($dropoff) && $pickup !== $dropoff) {
    $sql = "SELECT price FROM ticket_prices WHERE pickup_location = ? AND dropoff_location = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $pickup, $dropoff);
        $stmt->execute();
        $stmt->bind_result($price);
        if ($stmt->fetch()) {
            echo json_encode(["price" => $price]);
        } else {
            echo json_encode(["price" => null]);
        }
        $stmt->close();
    } else {
        echo json_encode(["error" => "Error preparing query"]);
    }
} else {
    echo json_encode(["error" => "Invalid input"]);
}

$conn->close();
?>


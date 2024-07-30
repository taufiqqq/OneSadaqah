<?php
include 'config.php';

header('Content-Type: application/json');

//Database connection
$conn = getDbConnection();

// Fetch all organization
$sql = "SELECT * FROM organization";
$result = $conn->query($sql);
$organization = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $organization[] = $row;
    }
} else {
    echo json_encode([]);
}
echo json_encode($organization);

$conn->close();

?>
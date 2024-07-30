<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';

header('Content-Type: application/json');

$conn = getDbConnection();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input data from the request
    $name = $_POST['name'];
    $walletAddress = $_POST['wallet_address'];
    $ic = $_POST['pic_ic'];
    $pnum = $_POST['pic_pnum'];
    $email = $_POST['pic_email'];
    $description = $_POST['description'];
    $adminref = $_POST['adminref'];

    // Prepare the SQL statement
    $sql = "INSERT INTO organization (name, wallet_address, pic_ic, pic_pnum, pic_email, adminref, description) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("sssssss", $name, $walletAddress, $ic, $pnum, $email, $adminref, $description);

        // Execute the statement
        if ($stmt->execute()) {
            // Successfully inserted
            echo json_encode(['status' => 'success']);
        } else {
            // Failed to insert
            echo json_encode(['status' => 'error', 'message' => 'Failed to insert organization']);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare SQL statement']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

// Close the database connection
$conn->close();
?>
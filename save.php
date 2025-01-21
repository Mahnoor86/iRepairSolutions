<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$server = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

$con = mysqli_connect($server, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $name = isset($_POST['name']) ? mysqli_real_escape_string($con, $_POST['name']) : null;
    $phone_number = isset($_POST['phone']) ? mysqli_real_escape_string($con, $_POST['phone']) : null;
    $issue_and_model = isset($_POST['issues_and_model']) ? mysqli_real_escape_string($con, $_POST['issues_and_model']) : null;
    $address = isset($_POST['address']) ? mysqli_real_escape_string($con, $_POST['address']) : null;

    // Check if all required fields are present
    if ($name && $phone_number && $issue_and_model && $address) {
        $sql = "INSERT INTO repair (name, phone_number, issue_and_model, address) VALUES ('$name', '$phone_number', '$issue_and_model', '$address')";

        if (mysqli_query($con, $sql)) {
            echo "Data submitted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } else {
        echo "All fields are required.";
    }

    mysqli_close($con);
} else {
    echo "No data submitted.";
}
?>

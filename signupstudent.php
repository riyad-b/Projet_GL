<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are filled
    if (isset($_POST["full_name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"]) && isset($_POST["address"]) && isset($_POST["phone"]) && isset($_POST["date_of_birth"])) {
        // Retrieve form data
        $full_name = $_POST["full_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $date_of_birth = $_POST["date_of_birth"];

        // Additional validation if needed
        if ($password !== $confirm_password) {
            // Passwords don't match
            echo "Passwords do not match.";
            exit();
        }

        // Include your database connection file
        include 'connect.php';

        // Prepare and bind the INSERT statement
        $stmt = $con->prepare("INSERT INTO Students (full_name, email, password, address, phone, date_of_birth) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $full_name, $email, $password, $address, $phone, $date_of_birth);

        // Execute the statement
        if ($stmt->execute()) {
            // Successful insertion
            header("Location: dex.html"); // Redirect to a success page
            exit();
        } else {
            // Error in insertion
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $con->close();
    } else {
        // Handle if any field is missing
        echo "All fields are required.";
    }
}
?>

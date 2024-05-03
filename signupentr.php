<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are filled
    if (isset($_POST["id"]) && isset($_POST["name_enterprise"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"]) && isset($_POST["address"]) && isset($_POST["phone"]) && isset($_FILES["avatar"])) {
        // Retrieve form data
        $id = $_POST["id"];
        $name_enterprise = $_POST["name_enterprise"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $avatar = $_FILES["avatar"]["name"]; // Filename of the uploaded file

        // Additional validation if needed
        if ($password !== $confirm_password) {
            // Passwords don't match
            echo "Passwords do not match.";
            exit();
        }

        // Include your database connection file
        include 'connect.php';

        // Prepare and bind the INSERT statement
        $stmt = $con->prepare("INSERT INTO Enterprises (id, name_enterprise, email, password, address, phone, avatar) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $id, $name_enterprise, $email, $password, $address, $phone, $avatar);

        // Execute the statement
        if ($stmt->execute()) {
            // Upload avatar file
            $target_dir = "uploads/"; // Directory where the file will be uploaded
            $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
            move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);

            // Successful insertion
            header("Location: dex entr.html"); // Redirect to a success page
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

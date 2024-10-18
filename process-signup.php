<?php

require "email-verifier.php";

if (empty($_POST['name'])) {
    die("Name is required");
}

// VALIDATING USERS INPUT

if (! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    die("Valid Email required");
}

if (strlen($_POST['password']) < 8) {
    die("Passowrd must be at least 8 characters");
}

if (! preg_match("/[a-z]/i", $_POST['password'])) {
    die("Password must contain at least one Letter");
}

if (! preg_match("/[0-9]/", $_POST['password'])) {
    die("Password must contain at least one number");
}

if ($_POST['password'] !== $_POST['password_confirmation']) {
    die("Passwords must match");
}

// HASHED THE PASSWORD
$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);


// VERIFYING IF THE EMAIL ACTUALLY EXISTS
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the email from the form submission
    $email = $_POST['email'];
    // Call the email verification function
    // If the email is valid then user gets registered
    if (verifyEmail($email)) {

        // CONNECTION OF DATABASE
        $mysqli = require __DIR__ . "/database.php";

        $sql = "INSERT INTO users (fullname, email, password)
        VALUES (?, ?, ?)";

        $stmt = $mysqli->stmt_init();

        // HANDLES ANY ERROR MADE IN THE SQL QUERY
        if (! $stmt->prepare($sql)) {
            die("SQL error {$mysqli->error}");
        }

        $stmt->bind_param(
            "sss",
            $_POST['name'],
            $_POST['email'],
            $password_hash
        );

        try {
            if ($stmt->execute()) {
                header("Location: signup-success.php");
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            // Check if the error is due to a duplicate entry (error code 1062)
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                echo "Email already taken. Please choose another email.";
            } else {
                // Handle other types of exceptions if needed
                echo "An error occurred: " . $e->getMessage();
            }
        }

        // Close the statement and connection (optional but recommended)
        $stmt->close();
        $mysqli->close();
    }else{
        echo "{$_POST['email']} is not a real email ";
        echo "<br><a href='./signup.php'>Back to SignIn Page</a><br>";
    }
}

// VALIDATING AND REGISTERING ENDS HERE

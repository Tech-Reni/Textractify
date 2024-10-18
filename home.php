<?php 

// Check if user is logged in using the cookies
if (isset($_COOKIE['user_id']) && isset($_COOKIE['username']) && isset($_COOKIE['email'])) {
    // User is logged in
    $user_id = $_COOKIE['user_id'];
    $username = $_COOKIE['fullname'];
    $email = $_COOKIE['email'];
    $plan = $_COOKIE['plan_id'];

    if($plan == 1){
        $plan = "FREE";
    }

    echo "Welcome back, $username! Your email is $email and your current plan is $plan.";
} else {
    // No cookies set, redirect to login page
    header('Location: /register');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>Home</h1>
    <p>You are now Logged In</p>
    <p><a href="logout.php">Log Out</a></p>
</body>
</html>
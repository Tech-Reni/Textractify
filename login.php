<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/database.php";

    $sql = sprintf(
        "SELECT * FROM users WHERE email = '%s'",
        $mysqli->real_escape_string($_POST['email'])
    );

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($_POST['password'], $user['password'])) {
            // Fetch user data
            $user_id = $user['id'];
            $username = $user['fullname'];
            $email = $user['email'];
            $plan = $user['plan_id'];  

            // Set cookies securely
            $cookie_time = time() + 86400 * 90; // 90 days
            setcookie('user_id', $user_id, $cookie_time, "/", "", true, true);
            setcookie('fullname', $username, $cookie_time, "/", "", true, true);
            setcookie('email', $email, $cookie_time, "/", "", true, true);
            setcookie('plan_id', $plan, $cookie_time, "/", "", true, true);

            // Redirect to the index.php page or wherever you want to redirect
            header('Location: home.php');
            exit();
        }
    }
    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In Page</title>
    <link rel="stylesheet" href="css/sign_and _login.css">
</head>

<body>
    <div class="login_container">
        <div class="form-container">
            <h2>LOG IN</h2>
            <p>Don't have an account? <a href="./register">SignUp</a></p>

            <?php if($is_invalid): ?>
                <b class="error_message">Invalid login</b>
            <?php endif; ?>

            <form method="post">

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" placeholder="example@gmail.com" name="email" value="<?= htmlspecialchars($_POST['email'] ?? "");?>">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Password" name="password">
                </div>

                <button type="submit" class="sign-up-btn">Log In</button>
            </form>

        </div>

    </div>
</body>

</html>
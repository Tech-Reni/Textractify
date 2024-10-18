<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>
    <link rel="stylesheet" href="css/sign_and _login.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="js/validate.js" defer></script>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Create Account</h2>
            <p>Already have an account? <a href="./login.php">Login</a></p>

            <form action="process-signup.php" method="post" id="signup">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" placeholder="Surname  Firstname" name="name"  required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" placeholder="example@gmail.com" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Password" name="password" >
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation" >
                </div>

                <div class="terms">
                    <input type="checkbox" >
                    <span>I agree to the Terms and Conditions</span>
                </div>

                <button type="submit" class="sign-up-btn">Sign up</button>
            </form>

            <div class="divider">
                <hr>
                <span>Or</span>
                <hr>
            </div>

            <button class="google-signup-btn">
                <img src="img/google-icon.png" alt="Google Icon">
                Sign Up with Google
            </button>
        </div>

        <div class="signup_illustration">
            <img src="img/signup_illustration.svg" alt="">
        </div>
    </div>
</body>

</html>

<?php 

// echo "{$_SERVER['REQUEST_URI']}";
<?php
// Expire the cookies
setcookie('user_id', '', time() - 3600, "/");
setcookie('fullname', '', time() - 3600, "/");
setcookie('email', '', time() - 3600, "/");
setcookie('plan_id', '', time() - 3600, "/");

// Redirect to login page after logout
header('Location: login.php');
exit();

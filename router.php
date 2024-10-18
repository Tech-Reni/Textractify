<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

if($uri === '/Textractor/register'){
    require "signup.php";}
else if ($uri === '/Textractor/login'){
    require "login.php";
} else if ($uri === '/Textractor/') else{
    echo "Page not Found";
}
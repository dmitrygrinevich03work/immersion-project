<?php
function connect()//The function of connecting to the database via PDO
{
    return new PDO('mysql:host=localhost;dbname=immersion;charset=utf8', 'root', '');
}

function redirect_to($path)//Page overload function
{
    return header("Location: $path");
}

function set_flash_message($name, $messages)//flash message creation function
{
    $_SESSION[$name] = $messages;
}

function display_flash_message($name, $kay)//flash message output function
{
    if (isset($_SESSION[$name])) {
        echo "<div class=\"alert alert-{$kay} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset_flash_message($name);
    }

}

function unset_flash_message($name)//flash message deletion function
{
    unset($_SESSION[$name]);
}

function select_email($email)//The function of checking mail in the database
{
    $statment = connect()->prepare("SELECT * FROM users WHERE email=:email");
    $statment->execute(["email" => $email]);
    $users = $statment->fetch(PDO::FETCH_ASSOC);
    return $users;
}

function add_user($email, $password)//user registration, adding a user to the database
{
    $statement = connect()->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
    $statement->execute(["email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT)]);//Hash the password
    redirect_to('../page_register.php');
}

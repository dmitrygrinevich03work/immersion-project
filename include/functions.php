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
    $statement = connect()->prepare("INSERT INTO users (user_name, email, password, role) VALUES (:user_name, :email, :password, :role)");
    $statement->execute(["user_name" => "user",
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT),//Hash the password
        "role" => "user"]);
    redirect_to('../page_register.php');
}

function is_logged_in()
{
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}

function is_admin()
{
    if ($_SESSION['user']['role'] == "admin") {
        return true;
    }
}

function is_logged_and_admin()
{
    if(isset($_SESSION['user']) && $_SESSION['user']['role'] == "admin"){
        return true;
    } else {
        return false;
    }
}

function is_user()
{
    if ($_SESSION['user']['role'] == "user") {
        return true;
    }
}

function select_all_users()//The function of checking mail in the database
{
    $statment = connect()->prepare("SELECT * FROM users");
    $statment->execute();
    $all_user = $statment->fetchAll(PDO::FETCH_ASSOC);
    return $all_user;
}
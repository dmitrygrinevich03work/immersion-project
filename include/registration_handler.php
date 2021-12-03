<?php
session_start();

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

function display_flash_message($name)//flash message output function
{
    echo $_SESSION[$name];
    unset_flash_message($name);
}

function unset_flash_message($name)//flash message deletion function
{
    unset($_SESSION[$name]);
}

/* [ Checking for button clicks ] */
if (isset($_POST['submit'])) {

    $email = $_POST['email'];//Create a mail variable
    $password = $_POST['password'];//Create a password variable

    function select_email($email)//The function of checking mail in the database
    {
        $statment = connect()->query("SELECT * FROM users WHERE email=('$email')");
        $users = $statment->fetch(PDO::FETCH_ASSOC);
        return $users;
    }

    function add_user($email, $password)//user registration, adding a user to the database
    {
        $password = password_hash($password,PASSWORD_DEFAULT);//Hash the password
        $statement = connect()->prepare("INSERT INTO users (email, password) VALUES ('$email' , '$password')");
        $statement->execute($_POST);
        redirect_to('../page_register.php');
    }

    /* [ We fulfill the condition for checking and adding a new user ] */
    if (!empty(select_email($email))) {
        redirect_to('../page_register.php');
        die(set_flash_message('error_get_user_email_msg', 'Notification! This email the address is already taken by another user.'));
    } else {
        add_user($email, $password);
        set_flash_message('success_add_the_user_to_the_table_msg', 'You have successfully registered!');
        redirect_to('../page_register.php');
    }

}
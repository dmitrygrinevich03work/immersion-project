<?php
session_start();
require_once('functions.php');

$email = $_POST['email'];
$password = $_POST['password'];

if (isset($_POST['submit'])) {

    $users = select_email($email);

    if (!$users) {
        set_flash_message('authorisation_error', 'Your email address or password is incorrect!');
        redirect_to('../page_login.php');
        return false;
    }
    if (!password_verify($password, $users['password'])) {
        set_flash_message('authorisation_error', 'Your email address or password is incorrect!');
        redirect_to('../page_login.php');
        return false;
    }
    set_flash_message('authorization_successful', 'You have successfully logged in to the site!');
    $_SESSION['user'] = [
        "id" => $users['id'],
        "email" => $users['email'],
        "role" => $users['role']
    ];
    redirect_to('../users.php');
    return true;

}
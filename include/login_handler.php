<?php
session_start();
require_once('functions.php');

$email = $_POST['email'];
$password = $_POST['password'];

if (isset($_POST['submit'])) {

    $user = select_email($email);

    if (!$user) {
        set_flash_message('authorisation_error', 'Your email address or password is incorrect!');
        redirect_to('../page_login.php');
        return false;
    }
    if (!password_verify($password, $user['password'])) {
        set_flash_message('authorisation_error', 'Your email address or password is incorrect!');
        redirect_to('../page_login.php');
        return false;
    }
    set_flash_message('authorization_successful', 'You have successfully logged in to the site!');
    $_SESSION['user'] = [
        "id" => $user['id'],
        "email" => $user['email']
    ];
    redirect_to('../page_profile.php');
    return true;

}
<?php
session_start();
require_once("functions.php");

$email = $_POST['email'];//Create a mail variable
$password = $_POST['password'];//Create a password variable

/* [ Checking for button clicks ] */
if (isset($_POST['submit'])) {

    /* [ We fulfill the condition for checking and adding a new user ] */
    $select_email = select_email($email);
    if (!empty($select_email)) {
        redirect_to('../page_register.php');
        die(set_flash_message('error_get_user_email_msg', 'Notification! This email the address is already taken by another user.'));
    } else {
        add_user($email, $password);
        set_flash_message('success_add_the_user_to_the_table_msg', 'You have successfully registered!');
        redirect_to('../page_login.php');
    }

}
<?php
session_start();
include_once('functions.php');

$btn = $_POST['create_users'];
$email = $_POST['email'];
$password = $_POST['password'];

if (isset($btn)) {
    if (!select_email($email)) {
        create_users($email, $password);
        set_flash_message('success_create_user', 'Вы успешно добавили Пользователя!');
        return true;
    } else {
        set_flash_message('error_select_email', 'Данный электронный адресс уже занят!');
        redirect_to('../create_user.php');
        return false;
    }
}

function create_info()//Общая информация
{

}

function create_social_network()//Социальные сети
{

}

function create_users($email, $password)//user registration, adding a user to the database
{
    $statement = connect()->prepare("INSERT INTO users (user_name, email, password, role) VALUES (:user_name, :email, :password, :role)");
    $statement->execute(["user_name" => "user",
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT),//Hash the password
        "role" => "user"]);
    redirect_to('../create_user.php');
}
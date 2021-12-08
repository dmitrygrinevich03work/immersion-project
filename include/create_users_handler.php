<?php
session_start();
require_once('functions.php');

$btn = $_POST['create_users'];
$email = $_POST['email'];
$password = $_POST['password'];

function create_info()//Общая информация
{

}

function create_social_network()//Социальные сети
{

}

function create_users($email, $password)//user registration, adding a user to the database
{
//     $conn= new PDO('mysql:host=localhost;dbname=immersion;charset=utf8', 'root', '');//Если я прописываю через данное подключение а не через функцию. то всё работает как нужно
    $statement = connect()->prepare("INSERT INTO users (user_name, email, password, role) VALUES (:user_name, :email, :password, :role)");
    $statement->execute(["user_name" => "user",
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT),//Hash the password
        "role" => "user"]);
    $id = connect()->lastInsertId();//ID не выводит выводит постоянно 0 . Но пользователя в базе создаёт!
    var_dump($id);
}

if (isset($btn)) {
    if (!select_email($email)) {
        create_users($email, $password);
        set_flash_message('success_create_user', 'Вы успешно добавили Пользователя!');
        redirect_to('../create_user.php');
        return true;

    } else {
        set_flash_message('error_select_email', 'Данный электронный адресс уже занят!');
        redirect_to('../create_user.php');
        return false;
    }
}

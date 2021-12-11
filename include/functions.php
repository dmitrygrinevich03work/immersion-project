<?php

function connect() //The function of connecting to the database via PDO
{
    return new PDO('mysql:host=localhost;dbname=immersion;charset=utf8', 'root', '');
}

function redirect_to($path) //Page overload function
{
    return header("Location: $path");
}

function set_flash_message($name, $messages) //flash message creation function
{
    $_SESSION[$name] = $messages;
}

function display_flash_message($name, $kay) //flash message output function
{
    if (isset($_SESSION[$name])) {
        echo "<div class=\"alert alert-{$kay} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset_flash_message($name);
    }

}

function unset_flash_message($name) //flash message deletion function
{
    unset($_SESSION[$name]);
}

function select_email($email) //The function of checking mail in the database
{
    $statment = connect()->prepare("SELECT * FROM users WHERE email=:email");
    $statment->execute(["email" => $email]);
    $users = $statment->fetch(PDO::FETCH_ASSOC);
    return $users;
}

function add_user($email, $password) //user registration, adding a user to the database
{
    $connect = connect();
    $statement = $connect->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
    $statement->execute([
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT),//Hash the password
    ]);
    $_SESSION['user_id'] = $connect->lastInsertId();
    return true;
}

function is_logged_in() //If the person is authorized
{
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}

function is_admin() //If the admin
{
    if ($_SESSION['user']['role'] == "admin") {
        return true;
    }
    return false;
}

function is_logged_and_admin() //If the admin is also logged in
{
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] == "admin") {
        return true;
    } else {
        return false;
    }
}

function select_all_users() //The function of checking mail in the database
{
    $statment = connect()->prepare("SELECT * FROM users");
    $statment->execute();
    $all_user = $statment->fetchAll(PDO::FETCH_ASSOC);
    return $all_user;
}

function create_image($name, $tmp_name) //Loading an image
{
    $connect = connect();
    $name_image = uniqid() . $name;
    move_uploaded_file($tmp_name, '../uploads/' . $name_image);
    $statment = $connect->prepare('UPDATE users SET image=:name_image WHERE id=:id');
    $statment->execute([
        "id" => $_SESSION['user_id'],
        "name_image" => $name_image,
    ]);
    return true;
}

function create_info($user_name, $work, $phone, $address) //General information
{
    $connect = connect();
    $sql = "UPDATE users SET user_name=:user_name, work=:work , phone=:phone , address=:address WHERE id=:id";
    $statment = $connect->prepare($sql);
    $statment->execute([
        "id" => $_SESSION['user_id'],
        "user_name" => $user_name,
        "work" => $work,
        "phone" => $phone,
        "address" => $address
    ]);
    unset_flash_message('user_id');//удаляем сессию с user_id
    return true;
}

function create_social_network($vk, $telegram, $instagram) //Social networks
{
    $connect = connect();
    $statment = $connect->prepare("UPDATE users SET vk=:vk, telegram=:telegram , instagram=:instagram WHERE id=:id");
    $statment->execute([
            "id" => $_SESSION['user_id'],
            "vk" => $vk,
            "telegram" => $telegram,
            "instagram" => $instagram]
    );
    return true;
}

function status($status) //User status
{
    $connect = connect();
    $statment = $connect->prepare("UPDATE users SET status=:status WHERE id=:id");
    $statment->execute([
        "id" => $_SESSION['user_id'],
        "status" => $status
    ]);
    return true;
}

function is_author($logged_user_id, $edit_user_id) //Проверка автор ли пользователь или нет
{
    if ($logged_user_id == $edit_user_id) {
        return true;
    }
    return false;
}

function select_user_is_id($edit_user_id) // Получаем юзера по id
{
    $statment = connect()->prepare("SELECT * FROM users WHERE id=:id");
    $statment->execute(["id" => $edit_user_id]);
    $return_user_id = $statment->fetch(PDO::FETCH_ASSOC);
    return $return_user_id;
}
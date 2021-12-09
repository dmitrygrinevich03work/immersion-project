<?php
session_start();
require_once('functions.php');

$btn = $_POST['create_users'];
$email = $_POST['email'];
$password = $_POST['password'];
$tmp_name = $_FILES['image']['tmp_name'];
$name = $_FILES['image']['name'];

/* Info */
$user_name = $_POST['user_name'];
$work = $_POST['work'];
$phone = $_POST['phone'];
$address = $_POST['address'];
/* End Info */

/* соц.сети */
$vk = $_POST['vk'];
$telegram = $_POST['telegram'];
$instagram = $_POST['instagram'];
/* End */

function create_image($name, $tmp_name)
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

function create_info($user_name, $work, $phone, $address)//Общая информация
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
    return true;
}

function create_social_network($vk, $telegram, $instagram)//Социальные сети
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

if (isset($btn)) {
    if (!select_email($email)) {
        if (add_user($email, $password)) {
            if (create_info($user_name, $work, $phone, $address)) {
                if (create_image($name, $tmp_name)) {
                    if (create_social_network($vk, $telegram, $instagram) == true) {
                        set_flash_message('success_create_user', 'Вы успешно добавили Пользователя!');
                        unset_flash_message('user_id');
                        redirect_to('../users.php');
                        return true;
                    }
                    unset_flash_message('user_id');
                    set_flash_message('error_add_user', 'Вы не смогли добавить пользователя!');
                    redirect_to('../create_user.php');
                    return false;
                }
            }
        } else {
            set_flash_message('error_select_email', 'Данный электронный адресс уже занят!');
            redirect_to('../create_user.php');
            return false;
        }
    }
}

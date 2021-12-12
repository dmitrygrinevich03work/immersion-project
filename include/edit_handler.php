<?php
session_start();
require_once('functions.php');

$logged_user_id = $_SESSION['user']['id'];//Получаем id авторизированого юзера
$edit_user_id = $_GET['id'];// Получаем id Пользоателя которого хотим редактировать
/* Получаем данные с формы пользователя которого редактируем */
$user_name = $_POST['user_name'];
$work = $_POST['work'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$return_user_id = select_user_is_id($edit_user_id); //Получаю юзера с БД по id

if(isset($_POST['update_user'])){
    $_SESSION['user_id'] = $_POST['id'];//Записываю id юзера которого редактирую в сессию с метода POST(hidden).
    if(create_info($user_name, $work, $phone, $address)) { //Если функция вернула true то создаём сообщение с успехом, иначе возвращаем false
        set_flash_message('success_edit_profile', 'Profile updated successfully!');
        redirect_to("../page_profile.php");
    }
    return false;
}
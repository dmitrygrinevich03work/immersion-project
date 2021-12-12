<?php
session_start();
require_once("functions.php");

$email = $_POST['email'];
$password = $_POST['password'];

$logged_user_id = $_SESSION['user']['id'];//Получаем id авторизированого юзера
$edit_user_id = $_GET['id'];// Получаем id Пользоателя которого хотим редактировать
$user_id = $_POST['id'];// Получаем id пользователя через пост

$return_user_id = select_user_is_id($user_id);//Получаем пользователя по id если обычный юзер
$return_user_id_by_admin = select_user_is_id($edit_user_id);//Получаем пользователя по id если admin

if (isset($_POST['edit_security'])) {
    if (is_admin()) {//Если админ то выполняем данный код
        if (!select_email($email) || $return_user_id_by_admin['email'] == $email) {
            edit_credentials($user_id, $email, $password);//Обновляем данные пользователя!
            set_flash_message("success_edit_security_profile", 'Вы успешно обновили данные!');//Создаём флеш сообщение об успехе!
            redirect_to("../page_profile.php");//Перенаправляем пользователя где будем показывать сообщение об успехе!
            return true;

        }
    }
    if (!select_email($email) || $return_user_id['email'] == $email) {//Если обычный юзер то выполняем данный код!
        edit_credentials($user_id, $email, $password);//Обновляем данные пользователя!
        set_flash_message("success_edit_security_profile", 'Вы успешно обновили данные!');//Создаём флеш сообщение об успехе!
        redirect_to("../page_profile.php");//Перенаправляем пользователя где будем показывать сообщение об успехе!
        return true;

    }
    set_flash_message("error_edits_security_profile", "Почта которую вы пытаетесь сменить, уже занята!"); //Создаём флеш сообщение об ошибке!
    redirect_to("../security.php");//Перенаправляем пользователя где будем показывать сообщение об ошибке!
    return false;
}
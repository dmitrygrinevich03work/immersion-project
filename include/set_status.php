<?php
session_start();
require_once("functions.php");//Загружаем доп. функции!

$logged_user_id = $_SESSION['user']['id'];//Получаем id авторизированого юзера
$edit_user_id = $_GET['id'];// Получаем id Пользоателя которого хотим редактировать

$return_user_id = select_user_is_id($edit_user_id);//Получаем пользователя по id
$return_status = return_status();//Получаю все статусы с БД и присваиваю им переменную

if(isset($_POST['set_status'])){
    if(isset($_POST['select_status'])){
        $_SESSION['user_id'] = $_POST['id'];//Записываю id юзера которого редактирую в сессию с метода POST(hidden).
        status($_POST['select_status']);//Вызываем функцию установить новый статус пользователю.
        unset_flash_message('user_id');//Удаляем id пользователя из сесии.
        set_flash_message("success_set_status", "You have successfully updated your profile status!");//Устанавливаем сообщение с успехом!
        redirect_to("../page_profile.php");//Перенаправление пользователя на страницу профиля.
    }
}

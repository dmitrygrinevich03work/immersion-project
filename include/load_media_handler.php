<?php
session_start();
require_once("functions.php");//Доп.функции

$logged_user_id = $_SESSION['user']['id'];//Получаем id авторизированого юзера
$edit_user_id = $_GET['id'];// Получаем id Пользоателя которого хотим редактировать
$user_id = $_POST['id'];// Получаею id Пользователя методом post

/* $_FILES - данные для добавления картинки */
$tmp_name = $_FILES['image']['tmp_name'];
$name = $_FILES['image']['name'];

$return_user_id = select_user_is_id($edit_user_id);//Получаем пользователя по id

if(isset($_POST['load_image'])){
    if(isset($_FILES['image'])){
        $_SESSION['user_id'] = $user_id;//Создаю сесию с id юзера
        create_image($name, $tmp_name);//Вызываем функцию загрузки картинки
        unset_flash_message('user_id');//Удаляю id пользователя
        set_flash_message("success_load_image", "Avatar has been successfully updated!");//Создаю фдеш сообщение с успешной загрузкой картинки!
        redirect_to("../page_profile.php");//Перенаправляю пользователя на страницу профиля!
    }
}
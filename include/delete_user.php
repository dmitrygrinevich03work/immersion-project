<?php
session_start();
require_once("functions.php");//Подключаю доп.функции

if (!is_logged_in()) {
    redirect_to('../page_login.php');//Если пользлватель не авторизирован то перенаправляю на страницу с авторизацией
}
$logged_user_id = $_SESSION['user']['id'];//Получаем id авторизированого юзера
$edit_user_id = $_GET['id'];// Получаем id Пользоателя которого хотим редактировать

$return_user_id = select_user_is_id($edit_user_id); //Получаю юзера с БД по id
if (is_admin()) { //Если пользователь админ то вывожу код для админа
    unlink('../uploads/' . $return_user_id['image']);//Удаляю аватарку с диска
    delete_user($edit_user_id);//Удаляю юзера
    if ($logged_user_id == $edit_user_id) {//Если админ удалил себя то выходим с системы
        session_destroy();//Удаляем сессию пользователя
        redirect_to('../page_register.php');//Перенаправляем пользователя на страницу регисрации
        die();//Завершаем действие скрипта
    }
    set_flash_message("success_delete_user", "You have successfully deleted the user!");//Создаём сообщение что пользователь удалён!
    redirect_to("../users.php");//Перенаправляем пользователя на страницу "Список Юзеров".

} else { //Если не админ то вывожу код для юзира

    if (is_author($logged_user_id, $edit_user_id)) { //Если пользователь удаляет себя то вызов функции "delete_user"
        unlink('../uploads/' . $return_user_id['image']);//Удаляю аватарку с диска
        delete_user($edit_user_id);//Удаляю юзера
        session_destroy();//Удаляем сессию пользователя
        redirect_to('../page_register.php');//Перенаправляем пользователя на страницу регисрации
        die();
    }
    set_flash_message("is_author_error", "You can only edit your profile!");//Если пользователь пытается редактировать чужую запись то выводим ошибку
    redirect_to("../users.php");//Перенаправляем пользователя на страницу "Список Юзеров"
}
<?php
session_start();
require_once("functions.php");
$id = $_GET['id'];


if (isset($id)) {
    if(is_logged_in()) {//Делаем проверку если пользователь не авторизирован то выводим ошибку иначе выходим с аккаунта пользователя!
        session_destroy();//Удаляем сессию пользователя
        redirect_to('../page_login.php');
    } else {
        set_flash_message('error_msg_logout', "Вы не можете выйти, не авторизовавшись!");
        redirect_to('../page_login.php');
    }
}

$all_user = select_all_users();
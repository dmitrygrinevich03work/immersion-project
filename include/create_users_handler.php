<?php
session_start();
require_once('functions.php'); //Загружаем все доп. ф-и.

$btn = $_POST['create_users'];//Кнопка "Добавить"

/* $_POST - данные для добавления юзера  */
$email = $_POST['email'];//Почта
$password = $_POST['password'];//Пароль
$status = $_POST['status'];//Статус

/* $_FILES - данные для добавления картинки */
$tmp_name = $_FILES['image']['tmp_name'];
$name = $_FILES['image']['name'];

/* $_POST - данные для добалвения Общей информация юзеру. */
$user_name = $_POST['user_name'];
$work = $_POST['work'];
$phone = $_POST['phone'];
$address = $_POST['address'];

/* $_POST - Данные для добавления ссыкок соц. сетей */
$vk = $_POST['vk'];
$telegram = $_POST['telegram'];
$instagram = $_POST['instagram'];

if (isset($btn)) {//Если была нажата кнопка "Добавить" то я выполняю седущее.
    if (!select_email($email)) { //Проверяем почту если почта не найдена , то вызываем фенкцию "Создать юзера(add_user)"
                                //Иначе Если почта существует в БД то выводим сообщение с ошибкой на странице create_user.php
        if (add_user($email, $password)) { //Добавляем юзера, если юзер вернул true то переходим дальше.
            if (create_info($user_name, $work, $phone, $address)) { //Добавляем общую информацию юзеру, если фенкция вернула true то переходим дальше.
                if (status($status)) { //Устанавливаем статус юзеру, если фенкция вернула true то переходим дальше.
                    if (create_image($name, $tmp_name)) { //Загружаем картинку юзера, если фенкция вернула true то переходим дальше.
                        if (create_social_network($vk, $telegram, $instagram) == true) { //Добавляем ссылки соц.сетей юзеру, если фенкция вернула true то переходим дальше.
                            set_flash_message('success_create_user', 'Вы успешно добавили Пользователя!');
                            unset_flash_message('user_id');//удаляем сессию с user_id
                            redirect_to('../users.php');
                            return true;
                        }
                        unset_flash_message('user_id');//удаляем сессию с user_id
                        set_flash_message('error_add_user', 'Вы не смогли добавить пользователя!');
                        redirect_to('../create_user.php');
                        return false;
                    }
                }
            }
        } else {
            set_flash_message('error_select_email', 'Данный электронный адресс уже занят!');
            redirect_to('../create_user.php');
            return false;
        }
    }
}

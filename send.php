<?php
require_once 'connection.php'; // подключаем скрипт

$post = (!empty($_POST)) ? true : false;

if($post)
{
    $email = trim($_POST['email']);
    $name = htmlspecialchars($_POST['fio']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST["phone"]);
    $message_p = htmlspecialchars($_POST["descr"]);
    $error = '';
    if (!$name or !$email or !$phone or !$message_p) { // eсли хoть oднo пoлe oкaзaлoсь пустым
        $error = 'Ошибка';
    }
    if(!$error)
    {
        $subject = "Новое сообщение ";
        $subject .= date("d.m.Y");

        $mail_to = "ihor@seotm.com";

        $message ="\n\n".$subject."\n\nИмя: ".$name."\n\nНомер телефона: " .$tel."\n\nE-mail: " .$email."\n\nСообщение: " .$message_p."\n\n";
        $mail = mail($mail_to, $subject, $message);

        $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
// выполняем операции с базой данных
        $query ="SELECT * FROM mod_feedback";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

        $result1 = "INSERT INTO mod_feedback (fio, email,phone, descr) VALUES ('$name','$email','$phone','$message_p')";
        mysqli_query($link, $result1) or die("Ошибка " . mysqli_error($link));
        mysqli_close($link);


        if($mail)
        {
            echo 'OK';
        }

    }
    else
    {
        echo '<div class="notification_error">'.$error.'</div>';
    }

}
?>
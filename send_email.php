<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//сменить директорию на директорию проекта (работает только в повер шел под админом) D: cd SoureCode\landing-postman 
//стартонуть локальный сервер на пыхе php -S localhost:8000
//ТАСКА НА ЩАВТИРА ЗАХОСТИТЬ ЭТО НА heroku

require 'vendor/autoload.php'; // Подключаем PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST["firstname"]);
    $lastName = htmlspecialchars($_POST["lastname"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $address = htmlspecialchars($_POST["address"]);
    $postcode = htmlspecialchars($_POST["postcode"]);
    $message = htmlspecialchars($_POST["message"]);

    $mail = new PHPMailer(true);
    try {
        // Настройки SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP сервер (можно заменить на SMTP другого сервиса)
        $mail->SMTPAuth = true;
        $mail->Username = 'zloygolub@gmail.com'; // Эмеил отправки"
        $mail->Password = 'zzqm kahf fcya yngw'; // Пароль от email (лучше использовать App Password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // От кого письмо
        $mail->setFrom($email, "$firstName $lastName");
        // Кому отправляем
        $mail->addAddress("kolosova.vell@gmail.com"); // Кому отправить

        // Тема письма
        $mail->Subject = "New Book Request from $firstName $lastName";
        // Тело письма
        $mail->Body = "You have received a new book request.\n\n" .
                      "Name: $firstName $lastName\n" .
                      "Email: $email\n" .
                      "Address: $address\n" .
                      "Postcode: $postcode\n" .
                      "Message:\n$message\n";

        // Отправка
        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} else {
    header("Location: index.html");
    exit();
}
?>



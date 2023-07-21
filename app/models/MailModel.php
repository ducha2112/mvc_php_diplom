<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;



    require_once 'DB.php';


    require_once "vendor/autoload.php";





//  необходимы $mail->Username и $mail->Password

    class MailModel {

          protected $_db = null;

            public function mail_to() {
                $mail = new PHPMailer(true);

                //Вывод ошибок сервера
//                $mail->SMTPDebug = 4;
                $mail->CharSet = 'UTF-8';

                $mail->isSMTP();

                $mail->Host = "smtp.gmail.com";

                $mail->SMTPAuth = true;

                $mail->Username = getenv("KeyUser");
                $mail->Password = getenv("KeyMail");

                $mail->SMTPSecure = "tls";

                $mail->Port = 587;
                //Отправитель
                $mail->From = $_POST['email'];
                $mail->FromName = $_POST['name'];

                // Получатель(отправляем письмо с сайта на свою почту)
                $mail->addAddress("ducha2112@yandex.ru", "Сергей");

                // HTML или текст
                $mail->isHTML(true);
                $mail->msgHTML('<html><body>
                <h2>Письмо от:  '.$_POST['name'].'  '.$_POST['age'].' лет</h2>
                <p><i>Email отправителя:  </i> '  .$_POST['email'].'</p><br>
                <p> <i>Текст письма:</i><br><br>        '.$_POST['message'].' </p>
                </body></html>');

                $mail->Subject = "Сообщение с нашего сайта";
                $mail->AltBody = $_POST['message'];

                try {
                    $mail->send();
                    return 'success';

                } catch (Exception $e) {
                   return "Сообщение не было отправлено!<br>
                   Причина ошибки: " . $mail->ErrorInfo."<br><a href='https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting' style='color: #b4c8e8;'>https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting</a>";
                }

            }
            public function save_message() {
                $this->_db = DB::getConnectToDB();
                $sql = 'INSERT INTO messages(name,email,age,mess) VALUES(:name,:email,:age,:mess)';
                $query = $this->_db->prepare($sql);
                $query->execute(['name'=>$_POST['name'],'email'=>$_POST['email'],'age'=>$_POST['age'],'mess'=>$_POST['message']]);


            }
        }
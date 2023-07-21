<?php

    class Contacts extends Controller {
           public function index() {
               $data = [];
               $data['title'] = 'Контакты';
               if(isset($_POST['name'])) {
                   $data = $_POST;
                   if(strlen($_POST['name']) < 3) $data['error'] = 'Имя очень короткое';
                  else if(strlen($_POST['email']) < 3) $data['error'] = 'Email введен некорректно';
                  else if($_POST['age'] <= 0 ||$_POST['age'] >100  ) $data['error'] = 'Возраст введен некорректно';
                  else if(strlen($_POST['message'])<10) $data['error'] = 'Вы не ввели сообщение';
                  else {
                      $mail = $this->model('MailModel');
                      $mess = $mail->mail_to();

                      if($mess == 'success') {
                          $mail->save_message();
                          $data['success'] = 'Письмо успешно отправлено';
                          $data['name'] ='';
                          $data['email'] ='';
                          $data['age'] ='';
                          $data['message'] ='';

                      }
                      else $data['error'] = $mess;
                  }

               }
               $this->view('contacts/index',$data);
           }
    }

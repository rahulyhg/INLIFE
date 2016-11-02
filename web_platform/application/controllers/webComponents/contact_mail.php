<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact_mail extends MY_Controller {

    protected $language = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Cam');
    }

    function index() {
        
    }

    public function contact_message_user($name, $email, $subject, $message) {

        $letter = "Mensaje de :$name "
                . "<br>"
                . "Sujeto: $subject"
                . "<br>"
                . "Email: $email"
                . "Sujeto: $subject"
                . "<br>"
                . "Mensaje:" . $message;


        $letter_user = "<img src='" . base_url("resoureces/images/mail_welcome.png") . "' style='width:100%!important;'/>";

        $this->send_mail($letter, $email, $subject);


        echo 1;
    }

    public function suscribe_user($user_mail) {
        $usuario_suscrito = $this->Cam->sql(" SELECT * "
                . " FROM inscritos "
                . " WHERE correo_electronico = '" . $user_mail . "'");
        if (sizeof($usuario_suscrito) > 0) {
            return 0;
        } else {
            $this->Cam->sqlInsert("INSERT INTO inscritos" .
                    "(correo_electronico) " .
                    "VALUES (" .
                    "'" . $user_mail . "'  " .
                    ")" .
                    "");

            $this->send_mail_suscript_notification($user_mail);
            // $this->send_mail_welcome($user_mail, "Bienvenido a InLife!");

            return 1;
        }
    }

    public function send_mail($letter, $mail, $subject) {

        date_default_timezone_set('America/Bogota');
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');


        $config = array();
        $config['useragent'] = 'CodeIgniter';
        $config['protocol'] = 'sendmail';
        $config['smtp_host'] = 'sjrmcali.com';
        $config['smtp_user'] = 'mail_sender@inlife.com.co';
        $config['smtp_pass'] = 'send_mail_inlife_2016';
        $config['smtp_port'] = 25;
        $config['smtp_timeout'] = 5;
        $config['wordwrap'] = TRUE;
        $config['wrapchars'] = 76;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['validate'] = FALSE;
        $config['priority'] = 3;
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['bcc_batch_mode'] = FALSE;
        $config['bcc_batch_size'] = 200;
        //$this->load->library('email');
        $this->email->initialize($config);
        $this->email->from("info@inlife.com.co", "Correo usuario InLife");
        $this->email->to("info@inlife.com.co");
        $this->email->subject($subject);
        $this->email->message($letter);

        if ($this->email->send()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function send_mail_suscript_notification($mail) {
        header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        header('Access-Control-Allow-Origin: *');

        $msj = "<!DOCTYPE html>" .
                "<html lang='en'>" .
                "<head>" .
                " <title>InLife</title>" .
                "<meta charset='utf-8'>" .
                "<meta name='viewport' content='width=device-width, initial-scale=1'>" .
                "<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>" .
                "</head>" .
                " <body>" .
                "<p><b>Nueva suscripción de usuario:</b></p><p>" . $mail . "</p>" .
                " </body>" .
                "</html>";


        date_default_timezone_set('America/Bogota');
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');


        $config = array();
        $config['useragent'] = 'CodeIgniter';
        $config['protocol'] = 'sendmail';
        $config['smtp_host'] = 'sjrmcali.com';
        $config['smtp_user'] = 'mail_sender@inlife.com.co';
        $config['smtp_pass'] = 'send_mail_inlife_2016';
        $config['smtp_port'] = 25;
        $config['smtp_timeout'] = 5;
        $config['wordwrap'] = TRUE;
        $config['wrapchars'] = 76;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['validate'] = FALSE;
        $config['priority'] = 3;
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['bcc_batch_mode'] = FALSE;
        $config['bcc_batch_size'] = 200;
        //$this->load->library('email');
        $this->email->initialize($config);
        $this->email->from('info@inlife.com.co', "Nueva suscripción de usuario");
        $this->email->to("info@inlife.com.co");
        $this->email->subject("Nueva suscripción de usuario");
        $this->email->message($msj);

        if ($this->email->send()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function send_mail_welcome($mail, $subject) {

        header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        header('Access-Control-Allow-Origin: *');

        date_default_timezone_set('America/Bogota');
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');


        $msj = "<!DOCTYPE html>" .
                "<html lang='en'>" .
                "<head>" .
                " <title>InLife</title>" .
                "<meta charset='utf-8'>" .
                "<meta name='viewport' content='width=device-width, initial-scale=1'>" .
                "<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>" .
                "</head>" .
                " <body>" .
                "<img src='" . base_url("resources/images/mail_welcome.png") . "' style='width:100%!important;'/>" .
                " </body>" .
                "</html>";


        $config = array();
        $config['useragent'] = 'CodeIgniter';
        $config['protocol'] = 'sendmail';
        $config['smtp_host'] = 'inlife.com.co';
        $config['smtp_user'] = 'spanesso@inlife.com.co';
        $config['smtp_pass'] = 'spanesso';
        $config['smtp_port'] = 25;
        $config['smtp_timeout'] = 5;
        $config['wordwrap'] = TRUE;
        $config['wrapchars'] = 76;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['validate'] = FALSE;
        $config['priority'] = 3;
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['bcc_batch_mode'] = FALSE;
        $config['bcc_batch_size'] = 200;
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->from('info@inlife.com.co', "InLife");
        $this->email->to($mail);
        $this->email->subject($subject);
        $this->email->message($msj);

        $this->email->send();
    }

}

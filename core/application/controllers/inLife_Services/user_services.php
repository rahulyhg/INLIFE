<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_services extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    public function save_profile_image($id_usuario, $id_img_name) {
        $this->load->library('../controllers/inLife_DAO/user_transactional');
        $user_data_sweph = $this->user_transactional->save_profile_image($id_usuario, $id_img_name);
        return $user_data_sweph;
    }

    public function change_password($id_usuario, $change_new_pass) {
        $this->load->library('../controllers/inLife_DAO/user_transactional');
        $user_data_sweph = $this->user_transactional->change_password($id_usuario, $change_new_pass);
        return $user_data_sweph;
    }

    public function get_ephe_data_by_user_id($id_usuario) {
        $this->load->library('../controllers/inLife_DAO/user_transactional');
        $user_data_sweph = $this->user_transactional->get_ephe_data_by_user_id($id_usuario);
        return $user_data_sweph;
    }

    public function get_challenge($id_reto, $id_usuario) {
        $this->load->library('../controllers/inLife_DAO/user_transactional');
        $user_data_sweph = $this->user_transactional->get_challenge($id_reto, $id_usuario);
        return $user_data_sweph;
    }

    public function get_primary_challenge_by_user_id($id_usuario) {
        $this->load->library('../controllers/inLife_DAO/user_transactional');
        $arrayReturn = $this->user_transactional->get_primary_challenge_by_user_id($id_usuario);
        return $arrayReturn;
    }

    public function get_activity_challenge_by_id($id_actividad) {
        $this->load->library('../controllers/inLife_DAO/user_transactional');
        $arrayReturn = $this->user_transactional->get_activity_challenge_by_id($id_actividad);
        return $arrayReturn;
    }

    public function save_answer_day_challenge($id_reto_primordial, $id_usuario, $calification, $respuesta_reto_dia) {
        $this->load->library('../controllers/inLife_DAO/user_transactional');
        $arrayReturn = $this->user_transactional->save_answer_day_challenge($id_reto_primordial, $id_usuario, $calification, $respuesta_reto_dia);
        return $arrayReturn;
    }

    public function send_acivate_account_email($email) {
        header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        header('Access-Control-Allow-Origin: *');


        $msj = "<!DOCTYPE html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "<meta name='viewport' content='width=device-width, initial-scale=1'>" .
                "<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>" .
                "</head>" .
                " <body>" .
                "<img src='" . base_url("resources/img/welcome_community.jpg") . "' style='width:100%;height:auto;' />" .
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
        $config['smtp_host'] = 'inlife.com.co';
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
        $this->email->from('info@inlife.com.co', "¡Bienvenido a Nuestra Comunidad InLife!");
        $this->email->to($email);
        $this->email->subject("¡Bienvenido a Nuestra Comunidad InLife!");
        $this->email->message($msj);

        if ($this->email->send()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function send_acivate_account_email_event($email) {
        header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        header('Access-Control-Allow-Origin: *');


        $msj = "<!DOCTYPE html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "<meta name='viewport' content='width=device-width, initial-scale=1'>" .
                "<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>" .
                "</head>" .
                " <body>" .
                "<img src='" . base_url("resources/img/welcome_experience.jpg") . "' style='width:100%;height:auto;' />" .
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
        $config['smtp_host'] = 'inlife.com.co';
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
        $this->email->from('info@inlife.com.co', "¡Bienvenido a Nuestra Comunidad InLife!");
        $this->email->to($email);
        $this->email->subject("¡Bienvenido a Nuestra Comunidad InLife!");
        $this->email->message($msj);

        if ($this->email->send()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function send_register_email($id_usuario, $token, $email) {
        header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        header('Access-Control-Allow-Origin: *');


        $msj = "<!DOCTYPE html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "<meta name='viewport' content='width=device-width, initial-scale=1'>" .
                "<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>" .
                "</head>" .
                " <body>" .
                " <a "
                . " href='" . NLF_LOCALHOST . "community/confirm_register_data/" . $id_usuario . "/" . $token . "'    "
                . " >" .
                "<img src='" . base_url("resources/img/web_register.jpg") . "' style='width:100%;height:auto;' />" .
                "</a>" .
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
        $config['smtp_host'] = 'inlife.com.co';
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
        $this->email->from('info@inlife.com.co', "Confirmación Registro Comunidad InLife");
        $this->email->to($email);
        $this->email->subject("Confirmación Registro Comunidad InLife");
        $this->email->message($msj);

        if ($this->email->send()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function send_register_email_event($id_usuario, $token, $email) {
        header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        header('Access-Control-Allow-Origin: *');


        $msj = "<!DOCTYPE html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "<meta name='viewport' content='width=device-width, initial-scale=1'>" .
                "<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>" .
                "</head>" .
                " <body>" .
                " <a "
                . " href='" . NLF_LOCALHOST . "community/confirm_register_data_event/" . $id_usuario . "/" . $token . "'    "
                . " >" .
                "<img src='" . base_url("resources/img/activation_experience.jpg") . "' style='width:100%;height:auto;' />" .
                "</a>" .
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
        $config['smtp_host'] = 'inlife.com.co';
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
        $this->email->from('info@inlife.com.co', "Gracias por Inscribirte a Nuestro Vital Experience");
        $this->email->to($email);
        $this->email->subject("Gracias por Inscribirte a Nuestro Vital Experience");
        $this->email->message($msj);

        if ($this->email->send()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function register($data_user, $event) {

        $this->load->library('../controllers/inLife_DAO/user_transactional');

        $hora_nacimiento = $data_user["hora_nacimiento"];
        $fecha_nacimiento = $data_user["fecha_nacimiento"];
        $gmtOffset = intval($data_user["gmtOffset"]);

        $array_gmt_time_nacimiento = $this->convert_gmt_time($hora_nacimiento, $fecha_nacimiento, $gmtOffset);

        $data_user["hora_nacimiento"] = $array_gmt_time_nacimiento["hour"];
        $data_user["fecha_nacimiento"] = $array_gmt_time_nacimiento["date"];

        $data_user_array = $this->user_transactional->register_user($data_user);

        if ($data_user_array != 0) {
            $this->user_transactional->register_registerform_event($event, $data_user_array["id"]);
            return $data_user_array;
        } else {
            return 0;
        }
    }

    public function register_simple_user($data_user, $event) {

        $this->load->library('../controllers/inLife_DAO/user_transactional');

            $data_user_array = $this->user_transactional->register_simple_user($data_user);

        if ($data_user_array != 0) {
            $this->user_transactional->register_registerform_event($event, $data_user_array["id"]);
            return $data_user_array;
        } else {
            return 0;
        }
    }

    public function register_n_event($idEvent, $id_user) {

        $this->user_transactional->register_to_inlife_event($idEvent, $id_user);
    }

    private function convert_gmt_time($hora, $fecha, $gmtOffset) {

        if ($gmtOffset < 0) {
            $gmtOffset = $gmtOffset * -1;
        }

        $hour_in_seconds = 3600;
        $TIME_LAPSED = $gmtOffset * $hour_in_seconds;

        $complete_date = date($fecha . " " . $hora);
        $new_complete_date = strtotime($complete_date);
        $new_date_incrememnt = $new_complete_date + $TIME_LAPSED;

        $arrayReturn = array(
            "date" => date('Y.m.d', $new_date_incrememnt),
            "hour" => date('H:i:s', $new_date_incrememnt)
        );

        return $arrayReturn;
    }

    public function activate_acount($id, $token, $event) {

        $this->load->library('../controllers/inLife_DAO/user_transactional');

        $data_user_array = $this->user_transactional->activate_acount($id, $token, $event);

        return $data_user_array;
    }

    public function get_resources() {

        $this->load->library('../controllers/inLife_DAO/user_transactional');

        $data_user_array = $this->user_transactional->get_resources();

        echo json_encode($data_user_array);
    }

    public function activate_login_acount($email, $pass, $event) {

        $this->load->library('../controllers/inLife_DAO/user_transactional');

        $data_user_array = $this->user_transactional->activate_login_acount($email, $pass, $event);

        if ($data_user_array["is_user_activate"] == 0) {
            $this->send_acivate_account_email($email);
        }

        return $data_user_array;
    }

    public function activate_login_acount_event($email, $pass, $event) {

        $this->load->library('../controllers/inLife_DAO/user_transactional');

        $data_user_array = $this->user_transactional->activate_login_acount($email, $pass, $event);

        $this->send_acivate_account_email_event($email);

        return $data_user_array;
    }

    public function login_user($email, $pass) {

        $this->load->library('../controllers/inLife_DAO/user_transactional');

        $data_user_array = $this->user_transactional->login_acount($email, $pass);

        return $data_user_array;
    }

}

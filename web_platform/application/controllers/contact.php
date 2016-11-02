<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cam');
    }

    function index() {
        $this->getLanguageController("contact");
        $this->_render_contact('pages/contact', "FULLPAGE");
    }

    function send_contact_message() {
   $this->load->library('../controllers/webComponents/contact_mail');

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');



        $data_encuestado_array = $this->contact_mail->contact_message_user($name, $email, $subject, $message);
        echo $data_encuestado_array;
    }

    function suscribe_user() {

        $this->load->library('../controllers/webComponents/contact_mail');
        $user_mail = $this->input->post('mail');
        $data_encuestado_array = $this->contact_mail->suscribe_user($user_mail);
        echo $data_encuestado_array;
    }

}

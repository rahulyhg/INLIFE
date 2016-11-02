<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {}

    public function contact_user_message() {
		
		header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        header('Access-Control-Allow-Origin: *');
		
		
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$message = $this->input->post('message');
		

        $msj = "<!DOCTYPE html>" .
                "<html lang='en'>" .
                "<head>" .
                "<meta charset='utf-8'>" .
                "<meta name='viewport' content='width=device-width, initial-scale=1'>" .
                "<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>" .
                "</head>" .
                "<body>" .
				"<h2>Mensaje de página web seccion contácto.</h2>".
				"<p><b>Nombre:</b> ".$name." </p>".
				"<p><b>Correo:</b> ".$email." </p>".
				"<p><b>Mensaje:</b> ".$message." </p>".
                "</body>" .
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
        $this->email->from('info@inlife.com.co', "Envío mensaje contacto inlife");
        $this->email->to("spanesso@gmail.com");
        $this->email->subject("Envío mensaje contacto inlife");
        $this->email->message($msj);

        if ($this->email->send()) {
            return 1;
        } else {
            return 0;
        }
		
		
 
    }
 

}

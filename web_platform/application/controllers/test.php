<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    function prueba() {
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
                   "<img src='".  base_url("resources/images/mail_welcome.png")."' style='width:100%!important;'/>".
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
            $config['smtp_host'] = 'happyhelp.co';
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
            $this->email->to("jesus.cardona@gmail.com");
            $this->email->subject("Prueba");
            $this->email->message($msj);

            if ($this->email->send()) {
                echo "success";
            } else {
                echo "error";
            }
      
    }

}

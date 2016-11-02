<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    //Page info
    protected $data = Array();
    protected $pageName = FALSE;
    protected $template = "main";
    protected $hasNav = TRUE;
    //Page contents
    protected $javascript = array();
    protected $css = array();
    protected $fonts = array();
    //Page Meta
    protected $title = FALSE;
    protected $description = FALSE;
    protected $keywords = FALSE;
    protected $author = FALSE;

    function __construct() {

        parent::__construct();
        $this->data["uri_segment_1"] = $this->uri->segment(1);
        $this->data["uri_segment_2"] = $this->uri->segment(2);
        $this->title = $this->config->item('site_title');
        $this->description = $this->config->item('site_description');
        $this->keywords = $this->config->item('site_keywords');
        $this->author = $this->config->item('site_author');

        $this->pageName = strToLower(get_class($this));
    }

    protected function _decimal_to_dms($decimal) {

        header('Content-Type: text/html; charset=UTF-8');

        $vars = explode(".", $decimal);
        $deg = $vars[0];
        $tempma = "0." . $vars[1];
        $tempma = $tempma * 3600;
        $min = floor($tempma / 60);
        $sec = $tempma - ($min * 60);

        return array("deg" => $deg, "min" => $min, "sec" => $sec);
    }

    protected function _dms_to_decimal($vector) {

        $degrees = floatval($vector["degrees"]);
        $minutes = floatval($vector["minutes"]);
        $seconds = floatval($vector["seconds"]);

        $decimal = 0;

        //degrees must be integer between 0 and 180
        if (!is_numeric($degrees) || $degrees < 0 || $degrees > 180) {
            $decimal = false;
        }
        //minutes must be integer or float between 0 and 59
        elseif (!is_numeric($minutes) || $minutes < 0 || $minutes > 59) {
            $decimal = false;
        }
        //seconds must be integer or float between 0 and 59
        elseif (!is_numeric($seconds) || $seconds < 0 || $seconds > 59) {
            $decimal = false;
        } else {

            $decimal = $degrees + ((($minutes * 60) + ($seconds)) / 3600);
        }

        return $decimal;
    }

    protected function _render($view, $renderData = "FULLPAGE") {
        switch ($renderData) {
            case "AJAX" :
                $this->load->view($view, $this->data);
                break;
            case "JSON" :
                echo json_encode($this->data);
                break;
            case "FULLPAGE" :
            default :

                $toBody["content_body"] = $this->load->view($view, array_merge($this->data), true);
                $toTpl["body"] = $this->load->view("template/" . $this->template, $toBody, true);

                $this->load->view("template/skeleton", $toTpl);
                break;
        }
    }

    protected function _renderLogin($view, $renderData = "FULLPAGE") {
        switch ($renderData) {
            case "AJAX" :
                $this->load->view($view, $this->data);
                break;
            case "JSON" :
                echo json_encode($this->data);
                break;
            case "FULLPAGE" :
            default :

                $toBody["content_body"] = $this->load->view($view, array_merge($this->data), true);
                $toTpl["body"] = $this->load->view("template/" . $this->template, $toBody, true);

                $this->load->view("template/skeletonLogin", $toTpl);
                break;
        }
    }

}

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

    protected function _render($view) {


        $toBody["content_body"] = $this->load->view($view, array_merge($this->data), true);
        $toMenu["content_body"] = $this->load->view("menu/menu", array_merge($this->data), true);
        $toFooter["content_body"] = $this->load->view("menu/footer", array_merge($this->data), true);
        $toTpl["body"] = $this->load->view("template/" . $this->template, $toBody, true);
        $toTpl["menu"] = $this->load->view("template/" . $this->template, $toMenu, true);
        $toTpl["footer"] = $this->load->view("template/" . $this->template, $toFooter, true);

        $this->load->view("template/skeleton", $toTpl);
    }
    protected function _render_form_event($view) {


        $toBody["content_body"] = $this->load->view($view, array_merge($this->data), true);
        $toMenu["content_body"] = $this->load->view("menu/menu", array_merge($this->data), true);
        $toFooter["content_body"] = $this->load->view("menu/footer", array_merge($this->data), true);
        $toTpl["body"] = $this->load->view("template/" . $this->template, $toBody, true);
        $toTpl["menu"] = $this->load->view("template/" . $this->template, $toMenu, true);
        $toTpl["footer"] = $this->load->view("template/" . $this->template, $toFooter, true);

        $this->load->view("template/skeleton_form_event", $toTpl);
    }

    protected function _render_activate_account($view) {


        $toBody["content_body"] = $this->load->view($view, array_merge($this->data), true);

        $toTpl["body"] = $this->load->view("template/" . $this->template, $toBody, true);
            

        $this->load->view("template/skeleton_activate", $toTpl);
    }
    protected function _render_activate_login($view) {


        $toBody["content_body"] = $this->load->view($view, array_merge($this->data), true);

        $toTpl["body"] = $this->load->view("template/" . $this->template, $toBody, true);
            

        $this->load->view("template/skeleton_activate_login", $toTpl);
    }

    protected function _render_contact($view) {


        $toBody["content_body"] = $this->load->view($view, array_merge($this->data), true);
        $toMenu["content_body"] = $this->load->view("menu/menu", array_merge($this->data), true);
        $toFooter["content_body"] = $this->load->view("menu/footer", array_merge($this->data), true);
        $toTpl["body"] = $this->load->view("template/" . $this->template, $toBody, true);
        $toTpl["menu"] = $this->load->view("template/" . $this->template, $toMenu, true);
        $toTpl["footer"] = $this->load->view("template/" . $this->template, $toFooter, true);

        $this->load->view("template/skeleton_contact", $toTpl);
    }

    protected function _render_index($view) {


        $toBody["content_body"] = $this->load->view($view, array_merge($this->data), true);

        $toTpl["body"] = $this->load->view("template/" . $this->template, $toBody, true);


        $this->load->view("template/skeleton_index", $toTpl);
    }

    protected function _renderDashBoard($view, $renderData = "FULLPAGE") {
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

                $this->load->view("template/skeletonDashBoard", $toTpl);
                break;
        }
    }

    protected function getLanguageController($controllerLanguaje) {

        if ($this->session->userdata('clicklanguaje') == "") {

            $data_ses = array(
                'languaje' => "ES",
                'clicklanguaje' => "",
            );
            $this->session->set_userdata($data_ses);
            $this->lang->load('menu', 'spanish');
            $this->lang->load($controllerLanguaje, 'spanish');
        } else if ($this->session->userdata('clicklanguaje') == "OK") {
            if ($this->session->userdata('languaje') == "ES") {
                $data_ses = array(
                    'languaje' => "ES",
                    'clicklanguaje' => "OK",
                );
                $this->session->set_userdata($data_ses);
                $this->lang->load('menu', 'spanish');
                $this->lang->load($controllerLanguaje, 'spanish');
            } else if ($this->session->userdata('languaje') == "EN") {
                $data_ses = array(
                    'languaje' => "EN",
                    'clicklanguaje' => "OK",
                );
                $this->session->set_userdata($data_ses);
                $this->lang->load('menu', 'english');
                $this->lang->load($controllerLanguaje, 'english');
            }
        }
    }

}

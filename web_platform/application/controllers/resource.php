 <?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Resource extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cam');
    }

    function index() {
        $this->getLanguageController("resource");

        $resource_list = $this->Cam->sql("SELECT  *  FROM recursos_web ");
        $tipos_recursos_actividades = $this->Cam->sql("SELECT  *  FROM tipos_recurso ");

        $this->data["tipos_recursos_actividades"] = $tipos_recursos_actividades;
        $this->data["resource_list"] = $resource_list;
        $this->_render('pages/resource', "FULLPAGE");
    }

    public function show($id_resource) {
 $this->getLanguageController("resource");

        $resource = $this->Cam->sql(" SELECT  * " .
                " FROM recursos_web rw , tipos_recurso tra " .
                " WHERE rw.id_tipo_recurso = tra.id_tipo_recurso " .
                " AND rw.id_recurso_web = " . $id_resource);


        $this->data["resource_item"] = $resource;
        $this->_render('pages/resource_detail', "FULLPAGE");
    }

}

<?php
require_once __DIR__ . '/../models/BusinessModel.php';

class BusinessController
{

    private $model;

    public function __construct($link)
    {
        $this->model = new BusinessModel($link);
    }

    public function getList()
    {
        $data = $this->model->business_list();
        echo json_encode([ "data" => $data]);
        exit;
    }

    public function add_edit()
    {   
        $result = $this->model->add_edit($_POST);
        echo json_encode($result);
        exit;
    }

    public function delete(){
        $id = $_POST['id'] ?? 0;
        $result = $this->model->delete($id);
        echo json_encode($result);
    }

    public function save_update()
    {   
        $result = $this->model->save_update($_POST);
        echo json_encode($result);
        exit;
    }
}

?>
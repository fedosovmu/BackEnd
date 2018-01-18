<?php

class userController extends Controller{

    public function index(){
        $users=$this->model->load();    // просим у модели все записи
        $this->setResponce($users);		// возвращаем ответ
    }

    public function view($data){
        $users=$this->model->load($data['id']); // просим у модели конкретную запись
        $this->setResponce($users);
    }
////////////////////////////////////////////////////////
    public function add(){
        $json = file_get_contents('php://input');
        $_POST = json_decode($json, true);


        if( isset($_POST['id'])   &&
            isset($_POST['name']) &&
            isset($_POST['score'])){

            $dataToSave=array('id'    => $_POST['id'],
                              'name'  => $_POST['name'],
                              'score' => $_POST['score']);

            $addedItem=$this->model->create($dataToSave);
            $this->setResponce($addedItem);
        }
    }

    public function edit($data){
        $json = file_get_contents('php://input');
        $_PUT = json_decode($json, true);


        if( isset($_PUT['id'])   &&
            isset($_PUT['name']) &&
            isset($_PUT['score'])) {

            $dataToSave = array('id' => $_PUT['id'],
                                'name' => $_PUT['name'],
                                'score' => $_PUT['score']);

            $editedItem = $this->model->save($data['id'], $dataToSave);
            $this->setResponce($editedItem);
        }

    }
    public function delete($data)
    {
        $deletedItem = $this->model->delete($data['id']);
        $this->setResponce($deletedItem);
    }
}
//teach/index.php?controller=user&id=2&action=delete
//teach/index.php?controller=user&action=add
//{'id'=5, 'name' = 'Kirill', 'score' = 12}
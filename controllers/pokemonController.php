<?php

class pokemonController extends Controller{

    public function index(){
        $pokemon =$this->model->load();		// просим у модели все записи
        $this->setResponce($pokemon);		// возвращаем ответ
    }

    public function view($data){
        $pokemon=$this->model->load($data['id']); // просим у модели конкретную запись
        $this->setResponce($pokemon);
    }
/////////////////////////////////////////////////////////////////////////
    public function add(){
        $json = file_get_contents('php://input');
        $_POST = json_decode($json, true);

        if( isset($_POST['id'])    and
            isset($_POST['name'])  and
            isset($_POST['image'])  and
            isset($_POST['power']) and
            isset($_POST['speed'])){

            $dataToSave=array('id'    => $_POST['id'],
                              'name'  => $_POST['name'],
                              'image' => $_POST['image'],
                              'power' => $_POST['power'],
                              'speed' => $_POST['speed'],);
            $addedItem=$this->model->create($dataToSave);
            $this->setResponce($addedItem);
        }
    }

    public function edit($data){
        $json = file_get_contents('php://input');
        $_PUT = json_decode($json, true);

        if( isset($_PUT['id'])    and
            isset($_PUT['name'])  and
            isset($_PUT['image'])  and
            isset($_PUT['power']) and
            isset($_PUT['speed'])) {

            $dataToSave = array('id'    => $_POST['id'],
                                'name'  => $_PUT['name'],
                                'image' => $_PUT['image'],
                                'power' => $_PUT['power'],
                                'speed' => $_PUT['speed'],);
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
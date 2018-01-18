<?php

class exampleController extends Controller {

	public function index(){
		$examples=$this->model->load();		// просим у модели все записи
		$this->setResponce($examples);		// возвращаем ответ 
	}

	public function view($data){
		$example=$this->model->load($data['id']); // просим у модели конкретную запись
		$this->setResponce($example);
	}

	public function add(){
        $json = file_get_contents('php://input');
        $_POST = json_decode($json, true);
		if(isset($_POST['title'])){
			// мы передаем в модель массив с данными
			// модель должна вернуть boolean
			$dataToSave=array('title'=>$_POST['title']);
			$addedItem=$this->model->create($dataToSave);
			$this->setResponce($addedItem);
		}
	}

	public function edit($data){
		// НАПИШИТЕ РЕАЛИЗАЦИЮ метода save в классе Model
        $json = file_get_contents('php://input');
        $_PUT = json_decode($json, true);

        if( isset($_PUT['id']) &&
            isset($_PUT['title'])) {

            $dataToSave = array('id'  => $_PUT['id'],
                                'title'  => $_PUT['title']);

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
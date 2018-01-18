<?php
// Включаем отображение ошибок
error_reporting(E_ALL);
ini_set("display_errors", 1);
// функция автозагрузки классов
spl_autoload_register(function ($class_name) {
	// загружать классы из папок app, controllers, models
	foreach ( array('./app/', './controllers/','./models/') as $k=>$v) {
		$fname=$v.$class_name.'.php';
		if(file_exists($fname)){
			include ($fname);
			break;	                       //TODO: ошибка
		} 
	}
});

// определяем константы (глобальные)
define('BASE_DIR', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
define('DATA_FOLDER',BASE_DIR.DS.'data');
 //сonst только в классах

$app=new App(); // создаем экземпляр приложения
$response = $app->run();// запускаем приложение. Его ответ помещаем в переменную

if($response){
	// если приложение ответило данными - выводим их
	header('Content-Type: application/json');     // + заголовок, ответ будет в json
	echo json_encode($response);
}else{
	header("HTTP/1.0 404 Not Found"); // если ответило false то выводим ошибку
}
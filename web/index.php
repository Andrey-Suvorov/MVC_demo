<?php

error_reporting(E_ALL);

include('config.php');

include(SITE_PATH.DS.'core'.DS.'core.php');

$router = new Router();
$router->start();

throw new \Exception();




// TODO:
// 1.  Почитать по комментариям документацию
// 2.  Форматирование кода
// 3.  Названия классов
// 4.  phpdoc
// 5.  camelCase
// 6.  Exception
// 7.  OOP (c++)
// 8.  FrontController (http://www.oracle.com/technetwork/java/frontcontroller-135648.html)
//     (банда четырех)
//     (шаблоны проектирования в PHP)
// 9.  Запросы к БД (SELECT * FROM advert WHERE id = :ID)
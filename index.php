<?php

header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once 'config.php';
require_once 'functions.php';

require_once GALERY . "galery.php";

$statti = get_statti(false);
$cat = get_cat();


echo render('index', array('statti' => $statti, 'cat' => $cat, 'galery' => $galery));

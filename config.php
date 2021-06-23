<?php
///////////////config//////////////////
const MYSQL_HOST = 'db';
const MYSQL_USER = 'super_user';
const MYSQL_PASSWORD = 'default_user_password';
const MYSQL_DATABASE = 'photogallery';


const SITE = 'http://photo-gallery.localhost';

const GALERY = 'galery/';


$site_name = 'Тестовый сайт';
$button = "Button";
///////////////config//////////////////

//
$db = mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE);

if(mysqli_connect_error($db)) {
	exit('No connection with database');
}

mysqli_query($db,"SET NAMES UTF8");
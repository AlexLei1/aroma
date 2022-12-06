<?php
session_start();
// Получаем массив url
$url = explode("/", $_SERVER['REQUEST_URI']);
// переносим код из user в router с помощью require_once
require_once("php/bd.php");
require_once("php/classes/User.php");


// Проверяем url под индексом 1 и проверяем чему равен
if ($url[1] == "blog") {
  $content = file_get_contents("pages/blog.html");
} else if ($url[1] == "contact") {
  $content = file_get_contents("pages/contact.html");
} else if ($url[1] == "auth") {
  $content = file_get_contents("pages/login.php");
} else if ($url[1] == "register") {
  $content = file_get_contents("pages/register.html");
} else if ($url[1] == "articles") {
  $content = file_get_contents("pages/single-blog.html");
} else if ($url[1] == "users") {
  require_once("pages/users/index.html");
} else if ($url[1] =='addUser') {
	echo User::addUser($_POST["name"],$_POST["lastname"],$_POST["email"],$_POST["password"]);
} else if ($url[1] =='authUser') {
	echo User::authUser($_POST["email"],$_POST["password"]);
} else if($url[1] == 'getUser') {
	echo User::getUser($_SESSION["id"]);
} else if ($url[1] == 'getUsers'){
	echo User::getUsers();
} else {
  $content = file_get_contents("pages/index.php");
}

if (!empty($content))
  require_once("template.php");

	//require_once - 
	//file_get_contents - 
<?php
//  статический метод добавления пользователя
class User {
	private $id;
	private $name;
	private $lastname;
	private $email;

	function __construct($id,$name,$lastname,$email){
		$this->id = $id;
		$this->name = $name;
		$this->lastname = $lastname;
		$this->email = $email;
	}
	function getId() {
		return $this->id;
	}
	function getName() {
		return $this->name;
	}
	function getLastname() {
		return $this->lastname;
	}
	function getEmail() {
		return $this->email;
	}

	//* Статический метод добавления пользователся
  static function addUser($name, $lastname, $email, $password) {
		global $mysqli; // переменная стала глобальной

		$email = trim(mb_strtolower($email));
		$password = trim($password);
		// шуфруем пароль перед отправкой в базу данных
		$password = password_hash("$password", PASSWORD_DEFAULT);

		//делаем запрос на сервер он возвращает данные орентируясь на email
		$result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");


		if ($result->num_rows !== 0) {
			return json_encode(["result"=>"exist"]);
		} else {
			$mysqli->query("INSERT INTO `users`(`name`,`lastname`,`email`, `password`) VALUES ('$name','$lastname','$email','$password')");
			return json_encode(["result"=>"success"]);
		};
	}

	//* статический метод авторизации пользователя
	static function authUser($email, $password) {
		global $mysqli; // переменная стала глобальной
		// получаем данные из формы (данные которые вводит пользователь)
		$email = trim(mb_strtolower($email));
		$password = trim($password);

		//делаем запрос на сервер он возвращает данные орентируясь на email
		$result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
		//result превращаем в асициотивный макссив (массив ключей)
		$result = $result->fetch_assoc();

		// проверяем пароль
		if ((password_verify($password, $result["password"])) & ($email == $result["email"])){
			// добавляем данные в сессию/массив 1. добовляем ключ 2. добавляем элемент ключу
			$_SESSION["id"] = $result["id"];
			return json_encode(["result"=>"success"]);
		} else if ($email == $result["email"]) {
			return json_encode(["result"=>"exist"]);
		} else {
			return json_encode(["result"=>"error"]);
		}
	}

		//* статический метод получения данных конкретного пользователя
		static function getUser($userId) {
			global $mysqli; // переменная стала глобальной
			
			//делаем запрос на сервер он возвращает данные орентируясь на id
			$result = $mysqli->query("SELECT `name`, `lastname`, `email`, `id` FROM `users` WHERE `id`='$userId'");
			$result = $result->fetch_assoc();
			// для получения ответа в network
			return json_encode($result);
		}

		//* Cтатический метод получения данных всех пользователей
		static function getUsers() {
			global $mysqli; // переменная стала глобальной
			
			//делаем запрос на сервер он возвращает данные всех пользователей
			$result = $mysqli->query("SELECT `name`, `lastname`, `email`, `id` FROM `users` WHERE 1");
			
			// пока пользователи в базе данных есть будет отрабатывать цикл
			while ($row = $result->fetch_assoc()) {
				$users[] = $row;
			}
			return json_encode($users);			
		}
}



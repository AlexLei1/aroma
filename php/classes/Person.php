<?php
// создаем класс человек
class Person{
  private $name;
  private $lastname;
  private $age;
  private $hp;
  private $mother;
  private $father;

	// функция конструктор создает человека из переданных в нее датных
  function __construct($name, $lastname, $age, $mother, $father){
    $this->name = $name;
    $this->lastname = $lastname;
    $this->age = $age;
    $this->mother = $mother;
    $this->father = $father;
    $this->hp = 100;
  }

  function sayHi($name){
    return "Hi $name, I`m " . $this->name;
  }

	// высчитывает количество hp
  function setHp($hp){
    if ($this->hp + $hp >= 100) $this->hp = 100;
    else $this->hp = $this->hp + $hp;
  }
	// возвращает количество hp
  function getHp(){
    return $this->hp;
  }
	// возвращает имя человека 
  function getName() {
    return $this->name;
  }
	// возвращает имя матери человека 
  function getMother() {
    return $this->mother;
  }
	// возвращает имя отца человека 
  function getFather() {
    return $this->father;
  }
	// возвращает фамильное древо человека
  function getInfo() {
    if ($this->getName() === 'Valera'){
			return "<h1>Несколько слов о себе.</h1><br>" . "Меня зовут: " . $this->getName() . "<br>Мой папа: " . $this->getFather()->getName() . "&nbsp;Mоя мама: " . $this->getMother()->getName();
		} else if ($this->getName() === 'Igor'){
			return "<br>Дедушку по папиной линии зовут: " . $this->getFather()->getName() . "&nbsp;Бабушку по папиной линии зовут: " . $this->getMother()->getName();
		} else {
			return "<br>Дедушку по маминой линии зовут: " . $this->getFather()->getName() . "&nbsp;Бабушку по маминой линии зовут: " . $this->getMother()->getName();
		}
  }
}
//! Здоровье человека не может быть более 100

$katia = new Person("Katia", "Petrova", 80, 'asdg', 'asdg');
$mitya = new Person("Mitya", "Petrov", 80, 'asdg', 'asdg');
$masha = new Person("Masha", "Petrova", 80, 'asdg', 'asdg');
$dima = new Person("Dima", "Petrov", 80, 'asdg', 'asdg');
$igor = new Person("Igor", "Petrov", 50, $masha, $dima);
$olga = new Person("Olga", "Petrova", 50, $mitya, $mitya);
$valera = new Person("Valera", "Petrov", 20, $olga, $igor);

$arrPeople = [$valera, $igor, $olga];
for($i = 0; $i < count($arrPeople); $i++){
	echo $arrPeople[$i]->getInfo();
};



// не работет когда у персоны нету родителя Код ломается и не реагирует 
//echo $valera->getMother()->getFather()->getName();

// $medKit = 50;
//$alex->hp = $alex->hp - 30; //Упал
// $alex->setHp(-30);
// echo $alex->getHp() . "<br>";
//$alex->hp = $alex->hp + $medKit; //Нашел аптечку
// $alex->setHp($medKit);
// echo $alex->getHp();
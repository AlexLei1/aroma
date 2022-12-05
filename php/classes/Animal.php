<?php
// Тема наследования
abstract class Animal
{
	private $nickname;
	private $age;
	private $breed;

	function __construct($n, $a, $b)
	{
		$this->nickname = $n;
		$this->age = $a;
		$this->breed = $b;
	}
	function getNickname()
	{
		return $this->nickname;
	}
	function getAge()
	{
		return $this->age;
	}
	function getBreed()
	{
		return $this->breed;
	}
	function speak()
	{
		echo "....";
	}
}

class Cat extends Animal
{

	function run()
	{
		echo $this->getNickname() . " :I`m running!";
	}
	function speak()
	{
		echo "Meow";
	}
}

class Bird extends Animal
{

	function fly()
	{
		echo $this->getNickname() . ": I`m flying!";
	}
	function speak()
	{
		echo "Chirik";
	}
}



$barsik = new Animal("Barsik", 4, null);
$kesha = new Animal("Kesha", 4, null);



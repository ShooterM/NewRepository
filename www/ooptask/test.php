<?php
class A {
	function aa() {
		print("It's A <br />");
	}
}

class B extends A {
	static function bb() {
		print("It's B <br />");
		$this -> aa();
	}
}

$obj1 = new A();
$obj1-> aa();

$obj2 = new B();
$obj2-> bb();

?>
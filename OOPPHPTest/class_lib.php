<?php 
	
	class person{
		var $name;

		function __construct($name){
			$this->name=$name;
		}

		function setName($name){
			$this->name=$name;
		}

		function getName(){
			return $this->name;
		}
	}


?>
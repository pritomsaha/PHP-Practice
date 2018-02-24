<?php 

	class Student
	{
		private $conn;
		private $table_name="student_info";

		public $id;
		public $name;
		public $roll;
		public $class_id;
		public $address;
		public $phone;
		public $email;
		public $picture;
		public $entry_on;
		public $updated_on;


		function __construct($db){
			$this->conn = $db;
		}

		public function creat(){
			$sql="INSERT INTO $this->table_name (name,roll,class_id,address, phone, email,picture,entry_on,updated_on) VALUES('$this->name', '$this->roll', '$this->class_id','$this->address','$this->phone','$this->email','$this->picture', '$this->entry_on','$this->updated_on')";
			$this->conn->query($sql);		
		}

		public function delete(){
			$sql="DELETE from $this->table_name WHERE id='$this->id' ";
			$this->conn->query($sql);
		}

		public function update(){
			$sql="UPDATE $this->table_name SET name='$this->name', roll='$this->roll', class_id='$this->class_id',address='$this->address', phone='$this->phone', email='$this->email', updated_on='$this->updated_on' where id=$this->id";
			$this->conn->query($sql);	
		}

		public function read(){
			$sql="select * from student_info where id='$this->id' ";
			$result=$this->conn->query($sql)->fetch_array(MYSQLI_ASSOC);

			$this->name=$result['name'];
			$this->roll=$result['roll'];
			$this->class_id=$result['class_id'];
			$this->address=$result['address'];
			$this->phone=$result['phone'];
			$this->email=$result['email'];
			$this->picture=$result['picture'];
			$this->entry_on=$result['entry_on'];
			$this->updated_on=$result['updated_on'];

		}

		public function readAll(){
			$sql="select id, name, roll, class_id, email from $this->table_name ";
			return $this->conn->query($sql);
		}
	}

?>
<?php

//Api.php

class API
{
	private $connect = '';

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=id15215268_testing", "id15215268_sample", "Epsul@123456789");
	}

	function fetch_all()
	{
		$query = "SELECT * FROM tbl_sample ORDER BY id";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	function insert()
	{
		if(isset($_POST["name"]))
		{
			$form_data = array(
				':name'		=>	$_POST["name"],
				':prn_no'		=>	$_POST["prn_no"]
			);
			$query = "
			INSERT INTO tbl_sample 
			(name, prn_no) VALUES 
			(:name, :prn_no)
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	function fetch_single($id)
	{
		$query = "SELECT * FROM tbl_sample WHERE id='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['name'] = $row['name'];
				$data['prn_no'] = $row['prn_no'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["name"]))
		{
			$form_data = array(
				':name'	=>	$_POST['name'],
				':prn_no'	=>	$_POST['prn_no'],
				':id'			=>	$_POST['id']
			);
			$query = "
			UPDATE tbl_sample 
			SET name = :name, prn_no = :prn_no 
			WHERE id = :id
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
	function delete($id)
	{
		$query = "DELETE FROM tbl_sample WHERE id = '".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
}

?>

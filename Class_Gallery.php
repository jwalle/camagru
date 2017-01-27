<?php

class GALLERY
{
	private $db;

	function __construct($conn)
	{
		$this->db = $conn;
	}

	public function add_image($fname, $user)
	{
		try
		{
			$stmt =  $this->db->prepare("INSERT INTO gallery(img_name, img_user)
											VALUES(:fname, :user)");
			$stmt->execute(array(
						'fname' => $fname,
						'user' => $user
					));
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function last_three($user)
	{
		try
		{
			$stmt = $this->db->prepare("SELECT img_name FROM gallery
				WHERE img_user=:user ORDER BY img_id DESC LIMIT 3");
											
			$stmt->execute(array('user' => $user));
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}

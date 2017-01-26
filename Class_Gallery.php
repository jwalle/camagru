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
}

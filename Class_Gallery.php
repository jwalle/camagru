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

    public function delete_image($img_id)
    {
        try
        {
            $stmt = $this->db->prepare("DELETE FROM gallery
				WHERE img_id=:img_id");
            $stmt->execute(array('img_id' => $img_id));

            $stmt = $this->db->prepare("DELETE FROM comments
				WHERE img_id=:img_id");
            $stmt->execute(array('img_id' => $img_id));

            $stmt = $this->db->prepare("DELETE FROM votes
				WHERE img_id=:img_id");
            $stmt->execute(array('img_id' => $img_id));
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function get_images($page)
    {
        $offset = intval($page * 20);
        try
        {
            $stmt = $this->db->prepare("SELECT * FROM gallery ORDER BY img_id DESC LIMIT 20 OFFSET $offset");

            $stmt->execute();
            $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $images;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function get_image($img_id)
    {
        try
        {
            $stmt = $this->db->prepare("SELECT img_name FROM gallery
				WHERE img_id=:img_id");

            $stmt->execute(array('img_id' => $img_id));
            $img = $stmt->fetch(PDO::FETCH_ASSOC);
            return $img;
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
			$stmt = $this->db->prepare("SELECT img_name,img_id FROM gallery
			ORDER BY img_id DESC LIMIT 3");
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

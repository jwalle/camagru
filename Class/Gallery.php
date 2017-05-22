<?php

class Gallery
{
	private $db;

	function __construct($conn)
	{
		$this->db = $conn;
	}

	public function add_image($fname, $user)
	{
			return $this->db->query("INSERT INTO gallery(img_name, img_user)
											VALUES(?, ?)", [$fname, $user]);
    }

    public function delete_image($img_id)
    {
            $this->db->query("DELETE FROM gallery WHERE img_id = ?", [$img_id]);

            $this->db->query("DELETE FROM comments WHERE img_id = ?", [$img_id]);

            $this->db->query("DELETE FROM votes WHERE img_id=:img_id", [$img_id]);
    }

    public function getImagesCount()
    {
        return $this->db->query("SELECT COUNT(*) FROM gallery", [])->fetch()[0];
    }

    public function get_images($page)
    {
        $offset = intval($page * 20);
        return $this->db->query("SELECT * FROM gallery ORDER BY img_id DESC LIMIT 20 OFFSET $offset", [])->fetchAll();
    }

    public function get_image($img_id)
    {
        return $this->db->query("SELECT img_name FROM gallery WHERE img_id = ?", [$img_id])->fetch();
    }

	public function last_three()
	{
        return $this->db->query("SELECT img_name,img_id FROM gallery ORDER BY img_id DESC LIMIT 3", [])->fetchAll();
	}
}

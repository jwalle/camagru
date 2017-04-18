<?php

class USER
{
	private $db;

	function __construct($conn)
	{
		$this->db = $conn;
	}

	public function register($uname, $umail, $upass)
	{
		try
		{
			$new_pass = hash('whirlpool', $upass);
			$stmt =  $this->db->prepare("INSERT INTO users(user_name, user_mail, user_pass)
											VALUES(:uname, :umail, :upass)");
			$stmt->execute(array(
						'uname' => $uname,
						'umail' => $umail,
						'upass' => $new_pass
					));
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function login($uname, $umail, $upass)
    {
        try
		{
            $stmt =  $this->db->prepare("SELECT * FROM users
				WHERE user_name=:uname OR user_mail=:umail LIMIT 1");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if ($stmt->rowCount() > 0)
			{
					$test_pass = hash('whirlpool', $upass);	
				if ($test_pass == $userRow['user_pass'])
				{
                    $_SESSION["connected"] = true;
                    $_SESSION['username'] = $userRow['user_name'];
                    return true;
				}
				else
					return false;
			}
		}
		catch(PDOException $e) {
            echo $e->getMessage();
        }
	}

	public function is_loggedin()
	{
		if (isset($_SESSION['username']))
			return true;
		return false;
	}

	public function get_id($name)
    {
        try
        {
            $stmt = $this->db->prepare("SELECT user_id FROM users
				WHERE user_name=:name OR user_mail=:name LIMIT 1");
            $stmt->execute(array(':name' => $name));
            $id = $stmt->fetch(PDO::FETCH_ASSOC);
            return $id['user_id'];
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function get_name($user_id)
    {
        try
        {
            $stmt = $this->db->prepare("SELECT user_name FROM users
				WHERE user_id=:user_id LIMIT 1");
            $stmt->execute(array(':user_id' => $user_id));
            $id = $stmt->fetch(PDO::FETCH_ASSOC);
            return $id['user_name'];
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function redirect($url)
	{
		header("Location: $url");
	}

	public function logout()
	{
		session_destroy();
		unset($_SESSION['username']);
		return true;
	}
}

?>
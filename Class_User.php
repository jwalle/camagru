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
					$_SESSION['user_session'] = $userRow['user_id'];
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
		if (isset($_SESSION['user_session']))
			return true;
		return false;
	}

    public function redirect($url)
	{
		header("Location: $url");
	}

	public function logout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}

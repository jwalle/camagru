<?php

class IMAGE
{
    private $db;

    function __construct($conn)
    {
        $this->db = $conn;
    }

//    public function count_likes(){}
//
//    public function add_like(){}
//
//    public function remove_like(){}
//
    public function get_comments($img_id)
    {
        try
        {
            $stmt = $this->db->prepare("SELECT user_id, comment, date FROM comments
            WHERE img_id=:img_id");
            $stmt->execute(array(':img_id' => $img_id));
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $comments;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function add_comment($img_id, $user_id, $content, $date)
    {
        try
        {
            $stmt =  $this->db->prepare("INSERT INTO comments(user_id, img_id, comment, date)
											VALUES(:user_id, :img_id, :comment, :date)");

            $stmt->execute(array(
                'user_id' => $user_id,
                'img_id' => $img_id,
                'comment' => $content,
                'date' => $date
            ));
            return $stmt;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
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
}
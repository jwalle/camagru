<?php

class IMAGE
{
    private $db;

    function __construct($conn)
    {
        $this->db = $conn;
    }

    public function get_sum_votes($img_id)
    {
        $sum = 0;
        try
        {
            $stmt = $this->db->prepare("SELECT vote_value FROM votes
            WHERE img_id=:img_id");
            $stmt->execute(array(':img_id' => $img_id));
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($array as $value)
                $sum += $value['vote_value'];
            return $sum;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function vote($user_id, $img_id, $vote)
    {
        $old = $this->get_user_vote($user_id, $img_id);
        if ($old == 0) {
            try {
                $stmt = $this->db->prepare("INSERT INTO votes(user_id, img_id, vote_value)
                                                VALUES(:user_id, :img_id, :vote_value)");

                $stmt->execute(array(
                    'user_id' => $user_id,
                    'img_id' => $img_id,
                    'vote_value' => $vote
                ));
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        if ($old != $vote) {
            try {
                $stmt = $this->db->prepare("UPDATE `votes` SET `vote_value`=:vote
                                            WHERE user_id=:user_id AND img_id=:img_id");

                $stmt->execute(array(
                    'vote' => $vote,
                    'user_id' => $user_id,
                    'img_id' => $img_id
                ));
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

//    public function remove_like(){}
//
    public function get_user_vote($user_id, $img_id)
    {
        try
        {
            $stmt = $this->db->prepare("SELECT vote_value FROM votes
            WHERE img_id=:img_id AND user_id=:user_id");
            $stmt->execute(array(':img_id' => $img_id,
                                 ':user_id' => $user_id));
            $value = $stmt->fetch(PDO::FETCH_ASSOC);
            return $value['vote_value'];
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function get_comments($img_id)
    {
        try
        {
            $stmt = $this->db->prepare("SELECT com_id, user_id, comment, commented FROM comments
            WHERE img_id=:img_id");
            $stmt->execute(array(':img_id' => $img_id));
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $comments;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param int $img_id
     * @param int $user_id
     * @param string $content
     * @param DateTime $commented
     *
     * @return mixed
     */
    public function add_comment($img_id, $user_id, $content, $commented)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO comments(user_id, img_id, comment, commented)
											VALUES(:user_id, :img_id, :comment, :commented)");

            $stmt->execute([
                'user_id'   => $user_id,
                'img_id'    => $img_id,
                'comment'   => $content,
                'commented' => $commented->format('Y-m-d H:i:s')
            ]);

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete_comment($com_id)
    {
        try
        {
            $stmt = $this->db->prepare("DELETE FROM comments
            WHERE com_id=:com_id");
            $stmt->execute(array(':com_id' => $com_id));
//            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
//            return $comments;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function get_img_user($img_id)
    {
        try
        {
            $stmt = $this->db->prepare("SELECT img_user FROM gallery
            WHERE img_id=:img_id");
            $stmt->execute(array(':img_id' => $img_id));
            $value = $stmt->fetch(PDO::FETCH_ASSOC);
            return $value['img_user'];
        }
        catch(PDOException $e) {
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
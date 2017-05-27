<?php

    class Image {

        private $sumVote;
        private $userVote;
        private $imageUser;
        private $comments;
        private $image;
        private $plop;

        public function __construct($db, $img_id)
        {
            $this->plop = $db;
            $this->sumVote = $this->get_sum_votes($img_id);
            $this->imageUser = $this->get_img_user($db, $img_id);
            $this->comments = $this->get_comments($db, $img_id);
            $this->image = $this->get_image($db, $img_id);
            $this->userVote = $this->get_user_vote($db, $img_id);
        }

        public function get_sum_votes($img_id)
        {
            $sum = 0;
            $array = $this->plop->query('SELECT vote_value FROM votes WHERE img_id = ?',
                [$img_id])->fetchAll(PDO::FETCH_ASSOC);
            foreach ($array as $value) {
                $sum += $value['vote_value'];
            }
            return $sum;
        }

        public function vote($user_id, $img_id, $vote)
        {
            if ($this->userVote == 0) {
                $this->plop->query('INSERT INTO votes(user_id, img_id, vote_value) 
                                         VALUES(?, ?, ?)', [$user_id, $img_id, $vote]);
            }
            else if ($this->userVote != $vote) {
                $this->plop->query("UPDATE `votes` SET `vote_value`= ? WHERE user_id = ? AND img_id = ?",
                    [$vote, $user_id ,$img_id]);
            }
            return $this->plop->query("UPDATE gallery SET `votes` = ? WHERE img_id = ?",
                [$this->get_sum_votes($img_id), $img_id]);
        }

        public function get_img_user($db, $img_id)
        {
            $temp = $db->query("SELECT img_user FROM gallery WHERE img_id = ?", [$img_id])->fetch();
            return $db->query("SELECT * FROM users WHERE user_name = ?", [$temp['img_user']])->fetch();
        }

        public function get_comments($db, $img_id)
        {
            return $db->query("SELECT * FROM comments WHERE img_id = ?", [$img_id])->fetchAll();
        }

        public function get_image($db, $img_id)
        {
            return $db->query("SELECT * FROM gallery WHERE img_id = ?", [$img_id])->fetch();
        }

        public function get_user_vote($db, $img_id)
        {
            return $db->query("SELECT vote_value FROM votes WHERE img_id = ? AND user_id = ?",
                [$img_id, $_SESSION['auth']['user_id']])->fetch()['vote_value'];
        }

        public function getImageUser()
        {
            return $this->imageUser;
        }

        public function getUserVote()
        {
            return $this->userVote;
        }

        public function getSumVote()
        {
            return $this->sumVote;
        }

        public function getComments()
        {
            return $this->comments;
        }

        public function getImage()
        {
            return $this->image;
        }

    }
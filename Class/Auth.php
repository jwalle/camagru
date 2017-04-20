<?php

    Class Auth {

        private $session;

        public function __construct($session)
        {
            $this->session = $session;
        }

        public function register ($db, $uname, $upass, $umail) {
        $upass = hash('whirlpool', $upass);
        $token = App::str_random(60);
        $req = $db->query("INSERT INTO users SET user_name = ?, user_mail = ?, user_pass = ?, user_token = ?",
            [$uname, $umail, $upass, $token]);
        /*$user_id = $db->lastInsertId();
        mail($umail, "Validation de votre compte",
            wordwrap("Afin de valider votre compte merci de cliquer sur ce lien\n\n
            http://localhost/camagru/index.php?page=confirm&id=$user_id&token=$token"), 70);*/
    }

        public function confirm($db, $user_id, $token) {
            $user = $db->query('SELECT * FROM users WHERE id = ?', [$user_id])->fetch();
            if ($user && $user->user_token == $token) {
                $db->query('UPDATE users SET user_token = NULL, confirmed_at = NOW() WHERE id = ?', ['$user_id']);
                $_SESSION['auth'] = $user;
                return true;
            }
            return false;
        }

        public function restrict() {
            if (!$this->session->read('auth')){
                $this->session->setFlash('danger', "Vous n'avez pas le droit d'acceder a cette page.");
                header('Location: index.php');
                exit();
            }
        }

        public function login($db, $uname, $umail, $upass)
        {
            try
            {
                $user = $db->query('SELECT * FROM users
				WHERE (user_name = ? OR user_mail = ?) LIMIT 1', [$uname, $umail])->fetch();
                if (!empty($user))
                {
                    $test_pass = hash('whirlpool', $upass);
                    if ($test_pass == $user['user_pass'])
                    {
                        $this->connect($user);
                        return $user;
                    }
                    else
                        return false;
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
            return false;
        }

       public function user() {
            if ((!$this->session->read('auth'))) {
               return false;
           }
           return $this->session->read('auth');
        }

        public function connect($user)
        {
            $this->session->write('auth', $user);
        }

        public function logout() {
            $this->session->delete('auth');
        }
    }

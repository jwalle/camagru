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
            $db->query("INSERT INTO users SET user_name = ?, user_mail = ?, user_pass = ?, user_token = ?",
            [$uname, $umail, $upass, $token]);
            $user_id = $db->lastInsertId();
            mail($umail, "Validation de votre compte",
                wordwrap("Afin de valider votre compte merci de cliquer sur ce lien\n\n
                http://localhost:8080/camagru/index.php?page=confirm&id=$user_id&token=$token", 70));
            App::redirect('index.php?page=registered&username=' . $uname);
          }

        public function confirm($db, $user_id, $token) {
            $user = $db->query('SELECT * FROM users WHERE user_id = ?', [$user_id])->fetch();
            if ($user && $user['user_token'] == $token) {
                $db->query('UPDATE users SET user_token = NULL, confirmed_at = NOW() WHERE user_id = ?', [$user_id]);
                $_SESSION['auth'] = $user;
                return true;
            }
            return false;
        }

        public function resetPass($db, $email) {
            $user = $db->query('SELECT * FROM users WHERE user_mail = ? AND confirmed_at IS NOT NULL', [$email])->fetch();
            if ($user) {
                $reset_token = App::str_random(60);
                $user_id = $user['user_id'];
                $db->query('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE user_id = ?', [$reset_token, $user_id]);
                mail($email, "Reinitialisation de votre mot de passe",
                    "Pour réinitialiser votre mot de passe veuillez cliquer sur le lien suivant :\n\n"
                    ."http://localhost:8080/camagru/index.php?page=reset&id=$user_id&token=$reset_token");
                Session::getInstance()->setFlash('success', "Un mail vous a ete envoye !");
                return $user;
            }
            return false;
        }

        public function changePassword($db, $password, $id) {
            $password = hash('whirlpool', $password);
            $db->query('UPDATE users SET user_pass = ?, reset_at = NULL, reset_token = NULL WHERE user_id = ?', [$password, $id]);
            Session::getInstance()->setFlash('success', "votre mot de passe a bien ete mis a jour!");
        }

        public function checkResetToken($db, $id, $token) {
            if ($user = $db->query('SELECT * FROM users WHERE user_id = ? AND reset_token IS NOT NULL
                        AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)', [$id, $token])->fetch())
                return $user;
            return $false;
        }

        public function alreadyConnected () {
            if ($this->user()){
                $this->session->setFlash('danger', "Vous etes deja connecte.");
                return true ;
            }
            return false;
        }

        public function restrict() {
            if (!$this->session->read('auth')){
                $this->session->setFlash('danger', "Vous n'avez pas le droit d'acceder a cette page.");
                return false ;
            }
            return true;
        }

        public function login($db, $uname, $umail, $upass)
        {
            $user = $db->query('SELECT * FROM users
            WHERE (user_name = ? OR user_mail = ?) LIMIT 1', [$uname, $umail])->fetch();
            if (!empty($user))
            {
                if (!$user['confirmed_at']) {
                    Session::getInstance()->setFlash('danger', "Ce compte n'a pas été validé.");
                    return false;
                }
                $test_pass = hash('whirlpool', $upass);
                if ($test_pass == $user['user_pass'])
                {
                    $this->connect($user);
                    Session::getInstance()->setFlash('success', "Vous etes maintenant connecte.");
                    return $user;
                }
                else {
                    Session::getInstance()->setFlash('danger', "Desole, mauvais mot de passe.");
                    return false;
                }
            }
            Session::getInstance()->setFlash('danger', "Desole, cette utilisateur n'existe pas.");
            return false;
        }

        public function testPassword($upass, $upass_conf, $error) {
            if (!preg_match("#[0-9]+#", $upass))
                $error[] = "Le mot de passe doit contenir au moins un chiffre.";
            if (!preg_match("#[a-zA-Z]+#", $upass))
                $error[] = "Le mot de passe doit     contenir au moins une lettre.";
            if (!preg_match("#[A-Z]+#", $upass))
                $error[] = "Le mot de passe doit contenir au moins une lettre majuscule.";
            if ($upass != $upass_conf)
                $error[] = "Le mot de passe de confirmation ne correspond pas.";
            if (strlen($upass) < 6)
                $error[] = "Le mot de passe doit faire au moins 6 caracteres.";
            return $error;
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

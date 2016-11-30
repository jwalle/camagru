<html>
	<head>
		<link rel="stylesheet" type="text/css" href="chupa.css">
		<link rel="icon" type="image/png" href="/img/logo.png">
		<title>Camagru</title>
	</head>
	<body bgcolor="#A69256">

<div class ="general">
	


	<header class="box">
		<img id="logo" src="/img/logo.png"></img>
		<img id="chupa-title" src="/img/chupa.png">

	<div class="form_login">
		<form method="POST" action="login.php" >
			Identifiant: <input type="text" class="css-input" name="login" placeholder="Login" value="" />

			Mot de passe: <input type="password" class="css-input" name="passwd" placeholder="Mot de passe" value="" />
			<input type="submit" name="submit" value="OK"/>
		</br>
			
		</form>
		<a class="button2" href="create.html" >Créer un compte</a>
	</div>
			<div class="buttons">
				<a href="index.php" class="button"/>Accueil</a>
				<a href="store_nolog.html" class="button"/>Boutique</a>
				<a href="#" class="button"/>Panier</a>
				<!-- <a href="#" class="button"/>Login</a> -->
			</div>

			<?php echo '<p>Hello World</p>'; ?>
 

	</header>
			
			<a class="button3" href="http://local.42.fr:8080/phpmyadmin/" >Accès Admin</a>

</div>



</body>
</html>

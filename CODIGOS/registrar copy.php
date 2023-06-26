<?php require_once("bootstrap.php") ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registrar PHP</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

		h2 {
			color: #333;
		}

		form {
			width: 300px;
			margin: 0 auto;
		}

		label {
			display: block;
			margin-top: 10px;
		}

		input[type="text"],
		input[type="email"],
		input[type="password"],
		input[type="checkbox"] {
			width: 100%;
			padding: 5px;
			margin-top: 5px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		button {
			width: 100%;
			padding: 10px;
			margin-top: 10px;
			background-color: #4CAF50;
			color: #fff;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		button:hover {
			background-color: #45a049;
		}

		button:active {
			background-color: #3c9039;
		}
	</style>
</head>
<body>
	<center><h2>Cadastro</h2></center>
	<form action="" method="post">
		<center>
			<label for="nome">Nome Completo</label>
			<input type="text" name="nome" placeholder="Ex: Paulo Júnior" required><br>
			<label for="email">E-mail</label>
			<input type="email" name="email" placeholder="E-mail" required><br>
			<label for="senha1">Senha</label>
			<input type="password" name="senha1" placeholder="6 ou mais digitos" autocomplete="off" required><br>
			<label for="senha2">Repita a Senha</label>
			<input type="password" name="senha2" placeholder="Confirme sua senha" autocomplete="off" required><br>
			<input type="checkbox" name="termos" required>Eu li e aceito os termos de serviço<br>
			<button type="submit" class="btn btn-block mt-lg btn-default"><b>Cadastrar</b></button>
		</center>
	</form>
</body>
</html>

<?php
if($_POST){
	date_default_timezone_set('Brazil/East');
	$nome = $_POST['nome'];
	$nome = htmlspecialchars($nome, ENT_QUOTES);

	$email = $_POST['email'];
	$email = htmlspecialchars($email, ENT_QUOTES);

	$termos = $_POST['termos'];
	$termos = htmlspecialchars($termos, ENT_QUOTES);

	$senha1 = $_POST['senha1'];
	$senha1 = htmlspecialchars($senha1, ENT_QUOTES);

	$senha2 = $_POST['senha2'];
	$senha2 = htmlspecialchars($senha2, ENT_QUOTES);

	$senhacrip = hash('sha256', $senha2);

	$data = date("Y-m-d H:i:s");

	$ip = $_SERVER['REMOTE_ADDR'];

	if(empty($email)){
		echo "<script>window.alert('bota o e-mail ai hacker fdp!');</script";
		echo "<meta http-equiv= 'refresh' content='0;'>";
		return false;
	}

	$veric = mysqli_query($conn, "SELECT * FROM docker WHERE email='$email'");
	$verifc = mysqli_num_rows($veric);

	if ($verifc == TRUE){
		echo "<script>window.alert('Você já cadastrou!');</script";
		echo "<meta http-equiv= 'refresh' content='0;'>";
		return false;
	}

	if (empty($termos)){
		echo "<script>window.alert('Concorde com os termos!');</script";
		echo "<meta http-equiv= 'refresh' content='0;'>";
		return false;
	}

	if (empty($senha1)){ // Verificar senha
		echo "<script>window.alert('Digite uma senha!');window.history.go(-1);</script";
		return false;
	}

	if (empty($senha2)){ // Confirmar senha
		echo "<script>window.alert('Confirme sua senha!');window.history.go(-1);</script";
		return false;
	}

	if (strlen($senha1) < 6 ){
		echo "<script>window.alert('Sua senha deve conter no mínimo 6 dígitos!');widow.history.go(-1)</script";
		return false;
	}

	if($senha1 != $senha2){ //verificar senhas iguais
		echo "<script>widow.alert('Senhas Diferentes!');</script>";
		echo "<meta http-equiv='refresh content='0;'>";
		return false;
	}

	echo "<meta http-equiv='refresh' content= '0;registrar.php?q=true'>";

	//////////////////////////// Gravando ////////////////////////////

	$sql1=mysqli_query($conn, "INSERT INTO docker (nome, email, senha, data) VALUES ('$nome', '$email', '$senhacrip', '$data')");
}
?>

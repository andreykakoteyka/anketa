<?php

include("../functions.php");

$login = $_POST['login'];
$mysqli = connectDB();
	
	
if(!$login){
	delete_cookie();
	echo 'Не заполнено поле login!';	
}

 if(!preg_match("/^[a-zA-Z0-9]+$/",$login))

{
	delete_cookie();
    echo "Логин может состоять только из букв английского алфавита и цифр";
}

if(strlen($login) < 5 or strlen($login) > 30)

{
    delete_cookie();
	echo "Логин должен быть не меньше 5-х символов и не больше 30";
}

$query = $mysqli->query("SELECT user_id, user_password FROM users WHERE user_login='".$login."'");//править надо
$data = mysqli_fetch_assoc($query);;
$password = $_POST['password'];
$password_base = $data['user_password'];
if(isset($data['user_password'])){	
	if($password_base === md5(md5($password))){

		# Генерируем случайное число и шифруем его

		$hash = md5(generateCode(10));

	   
		# Переводим IP в строку

		$insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";

 

		# Записываем в БД новый хеш авторизации и IP

		$mysqli->query("UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

		

		# Ставим куки
		
		
		setcookie("id", $data['user_id'], time()+60*30);

		setcookie("hash", $hash, time()+60*30);

		//echo $hash . " ////  " . $_COOKIE['hash'];

		check_user($mysqli);

	}

	else

	{
		echo "Неверный пароль!";
		delete_cookie();

	}
}
else{
	delete_cookie();
	echo "Пользователь не найден!";
		
}
$mysqli->close();
		


?>
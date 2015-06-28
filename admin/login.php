<!doctype html>
<?php
include("../functions.php");

$mysqli = connectDB();
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
	$query = $mysqli->query("SELECT user_id FROM users WHERE user_id='".$_COOKIE['id']."', user_hash='".$_COOKIE['hash']."'");
	if(isset($query))
	{
		header("Location: /admin");
	}
}
$mysqli->close();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Вход в панель управления</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div id="login-block">
            <form method="post" id="login-form" name="login-form">
                <ul>
                    <h3 id="login-title">Вход в панель управления</h3>
                    <div id="log-in-fail-descr"></div>
                    <li class="form-group">
                        <input type="text" name="login" id="login" class="form-control input-lg" placeholder="Логин">
                    </li>
                    <li class="form-group">
                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Пароль">
                        <span class="glyphicon glyphicon-remove form-control-feedback hidden"></span>
                    </li>
                    <li><button id="log-in" class="btn btn-lg btn-active col-lg-offset-3 col-lg-6">Вход</button></li>
                </ul>
            </form>
        </div>
    </div>
</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/functions.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</html>
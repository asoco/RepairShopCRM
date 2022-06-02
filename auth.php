<?PHP

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "service_center");

$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
$mysql = new mysqli(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


$result = $mysql->query("SELECT * FROM `users` WHERE `login`='$login'");
$user = $result->fetch_assoc();

$pass_verify = password_verify($pass, $user['pass']);
if(count($user) == 0){
	echo"Такой пользователь не найден";
	exit();
}

setcookie('login', $_POST['login'], time() + 30 * 86400);
setcookie('role', $user['role'], time() + 30 * 86400);
$userpic = $user['avatar'];

header('Location: index.php');

?>
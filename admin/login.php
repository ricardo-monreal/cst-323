<?php require_once 'db_con.php'; 
ini_set("display_errors",1);
ini_set("log_errors",1);
ini_set("error_log",dirname(__FILE__).'/error_log.txt');

require dirname(__FILE__).'/../vendor/autoload.php';
// Monolog
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

use Monolog\Handler\LogglyHandler;
use Monolog\Formatter\LogglyFormatter;

// Testing feature
/* 
class MyLogger2 implements ILogger
{
	private static $logger = null;

	static function getLogger()
	{
		if(self::$logger == null)
		{
			self::$logger = new Logger('playlaravel');
			self::$logger->pushHandler(new LogglyHandler('78d9d407-e20e-4c6e-9505-e065b836ea6d/tag/monolog', Logger::DEBUG));
		}
		return self::$logger;
	}

	public static function debug($message, $data=array());
	{
		self::getLogger()->addDebug($message, $data);
	}

	public static function info($message, $data=array());
	{
		self::getLogger()->addInfo($message, $data);
	}

	public static function warning($message, $data=array());
	{
		self::getLogger()->addWarning($message, $data);
	}

	public static function error($message, $data=array());
	{
		self::getLogger()->addError($message, $data);
	}
} */


// create the logger channel
$logger = new Logger('loggin_logger');
$errLogger = new Logger('error_logger');
// handlers
$logger->pushHandler(new StreamHandler(dirname(__FILE__).'/app_logs.txt', Logger::INFO));
//$logger->pushHandler(new LogglyHandler('78d9d407-e20e-4c6e-9505-e065b836ea6d/tag/monolog', Logger::INFO));
// error handler
$errLogger->pushHandler(new StreamHandler(dirname(__FILE__).'/app_logs.txt', Logger::INFO));
$logger->pushHandler(new FirePHPHandler());



session_start();
if(isset($_SESSION['user_login'])){
	header('Location: index.php');
}
	

	if (isset($_POST['login'])) {
		$username= $_POST['username'];
		$password= $_POST['password'];


		$input_arr = array();

		if (empty($username)) {
			$input_arr['input_user_error']= "Username Is Required!";
		}

		if (empty($password)) {
			$input_arr['input_pass_error']= "Password Is Required!";
		}

		if(count($input_arr)==0){
			$query = "SELECT * FROM `users` WHERE `username` = '$username';";
			$result = mysqli_query($db_con, $query);
			if (mysqli_num_rows($result)==1) {
				$row = mysqli_fetch_assoc($result);
				if ($row['password']==sha1(md5($password))) {
					if ($row['status']=='active') {
						$_SESSION['user_login']=$username;
						header('Location: index.php');
						// logger 
						$logger->info('User logged in succesfully');
						//$logger->warning('test logs to loggly');
					}else{
						$status_inactive = "Your Status is inactive, please contact with admin or support!";
					}
				}else{
					$worngpass= "This password Wrong!";	
					// logger
					$errLogger->info('User used the wrong password');
				}
			}else{
				$usernameerr= "Username Not Found!";
				//logger
				$errLogger->info('User used the wrong username');
			}
		}
		
	}


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>GCU - CST-323</title>
  </head>
  <body>
    <div class="container"><br>
          <h1 class="text-center">Login</h1><hr><br>
          <div class="d-flex justify-content-center">
          	<?php if(isset($usernameerr)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $usernameerr; ?></div><?php };?>
          		<?php if(isset($worngpass)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $worngpass; ?></div><?php };?>
          		<?php if(isset($status_inactive)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $status_inactive; ?></div><?php };?>
          </div>
          <div style="text-align:center;">
            <div class="col-md-4 offset-md-4">
             	<form method="POST" action="">
				  <div class="form-group row">
				    <div class="col-sm-12">
				      <input type="text" class="form-control" name="username" value="<?= isset($username)? $username: ''; ?>" placeholder="Username" id="inputEmail3"> <?php echo isset($input_arr['input_user_error'])? '<label>'.$input_arr['input_user_error'].'</label>':''; ?>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-12">
				      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password"><label><?php echo isset($input_arr['input_pass_error'])? '<label>'.$input_arr['input_pass_error'].'</label>':''; ?>
				    </div>
				  </div>
				  <div class="text-center">
				    <button type="submit" name="login" class="btn btn-primary">Sign in</button>
					<br>
					<br>
				    <p>Don't have an account? &nbsp;Register<a href="register.php">&nbsp;Here!</a></p>
				  </div>
				</form>
            </div>
          </div>
    </div>
	<footer class="footer">
      <div class="container" style="text-align:center;">
        <p>Copyright &copy; Grand Canyon University <?php echo date('Y') ?></p>
      </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript">
    	$('.toast').toast('show')

    </script>
  </body>
</html>
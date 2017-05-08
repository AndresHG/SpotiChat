

<?php

define('DB_SERVER', 'localhost');
define('DB_NAME', 'SpotiChat');
define('DB_USER', 'root');
define('DB_PASS', '');

//define('DB_SERVER', 'mysql.hostinger.es');
//define('DB_NAME', 'u908911760_spoty');
//define('DB_USER', 'u908911760_root');
//define('DB_PASS', 'lopo23');

$db = @mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
mysqli_set_charset($db, 'utf8');

 ?>

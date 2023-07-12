<?PHP
    $server = 'localhost';
    $username = 'root';
    $password = 'justbayr@1006';
    $db = 'mensahe';

    $con_DB = new mysqli($server, $username, $password, $db);

    if ($con_DB->connect_error) {
        die("Connection failed: " . $con_DB->connect_error);
    }
?>
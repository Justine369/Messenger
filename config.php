<?PHP

    require_once __DIR__ . '/vendor/autoload.php';
    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $server = $_ENV['DB_HOST'];
    $db = $_ENV['DB_DATABASE'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];

    $con_DB = new mysqli($server, $username, $password, $db);

    if ($con_DB->connect_error) {
        die("Connection failed: " . $con_DB->connect_error);
    }
?>

<?php
function connectToDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=gestion_scolaire221", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        return null;
    }
}
function dd(){
    echo "<pre>";
    print_r(func_get_args());
    echo "</pre>";
    exit;
}





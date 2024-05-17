<?php
    // Database configuration
    $host = 'localhost';
    $db = 'pet_store';
    $user = 'root';
    $pass = '';
    $userTable = 'Users';
    $petTable = 'Pets';
    $newsTable = 'News';

    // DSN for connecting to MySQL server (without specifying a database)
    $dsn = "mysql:host=$host;charset=utf8mb4";

    // PDO options
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    function getPDOConnection($useDb = true) {
        global $dsn, $user, $pass, $options, $db;
        static $pdo = null;
    
        if ($pdo === null) {
            $pdo = new PDO($dsn, $user, $pass, $options);
            if ($useDb) {
                $pdo->exec("USE $db");
            }
        }
        return $pdo;
    }

    // Function to create a PDO connection
    function createPDOConnection() {
        global $dsn, $user, $pass, $options;
        try {
            return new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    // Function to create a database if it doesn't exist
    function createDatabase() {
        global $db;
        try {
            // Get the PDO instance without selecting the database
            $pdo = getPDOConnection(false);
    
            // Check if the database exists
            $stmt = $pdo->query("SHOW DATABASES LIKE '$db'");
            $databaseExists = $stmt->rowCount() > 0;
    
            // If the database does not exist, create it
            if (!$databaseExists) {
                $pdo->exec("CREATE DATABASE $db");
                echo "Database '$db' created successfully.<br>";
            } else {
                echo "Database '$db' already exists.<br>";
            }
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    // Function to create a table if it doesn't exist
    function isUserTableExists() {
        // Connect to the specified database
        global $db,$userTable;
        $pdo = getPDOConnection();

        $pdo->exec("USE $db");

        // Check if the table exists
        $stmt = $pdo->query("SHOW TABLES LIKE 'Users'");
        $tableExists = $stmt->rowCount() > 0;

        // If the table does not exist, create it
        if (!$tableExists) {
            $sql = "
            CREATE TABLE $userTable (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                username VARCHAR(100) NOT NULL UNIQUE,
                email VARCHAR(100) NOT NULL UNIQUE,
                password VARCHAR(30) NOT NULL,
                phone_no VARCHAR(12),
                address VARCHAR(100),
                description VARCHAR(1000)
            )";

            $pdo->exec($sql);
            echo "Table $userTable created successfully.";
        } else {
            echo "Table $userTable already exists.";
        }
    }

    function insertIntoUsersTable($name,$username,$email,$password,$phone_no,$address,$description){
        global $db,$userTable;
        isUserTableExists();
        try{
            $pdo = getPDOConnection();
            $pdo->exec("USE $db");
            $sql = "
                INSERT INTO $userTable (name,username,email,password,phone_no,address,description) VALUES (
                :name,:username,
                :email,:password,:phone_no,:address,:description
            )";
            $stmt = $pdo->prepare($sql);
            $stmt -> bindParam(':name',$name);
            $stmt -> bindParam(':username',$username);
            $stmt -> bindParam(':email',$email);
            $stmt -> bindParam(':password',$password);
            $stmt -> bindParam(':phone_no',$phone_no);
            $stmt -> bindParam(':address',$address);
            $stmt -> bindParam(':description',$description);

            if($stmt -> execute()){
                echo "User inserted successfully.";
            }else{
                echo 'Error in inserting user';
            }
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
        
    }

    function verifyUserLogin($username,$password){
        global $db,$userTable;
        try{
            $pdo = getPDOConnection();
            $pdo->exec("USE $db");
            
            $sql = "
            SELECT password FROM $userTable
            WHERE username LIKE '$username'";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $passDb = $stmt->fetchColumn();

            if($password === $passDb){
                return true;
            }else{
                echo 'Invalid username or password';
                echo $username;
                echo $passDb;
                return false;
            }

        }catch(PDOException $e){
            echo $e;
        }
    }

?>

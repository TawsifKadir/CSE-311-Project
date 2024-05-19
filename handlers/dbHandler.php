<?php
    // Database configuration
    $host = 'localhost';
    $db = 'pets';
    $user = 'root';
    $pass = '';
    $userTable = 'Users';
    $petTable = 'Pets_Table';
    $newsTable = 'News';
    $chatTable = 'Chats';
    $notifications = 'notifications';

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
        $sql = "SHOW TABLES LIKE :table_name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':table_name', $userTable);

        // Execute the query
        $stmt->execute();
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
                description VARCHAR(1000),
                profile_image LONGBLOB,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";

            $pdo->exec($sql);
            echo "Table $userTable created successfully.";
        } else {
            echo "Table $userTable already exists.";
        }
    }

    function isPetsTableExists(){
        global $db,$petTable,$userTable;
        $pdo = getPDOConnection();

        $pdo->exec("USE $db");

        // Check if the table exists
        $sql = "SHOW TABLES LIKE :table_name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':table_name', $petTable);

        // Execute the query
        $stmt->execute();
        $tableExists = $stmt->rowCount() > 0;

        // If the table does not exist, create it
        if (!$tableExists) {
            $sql = "
            CREATE TABLE $petTable (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                description VARCHAR(1000),
                image LONGBLOB,
                owner_id INT NOT NULL,
                adopter_id INT,
                up_for_adoption BOOLEAN DEFAULT FALSE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (owner_id) REFERENCES $userTable(id),
                FOREIGN KEY (adopter_id) REFERENCES $userTable(id)
            )";

            $pdo->exec($sql);
            echo "Table $petTable created successfully.";
        } else {
            echo "Table $petTable already exists.";
        }
    }

    function isChatTableExists(){
        global $db,$chatTable,$userTable;
        $pdo = getPDOConnection();

        $pdo->exec("USE $db");

        // Check if the table exists
        $sql = "SHOW TABLES LIKE :table_name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':table_name', $chatTable);

        // Execute the query
        $stmt->execute();
        $tableExists = $stmt->rowCount() > 0;

        // If the table does not exist, create it
        if (!$tableExists) {
            $sql = "
                CREATE TABLE $chatTable (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    content VARCHAR(1000),
                    sender_id INT NOT NULL,
                    recipient_id INT NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (sender_id) REFERENCES $userTable(id),
                    FOREIGN KEY (recipient_id) REFERENCES $userTable(id)
                )
            ";

            $pdo->exec($sql);
            echo "Table $chatTable created successfully.";
        } else {
            echo "Table $chatTable already exists.";
        }
    }

    function isNotificationTableExists(){
        global $db,$notifications,$userTable;
        $pdo = getPDOConnection();

        $pdo->exec("USE $db");

        // Check if the table exists
        $sql = "SHOW TABLES LIKE :table_name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':table_name', $notifications);

        // Execute the query
        $stmt->execute();
        $tableExists = $stmt->rowCount() > 0;

        // If the table does not exist, create it
        if (!$tableExists) {
            $sql = "
                CREATE TABLE $notifications (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    user_id INT NOT NULL,
                    message TEXT NOT NULL,
                    read_status BOOLEAN DEFAULT FALSE,
                    pet_id INT NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (user_id) REFERENCES $userTable(id)
                );
            ";

            $pdo->exec($sql);
            echo "Table $notifications created successfully.";
        } else {
            echo "Table $notifications already exists.";
        }
    }

    function getUserNameById($user_id){
        try{
            global $db,$userTable;
            $pdo = getPDOConnection();
            $pdo->exec("USE $db");

            $sql = "SELECT name 
            FROM $userTable WHERE id = :id ";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $user_id);

            $stmt->execute();

            $users = $stmt->fetchColumn();

            return $users;
            
        }catch(PDOException $e){
            return null;
        }
    }

    function insertIntoUsersTable($name,$username,$email,$password,$phone_no,$address,$description,$image){
        global $db,$userTable;
        isUserTableExists();
        try{
            $pdo = getPDOConnection();
            $pdo->exec("USE $db");
            $sql = "
                INSERT INTO $userTable (name,username,email,password,phone_no,address,description,profile_image) VALUES (
                :name,:username,
                :email,:password,:phone_no,:address,:description,:profile_image
            )";
            $stmt = $pdo->prepare($sql);
            $stmt -> bindParam(':name',$name);
            $stmt -> bindParam(':username',$username);
            $stmt -> bindParam(':email',$email);
            $stmt -> bindParam(':password',$password);
            $stmt -> bindParam(':phone_no',$phone_no);
            $stmt -> bindParam(':address',$address);
            $stmt -> bindParam(':description',$description);
            $stmt -> bindParam(':profile_image',$image, PDO::PARAM_LOB);

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

    function insertIntoPetsTable($name,$description,$image,$owner_id,$adopter_id){
        global $db,$petTable;
        isPetsTableExists();
        try{
            $pdo = getPDOConnection();
            $pdo->exec("USE $db");
            $sql = "
                INSERT INTO $petTable (name,description,image,owner_id,adopter_id) VALUES (
                :name,:description,
                :image,:owner_id,:adopter_id
                )";

            $stmt = $pdo->prepare($sql);

            $stmt -> bindParam(':name',$name);
            $stmt -> bindParam(':description',$description);
            $stmt -> bindParam(':image',$image, PDO::PARAM_LOB);
            $stmt -> bindParam(':owner_id',$owner_id);
            $stmt -> bindParam(':adopter_id',$adopter_id);

            if($stmt -> execute()){
                echo "Pet inserted successfully.";
            }else{
                echo 'Error in inserting user';
            }
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    function insertIntoChatsTable($content,$sender_id,$recipient_id){
        global $db,$chatTable;
        isChatTableExists();
        try{
            $pdo = getPDOConnection();
            $pdo->exec("USE $db");
            $sql = "
                INSERT INTO $chatTable (content,sender_id,recipient_id) VALUES (
                :content,:sender_id,:recipient_id,
                )";

            $stmt = $pdo->prepare($sql);

            $stmt -> bindParam(':content',$content);
            $stmt -> bindParam(':sender_id',$sender_id);
            $stmt -> bindParam(':recipient_id',$recipient_id);

            if($stmt -> execute()){
                echo "Chat inserted successfully.";
            }else{
                echo 'Error in inserting user';
            }
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    function getAllChats($sender_id,$recipient_id,$last_message_id){
        try{
            global $db,$chatTable;
            $pdo = getPDOConnection();
            $pdo->exec("USE $db");

            $sql = "SELECT * 
            FROM $chatTable WHERE sender_id = :sender_id AND recipient_id = :recipient_id AND id < :last_message_id
            ORDER BY id DESC
            LIMIT 15";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':sender_id', $sender_id);
            $stmt->bindParam(':recipient_id', $recipient_id);
            $stmt->bindParam(':last_message_id', $last_message_id);

            $stmt->execute();

            $messages = $stmt->fetchAll();

            return json_encode($messages);
            
        }catch(PDOException $e){
            return null;
        }
    }

    function putUpPetForAdoption($pet_id){
        try{
            global $db,$petTable;
            $pdo = getPDOConnection();
            $pdo->exec("USE $db");

            $sql = "UPDATE $petTable 
            SET up_for_adoption = TRUE WHERE id = $pet_id";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            return true;
            
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    function cancelAdoption($pet_ID){
        try{
            global $db,$petTable;
            $pdo = getPDOConnection();
            $pdo->exec("USE $db");

            $sql = "UPDATE $petTable 
            SET up_for_adoption = FALSE WHERE id = $pet_ID";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            return true;
            
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    function getAllPetsWithoutUser($userID){
        try{
            global $db,$petTable;
            $pdo = getPDOConnection();
            $pdo->exec("USE $db");

            $sql = "SELECT * 
            FROM $petTable WHERE owner_id != $userID AND up_for_adoption = TRUE";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $items = $stmt->fetchAll();

            if($items != null){
                return $items;
            }else{
                return null;
            }
            
        }catch(PDOException $e){
            echo $e;
            return null;
        }
    }

    function getAllPetsOfUser($userID){
        try{
            global $db,$petTable;
            $pdo = getPDOConnection();
            $pdo->exec("USE $db");

            $sql = "SELECT * 
            FROM $petTable WHERE owner_id = $userID";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $items = $stmt->fetchAll();

            if($items != null){
                return $items;
            }else{
                return null;
            }
            
        }catch(PDOException $e){
            echo $e;
            return null;
        }
    }

    function verifyUserLogin($credential,$password){
        global $db,$userTable;
        try{
            $pdo = getPDOConnection();
            $pdo->exec("USE $db");
            
            $sql = "
            SELECT * FROM $userTable
            WHERE username LIKE :username OR email LIKE :username";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username',$credential);
            $stmt->execute();

            $user = $stmt->fetch();

            $passDb = $user['password'];

            if($passDb === $password){
                return $user;
            }else{
                return null;
            }

        }catch(PDOException $e){
            echo $e;
            return null;
        }
    }

    function getPetByID($pet_ID){
        try {
            global $petTable,$db;
            // Get the PDO instance
            $pdo = getPDOConnection();
            $pdo->exec("USE $db");
    
            // Prepare the SQL query to get the item details by ID
            $sql = "SELECT * FROM $petTable WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $pet_ID, PDO::PARAM_INT);
            $stmt->execute();
            
            // Fetch the item details
            $item = $stmt->fetch();
    
            if (!$item) {
                return null;
            }else{
                return $item;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    function getUserByID($user_id){
        try {
            // Get the PDO instance
            global $userTable;
            $pdo = getPDOConnection();
        
            // Prepare the SQL query to get the logged-in user's information
            $sql = "SELECT * FROM $userTable WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $user_id);
            $stmt->execute();
            
            $user = $stmt->fetch();
        
            if (!$user) {
                // If the user does not exist, log them out
                session_unset();
                session_destroy();
                header('Location: login.php');
                exit();
                return null;
            }else{
                return $user;
            }
        } catch (PDOException $e) {
            // Store the error message in the session and redirect to the login page
            $_SESSION['error_message'] = "Database error: " . $e->getMessage();
            header('Location: login.php');
            exit();
        }
    }

?>

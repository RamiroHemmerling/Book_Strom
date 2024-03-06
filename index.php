<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
    $conn = new PDO("mysql:host=$servername;dbname=book", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }
    ?>
    <p>
    <?php
    $sql = "SELECT * FROM benutzer";
    foreach ($conn->query($sql) as $row) {
        echo $row['name']."<br />";
        echo $row['passwort']."<br />";
    }
    ?>
    </p>
</body>
</html>
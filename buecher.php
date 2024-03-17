<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
    $conn = new PDO("mysql:host=$servername;dbname=book", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }
    ?>
    <?php
    if ($_SERVER['REQUEST_METHOD']== 'POST' 
    && isset($_POST['Search'])
    && !empty ($_POST['Search'])) {
        $suche = $_POST['Search'];
    }
    ?>
    <div class="header"></div>
    <div class="sotials">
      <img class="linkedin" src="Icons/linkedin-svgrepo-com.svg" alt="linkedin">
      <img src="Icons/instagram.svg" alt="instagramm">
      <img src="Icons/facebook.svg" alt="facebook">
      <div class="line"></div>
    </div>
    <div class="wrapper">
      <form action="buecher.php" method="post">
        <input type="text" name="Search" id="Search">
        <input type="submit" name="submit" value="submit">
      </form>
      <div class="books">
        <?php
        $sql = "SELECT * FROM buecher WHERE kurztitle LIKE '%". $suche."%';";
        foreach ($conn->query($sql) as $row) {
          echo '<div class="book">
          <p>'. $row["kurztitle"]. '</p>'.
          $row["autor"]. '</p>'
          .'</div>';
        }
        ?>
      </div>
      <div class="books">
        <?php
        $sql = "SELECT * FROM buecher WHERE autor LIKE '%". $suche."%';";
        foreach ($conn->query($sql) as $row) {
          echo '<div class="book">
          <p>'. $row["kurztitle"]. '</p>'.
          $row["autor"]. '</p>'
          .'</div>';
        }
        ?>
      </div>
    </div>
</body>
</html>